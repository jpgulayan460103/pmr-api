<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProcurementPlanRequest;
use App\Models\ProcurementPlan;
use App\Repositories\FormProcessRepository;
use App\Repositories\FormRouteRepository;
use App\Repositories\LibraryRepository;
use App\Repositories\ProcurementPlanRepository;
use App\Transformers\ApprovedProcurementPlanItemTransformer;
use App\Transformers\ProcurementPlanTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use niklasravnsborg\LaravelPdf\Facades\Pdf as FacadesPdf;

class ProcurementPlanController extends Controller
{
    private $procurementPlanRepository;

    public function __construct(ProcurementPlanRepository $procurementPlanRepository)
    {
        $this->procurementPlanRepository = $procurementPlanRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attach = 'form_process,form_routes, form_uploads, end_user, item_type, procurement_plan_type';
        $this->procurementPlanRepository->attach($attach);
        $procurement_plans = $this->procurementPlanRepository->search([]);
        // return $procurement_plans;
        return fractal($procurement_plans, new ProcurementPlanTransformer)->parseIncludes($attach);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProcurementPlanRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();
            $itemsA = $this->procurementPlanRepository->addItemsA();
            $itemsB = $this->procurementPlanRepository->addItemsB();
            $data['total_price_a'] = $itemsA['total_cost'];
            $data['inflation_a'] = $itemsA['total_cost'] * 0.1;
            $data['contingency_a'] = $itemsA['total_cost'] * 0.1;
            $data['total_estimated_budget_a'] = $itemsA['total_cost'] + $data['inflation_a'] + $data['contingency_a'];

            $data['total_price_b'] = $itemsB['total_cost'];
            $data['inflation_b'] = $itemsB['total_cost'] * 0.1;
            $data['contingency_b'] = $itemsB['total_cost'] * 0.1;
            $data['total_estimated_budget_b'] = $itemsB['total_cost'] + $data['inflation_b'] + $data['contingency_b'];
            
            $data['total_estimated_budget'] = $data['total_estimated_budget_a'] + $data['total_estimated_budget_b'];

            $certified_by_office = $data['certified_by_office'];
            $approved_by_office = $data['approved_by_office'];

            $procurement_plan = $this->procurementPlanRepository->create($data);
            $procurement_plan->items()->saveMany($itemsA['items']);
            $procurement_plan->items()->saveMany($itemsB['items']);
            $form_process = (new FormProcessRepository())->procurementPlan($procurement_plan, $certified_by_office, $approved_by_office);
            $form_route = (new FormRouteRepository())->procurementPlan($procurement_plan, $form_process);
            DB::commit();
            return $procurement_plan;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProcurementPlan  $procurementPlan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $attach = 'form_process, end_user, item_type, form_routes.to_office, form_routes.processed_by.user_information, form_routes.forwarded_by.user_information, form_routes.from_office, form_uploads';
        $this->procurementPlanRepository->attach($attach);
        $procurement_plans = $this->procurementPlanRepository->getById($id);
        return fractal($procurement_plans, new ProcurementPlanTransformer)->parseIncludes($attach);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProcurementPlan  $procurementPlan
     * @return \Illuminate\Http\Response
     */
    public function edit(ProcurementPlan $procurementPlan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProcurementPlan  $procurementPlan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();
            $procurement_plan = $this->procurementPlanRepository->updateProcurementPlan($id, $data);
            DB::commit();
            return $procurement_plan;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProcurementPlan  $procurementPlan
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProcurementPlan $procurementPlan)
    {
        //
    }

    public function summary(Request $request)
    {
        $items = $this->procurementPlanRepository->getApprovedItems();
        return $items;
    }

    public function pdf(Request $request, $uuid)
    {
        $procurement_plan = $this->procurementPlanRepository->attach('end_user,items.item, procurement_plan_type')->getByUuid($uuid);
        // return $procurement_plan;
        $procurement_plan = fractal($procurement_plan, new ProcurementPlanTransformer)->parseIncludes('end_user,items.item, procurement_plan_type')->toArray();
        $count_a = 0;
        $count_b = 0;
        $itemTypeA = (new LibraryRepository)->getBy("name", ppmpCse())->first();
        $itemTypeB = (new LibraryRepository)->getBy("name", ppmpNonCse())->first();
        $itemsA = [];
        $itemsB = [];
        foreach ($procurement_plan['items']['data'] as $key => $item) {
            if($item['item_type_id'] == $itemTypeA->id){
                $itemsA[] = $item;
                $count_a++;
                $count_a += substr_count($item['item']['item_name'],"\n");
            }elseif($item['item_type_id'] == $itemTypeB->id){
                $itemsB[] = $item;
                $count_b++;
                $count_b += substr_count($item['description'],"\n");
            }
        }
        
        $procurement_plan['itemsA'] = $itemsA;
        $procurement_plan['itemsB'] = $itemsB;
        $procurement_plan['count_items_a'] = $count_a;
        $procurement_plan['count_items_b'] = $count_b;
        $config = [
            'instanceConfigurator' => function($mpdf) {
                $mpdf->AddPage('L');
                $mpdf->setFooter('Page {PAGENO} of {nbpg}');
            },
        ];
        
        $pdf = FacadesPdf::loadView('pdf.procurement-plan', $procurement_plan, $config, $config);
        $pdf->shrink_tables_to_fit = 1.4;
        $pdf->use_kwt = true;
        if($request['view']){
            return $pdf->stream('purchase-request-'.'1111'.'.pdf');
        }
        return $pdf->stream('purchase-request-'.'1111'.'.pdf');
        return $pdf->download('purchase-request-'.'1111'.'.pdf');
    }
}
