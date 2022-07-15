<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRequisitionIssueRequest;
use App\Http\Requests\UpdateRequisitionIssueRequest;
use App\Models\RequisitionIssue;
use App\Repositories\ActivityLogBatchRepository;
use App\Repositories\FormProcessRepository;
use App\Repositories\FormRouteRepository;
use App\Repositories\RequisitionIssueRepository;
use App\Transformers\RequisitionIssueTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use niklasravnsborg\LaravelPdf\Facades\Pdf as FacadesPdf;
use Spatie\Activitylog\Facades\LogBatch;

class RequisitionIssueController extends Controller
{
    private $requisitionIssueRepository;

    public function __construct(RequisitionIssueRepository $requisitionIssueRepository)
    {
        $this->requisitionIssueRepository = $requisitionIssueRepository;
        $this->middleware('auth:api', [
            'except' => [
                'pdf',
            ]
        ]);
        $this->middleware('role_or_permission:super-admin|admin|requisition.issue.create', ['only' => ['store']]);
        $this->middleware('role_or_permission:super-admin|admin|requisition.issue.update',   ['only' => ['update']]);
        $this->middleware('role_or_permission:super-admin|admin|requisition.issue.view',   ['only' => ['show', 'index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $offices_ids = $user->user_offices->pluck('office_id');
        $filters['offices_ids'] = $offices_ids;
        if($user->hasRole('super-admin')){
            unset($filters['offices_ids']);
        }
        $attach = 'form_process,form_routes, form_uploads, end_user, items';
        $this->requisitionIssueRepository->attach($attach);
        $procurement_plans = $this->requisitionIssueRepository->search($filters);
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
            (new ActivityLogBatchRepository())->startBatch();
            $data = $request->all();
            $items = $this->requisitionIssueRepository->addItems();
            $requisition_issue = $this->requisitionIssueRepository->create($data);
            $requisition_issue->items()->saveMany($items['items']);
            $form_process = (new FormProcessRepository())->requisitionIssue($requisition_issue);
            $form_route = (new FormRouteRepository())->requisitionIssue($requisition_issue, $form_process);
            if($requisition_issue->from_ppmp == 1){
                $requisition_issue = $this->requisitionIssueRepository->attachProcurementPlan($requisition_issue);
            }
            (new ActivityLogBatchRepository())->endBatch($requisition_issue);
            DB::commit();
            return $requisition_issue;
        } catch (\Throwable $th) {
            (new ActivityLogBatchRepository())->deleteBatch();
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
        $attach = 'form_process, end_user, form_routes.to_office, form_routes.processed_by.user_information, form_routes.forwarded_by.user_information, form_routes.from_office, form_uploads, items.unit_of_measure, items.item, items.procurement_plan_item';
        $this->requisitionIssueRepository->attach($attach);
        $requisition_issue = $this->requisitionIssueRepository->getById($id);
        // return $requisition_issue;
        return fractal($requisition_issue, new RequisitionIssueTransformer)->parseIncludes($attach);
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
    public function update(UpdateRequisitionIssueRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            (new ActivityLogBatchRepository())->startBatch();
            $data = $request->all();
            $requisition_issue = $this->requisitionIssueRepository->updateRequisitionIssue($id, $data);
            (new ActivityLogBatchRepository())->endBatch($requisition_issue);
            DB::commit();
            return $requisition_issue;
        } catch (\Throwable $th) {
            (new ActivityLogBatchRepository())->deleteBatch();
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

        $count = 0;
        foreach ($requisition_issue['items']['data'] as $key => $item) {
            $count++;
            $count += substr_count($item['description'],"\n");
        }
        $requisition_issue['count_items'] = $count;
        // return $requisition_issue;
        $config = [
            'instanceConfigurator' => function($mpdf) {
                $mpdf->AddPage('P');
                $mpdf->setFooter('Page {PAGENO} of {nbpg}');
            },
            'margin_left' => 6.35,
            'margin_right' => 6.35,
            'margin_top' => 6.35,
        ];
        $pdf = FacadesPdf::loadView('pdf.requisition-and-issue-slip', $requisition_issue, [], $config);
        if($request['view']){
            return $pdf->stream('PMS-requisition-and-issue-slip-'.$requisition_issue['form_number'].'.pdf');
        }
        return $pdf->download('PMS-requisition-and-issue-slip-'.$requisition_issue['form_number'].'.pdf');
    }
}
