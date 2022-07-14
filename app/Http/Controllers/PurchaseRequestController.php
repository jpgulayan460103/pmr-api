<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use App\Models\PurchaseRequest;
use App\Repositories\ActivityLogBatchRepository;
use App\Repositories\FormProcessRepository;
use App\Repositories\FormRouteRepository;
use App\Transformers\PurchaseRequestTransformer;
use App\Repositories\LibraryRepository;
use App\Repositories\PurchaseRequestRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use niklasravnsborg\LaravelPdf\Facades\Pdf as FacadesPdf;
use Spatie\Activitylog\Facades\LogBatch;

class PurchaseRequestController extends Controller
{

    private $purchaseRequestRepository;

    public function __construct(PurchaseRequestRepository $purchaseRequestRepository)
    {
        $this->purchaseRequestRepository = $purchaseRequestRepository;
        $this->middleware('auth:api', [
            'except' => [
                'pdf',
                'validatePdfPreview',
                'generatePdfPreview',
            ]
        ]);
        $this->middleware('role_or_permission:super-admin|admin|purchase.request.create', ['only' => ['store']]);
        $this->middleware('role_or_permission:super-admin|admin|purchase.request.update',   ['only' => ['update']]);
        $this->middleware('role_or_permission:super-admin|admin|purchase.request.view|procurement.view',   ['only' => ['show', 'index']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $attach = 'end_user, account, mode_of_procurement, uacs_code, created_by.user_information';
        $filters = [];
        if(request('type') == "all"){
        }elseif(request('type') == "procurement"){
            $filters['status'] = ['Approved'];
            $attach .= ",bac_task";
        }else{
            $user = Auth::user();
            $offices_ids = $user->user_offices->pluck('office_id');
            $filters['offices_ids'] = $offices_ids;
            if($user->hasRole('super-admin')){
                unset($filters['offices_ids']);
            }
        }
        $this->purchaseRequestRepository->attach($attach);
        $purchase_request = $this->purchaseRequestRepository->search($filters);
        // return $purchase_request;
        return fractal($purchase_request, new PurchaseRequestTransformer)->parseIncludes($attach);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePurchaseRequest $request)
    {
        DB::beginTransaction();
        try {
            (new ActivityLogBatchRepository())->startBatch();
            $items = $this->purchaseRequestRepository->addItems();
            $data = $request->all();
            $data['total_cost'] = $items['total_cost'];
            $purchase_request = $this->purchaseRequestRepository->create($data);
            $purchase_request->items()->saveMany($items['items']);
            $formProcess = (new FormProcessRepository())->purchaseRequest($purchase_request);
            $formRoute = (new FormRouteRepository())->purchaseRequest($purchase_request, $formProcess);
            $purchase_request = $this->purchaseRequestRepository->attachRequistionIssue($purchase_request);
            $purchase_request->save();
            (new ActivityLogBatchRepository())->endBatch($purchase_request);
            DB::commit();
            return $purchase_request;
        } catch (\Throwable $th) {
            (new ActivityLogBatchRepository())->deleteBatch();
            throw $th;
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PurchaseRequest  $purchaseRequest
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // DB::enableQueryLog();
        $attach = "form_uploads.uploader.user_information, form_process, end_user, form_routes.to_office, form_routes.processed_by.user_information, form_routes.forwarded_by.user_information, form_routes.from_office, account, mode_of_procurement, uacs_code, items.unit_of_measure, bac_task";
        $this->purchaseRequestRepository->attach($attach);
        $purchase_request = $this->purchaseRequestRepository->getById($id);
        // return DB::getQueryLog();
        return fractal($purchase_request, new PurchaseRequestTransformer)->parseIncludes($attach)->toArray();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchaseRequest  $purchaseRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseRequest $purchaseRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PurchaseRequest  $purchaseRequest
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePurchaseRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            (new ActivityLogBatchRepository())->startBatch();
            $data = $request->all();
            $purchase_request = $this->purchaseRequestRepository->updatePurchaseRequest($id, $data);
            (new ActivityLogBatchRepository())->endBatch($purchase_request);
            DB::commit();
            return $purchase_request;
        } catch (\Throwable $th) {
            (new ActivityLogBatchRepository())->deleteBatch();
            throw $th;
        }
    }

    /**
     * Remove the spcified resource from storage.
     *
     * @param  \App\Models\PurchaseRequest  $purchaseRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseRequest $purchaseRequest)
    {
        //
    }

    public function pdf(Request $request, $uuid)
    {
        $purchase_request = $this->purchaseRequestRepository->getByUuid($uuid);
        $purchase_request = $this->show($purchase_request->id);
        // return $purchase_request;
        $count = 0;
        foreach ($purchase_request['items']['data'] as $key => $item) {
            $count++;
            $count += substr_count($item['item_name'],"\n");
        }
        $purchase_request['count_items'] = $count;
        $config = [
            'instanceConfigurator' => function($mpdf) {
                $mpdf->AddPage('P');
                $mpdf->setFooter('Page {PAGENO} of {nbpg}');
            },
            'margin_left' => 6.35,
            'margin_right' => 6.35,
            'margin_top' => 6.35,
        ];
        $pdf = FacadesPdf::loadView('pdf.purchase-request', $purchase_request, [], $config);
        // return $purchase_request;
        // return view('pdf.purchase-request', $purchase_request);
        if($request['view']){
            return $pdf->stream('purchase-request-'.$purchase_request['uuid'].'.pdf');
        }
        return $pdf->download('purchase-request-'.$purchase_request['uuid'].'.pdf');
    }

    public function validatePdfPreview(CreatePurchaseRequest $request)
    {
        return [
            'url' => route('api.purchase-requests.pdf.preview')
        ];
    }


    public function generatePdfPreview(Request $request)
    {
        $json = $request['json'];
        $purchase_request_preview = json_decode($json, true);
        $purchase_request_preview['end_user'] = (new LibraryRepository)->getById($purchase_request_preview['end_user_id']);
        $purchase_request_preview['view'] = "preview";
        $count = 0;
        $items = $purchase_request_preview['items'];
        unset($purchase_request_preview['items']);
        $purchase_request_preview['items']['data'] = $items;
        $purchase_request_preview['total_cost'] = 0;
        foreach ($purchase_request_preview['items']['data'] as $key => $item) {
            $count++;
            $count += substr_count($item['item_name'],"\n");
            $purchase_request_preview['total_cost'] += $item['total_unit_cost'];
            if($purchase_request_preview['items']['data'][$key]['unit_of_measure_id'] == null){
                return $purchase_request_preview['items']['data'][$key]['unit_of_measure_id'];
            }
            $purchase_request_preview['items']['data'][$key]['unit_of_measure'] = (new LibraryRepository)->getById($purchase_request_preview['items']['data'][$key]['unit_of_measure_id']);
        }
        
        $purchase_request_preview['requested_by'] = (new LibraryRepository)->getById($purchase_request_preview['requested_by_id']);
        $purchase_request_preview['approved_by'] = (new LibraryRepository)->getById($purchase_request_preview['approved_by_id']);
        $purchase_request_preview['count_items'] = $count;
        // $purchase_request_preview['form_process'] = [];
        // return $purchase_request_preview;
        $pdf = FacadesPdf::loadView('pdf.purchase-request',$purchase_request_preview);
        $pdf->shrink_tables_to_fit = 1.4;
        $pdf->use_kwt = true;
        // $pdf->save('sad.pdf');
        return $pdf->stream('purchase-request-preview.pdf');
    }

    public function updateBacTasks(Request $request, $id)
    {
        return $this->purchaseRequestRepository->createOrUpdateBac($request->all());
    }

    public function getNextNumber(Request $request)
    {
        $purchase_request = $this->purchaseRequestRepository->getLastNumber();
        if(!$purchase_request){
            return [
                'next_number' => "00001"
            ];
        }
        $pr_number_exploded = explode("-", $purchase_request->pr_number);
        $last_number = (integer)last($pr_number_exploded);
        // return $last_number;
        return [
            'next_number' => str_pad(++$last_number,5,"0",STR_PAD_LEFT)
        ];
    }
}
