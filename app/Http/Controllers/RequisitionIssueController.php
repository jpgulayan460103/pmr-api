<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRequisitionIssueRequest;
use App\Models\RequisitionIssue;
use App\Repositories\FormProcessRepository;
use App\Repositories\FormRouteRepository;
use App\Repositories\RequisitionIssueRepository;
use App\Transformers\RequisitionIssueTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use niklasravnsborg\LaravelPdf\Facades\Pdf as FacadesPdf;

class RequisitionIssueController extends Controller
{
    private $requisitionIssueRepository;

    public function __construct(RequisitionIssueRepository $requisitionIssueRepository)
    {
        $this->requisitionIssueRepository = $requisitionIssueRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attach = 'form_process,form_routes, form_uploads, end_user, items';
        $this->requisitionIssueRepository->attach($attach);
        $procurement_plans = $this->requisitionIssueRepository->search([]);
        // return $procurement_plans;
        return fractal($procurement_plans, new RequisitionIssueTransformer)->parseIncludes($attach);
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
    public function store(CreateRequisitionIssueRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();
            $requested_by_office = $data['requested_by_office'];
            $approved_by_office = $data['approved_by_office'];
            $items = $this->requisitionIssueRepository->addItems();
            $requisition_issue = $this->requisitionIssueRepository->create($data);
            $requisition_issue->items()->saveMany($items['items']);
            $form_process = (new FormProcessRepository())->requisitionIssue($requisition_issue, $requested_by_office);
            $form_route = (new FormRouteRepository())->requisitionIssue($requisition_issue, $form_process);
            DB::commit();
            return $requisition_issue;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RequisitionIssue  $requisitionIssue
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $attach = 'form_process, end_user, form_routes.to_office, form_routes.processed_by.user_information, form_routes.forwarded_by.user_information, form_routes.from_office, form_uploads, items.unit_of_measure';
        $this->requisitionIssueRepository->attach($attach);
        $requisition_isse = $this->requisitionIssueRepository->getById($id);
        // return $requisition_isse;
        return fractal($requisition_isse, new RequisitionIssueTransformer)->parseIncludes($attach);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RequisitionIssue  $requisitionIssue
     * @return \Illuminate\Http\Response
     */
    public function edit(RequisitionIssue $requisitionIssue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RequisitionIssue  $requisitionIssue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();
            $requisition_issue = $this->requisitionIssueRepository->updateRequisitionIssue($id, $data);
            DB::commit();
            return $requisition_issue;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RequisitionIssue  $requisitionIssue
     * @return \Illuminate\Http\Response
     */
    public function destroy(RequisitionIssue $requisitionIssue)
    {
        //
    }

    public function pdf(Request $request, $uuid)
    {
        $requisition_issue = $this->requisitionIssueRepository->attach('end_user,items.unit_of_measure')->getByUuid($uuid);
        $requisition_issue = fractal($requisition_issue, new RequisitionIssueTransformer)->parseIncludes('end_user,items.unit_of_measure')->toArray();
        // return $requisition_issue;
        $config = [
            'instanceConfigurator' => function($mpdf) {
                $mpdf->AddPage('P');
                $mpdf->setFooter('Page {PAGENO} of {nbpg}');
            },
            'margin_left' => 6.35,
            'margin_right' => 6.35,
            'margin_top' => 6.35,
            // 'margin_bottom' => 0,
            // 'margin_header' => 50,
            // 'margin_footer' => 0,
        ];
        $pdf = FacadesPdf::loadView('pdf.requisition-and-issue-slip', $requisition_issue, [], $config);
/*         $pdf->shrink_tables_to_fit = 1.4;
        $pdf->use_kwt = true; */
        // $pdf->AddPage('P');
        // $pdf->setFooter('Page {PAGENO} of {nbpg}');
        return $pdf->stream('purchase-request-'.'1111'.'.pdf');
        return $pdf->download('purchase-request-'.'1111'.'.pdf');
    }
}
