<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProcurementPlanRequest;
use App\Models\ProcurementPlan;
use App\Repositories\FormProcessRepository;
use App\Repositories\FormRouteRepository;
use App\Repositories\ProcurementPlanRepository;
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
        //
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
            $items = $this->procurementPlanRepository->addItems();
            $data['total_price'] = $items['total_cost'];
            $data['inflation'] = $items['total_cost'] * 0.1;
            $data['contingency'] = $items['total_cost'] * 0.1;
            $data['total_estimated_budget'] = $items['total_cost'] + $data['inflation'] + $data['contingency'];
            $procurement_plan = $this->procurementPlanRepository->create($data);
            $procurement_plan->items()->saveMany($items['items']);
            $form_process = (new FormProcessRepository())->procurementPlan($procurement_plan);
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
    public function show($uuid)
    {
        
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
    public function update(Request $request, ProcurementPlan $procurementPlan)
    {
        //
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

    public function pdf(Request $request, $id)
    {
        $procurement_plan = $this->procurementPlanRepository->attach('end_user,items.item')->getById($id);
        // return $procurement_plan;
        $procurement_plan = fractal($procurement_plan, new ProcurementPlanTransformer)->parseIncludes('end_user,items.item')->toArray();
        // return $procurement_plan;
        $count = 0;
        foreach ($procurement_plan['items']['data'] as $key => $item) {
            $count++;
            $count += substr_count($item['item']['item_name'],"\n");
        }
        $procurement_plan['count_items'] = $count;
        $config = ['instanceConfigurator' => function($mpdf) {
            $mpdf->SetWatermarkText('DRAFT');
            $mpdf->showWatermarkText = true;
            $mpdf->setFooter('{PAGENO}');
        }];
        
        $pdf = FacadesPdf::loadView('pdf.procurement-plan', $procurement_plan, $config, ['orientation' => 'L']);
        $pdf->shrink_tables_to_fit = 1.4;
        $pdf->use_kwt = true;
        // return $procurement_plan;
        // return view('pdf.purchase-request', $procurement_plan);
        if($request['view']){
            return $pdf->stream('purchase-request-'.'1111'.'.pdf');
        }
        return $pdf->stream('purchase-request-'.'1111'.'.pdf');
        return $pdf->download('purchase-request-'.'1111'.'.pdf');
    }
}
