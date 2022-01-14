<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePurchaseRequest;
use App\Models\PurchaseRequest;
use App\Transformers\PurchaseRequestTransformer;
use App\Repositories\LibraryRepository;
use App\Repositories\SignatoryRepository;
use App\Repositories\PurchaseRequestRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use niklasravnsborg\LaravelPdf\Facades\Pdf as FacadesPdf;
use PDF;

class PurchaseRequestController extends Controller
{

    private $purchaseRequestRepository;

    public function __construct(PurchaseRequestRepository $purchaseRequestRepository)
    {
        $this->purchaseRequestRepository = $purchaseRequestRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filters = [];
        $user = Auth::user();
        $offices_ids = $user->signatories->pluck('office_id');
        $filters['offices_ids'] = $offices_ids;
        $this->purchaseRequestRepository->attach('form_process,end_user');
        $purchase_request = $this->purchaseRequestRepository->search($request, $filters);
        // return $purchase_request;
        return fractal($purchase_request, new PurchaseRequestTransformer)->parseIncludes('form_process, end_user');
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
        $created_purchase_request = $this->purchaseRequestRepository->createPurchaseRequest($request);
        return $created_purchase_request;
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PurchaseRequest  $purchaseRequest
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $attach = "form_process, items.unit_of_measure, end_user, requested_by.user.user_information, approved_by.user.user_information";
        $this->purchaseRequestRepository->attach($attach);
        $purchase_request = $this->purchaseRequestRepository->getById($id);
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
    public function update(Request $request, PurchaseRequest $purchaseRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
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
        $count = 0;
        foreach ($purchase_request['items']['data'] as $key => $item) {
            $count++;
            $count += substr_count($item['item_name'],"\n");
        }
        $purchase_request['count_items'] = $count;
        $pdf = PDF::loadView('pdf.purchase-request',$purchase_request);
        $pdf->shrink_tables_to_fit = 1.4;
        $pdf->use_kwt = true;
        if($request->view){
            return $pdf->stream('purchase-request-'.$purchase_request['purchase_request_uuid'].'.pdf');
        }
        return $pdf->download('purchase-request-'.$purchase_request['purchase_request_uuid'].'.pdf');
    }

    public function validatePdfPreview(CreatePurchaseRequest $request)
    {
        return [
            'url' => route('api.purchase-requests.pdf.preview')
        ];
    }


    public function generatePdfPreview(Request $request)
    {
        $json = $request->json;
        $purchase_request_preview = json_decode($json, true);
        $purchase_request_preview['end_user'] = (new LibraryRepository)->getById($purchase_request_preview['end_user_id']);
        $purchase_request_preview['view'] = "preview";
        $count = 0;
        $items = $purchase_request_preview['items'];
        unset($purchase_request_preview['items']);
        $purchase_request_preview['items']['data'] = $items;
        foreach ($purchase_request_preview['items']['data'] as $key => $item) {
            $count++;
            $count += substr_count($item['item_name'],"\n");
            if($purchase_request_preview['items']['data'][$key]['unit_of_measure_id'] == null){
                return $purchase_request_preview['items']['data'][$key]['unit_of_measure_id'];
            }
            $purchase_request_preview['items']['data'][$key]['unit_of_measure'] = (new LibraryRepository)->getById($purchase_request_preview['items']['data'][$key]['unit_of_measure_id']);
        }
        
        $purchase_request_preview['requested_by'] = (new SignatoryRepository)->attach('user.user_information')->getBy('signatory_type', $purchase_request_preview['requestedBy']);
        $purchase_request_preview['approved_by'] = (new SignatoryRepository)->attach('user.user_information')->getBy('signatory_type', $purchase_request_preview['approvedBy']);
        $purchase_request_preview['count_items'] = $count;
        $pdf = FacadesPdf::loadView('pdf.purchase-request',$purchase_request_preview);
        $pdf->shrink_tables_to_fit = 1.4;
        $pdf->use_kwt = true;
        return $pdf->stream('purchase-request-preview.pdf');
    }

    public function approve(Request $request, $id)
    {
        PurchaseRequest::find($id)->update(['status' => 'approved']);
    }
}
