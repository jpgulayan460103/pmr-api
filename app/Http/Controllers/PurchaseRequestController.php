<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePurchaseRequest;
use App\Models\PurchaseRequest;
use App\Repositories\PurchaseRequestRepository;
use App\Transformers\PurchaseRequestTransformer;
use Illuminate\Http\Request;
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
        $purchase_request = $this->purchaseRequestRepository->getAll($request);
        return fractal($purchase_request, new PurchaseRequestTransformer);
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
        return $this->purchaseRequestRepository->createWithItems($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PurchaseRequest  $purchaseRequest
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $purchase_request = $this->purchaseRequestRepository->getByUuid($id);
        // return $purchase_request;
        return fractal($purchase_request, new PurchaseRequestTransformer)->parseIncludes('items.unit_of_measure,end_user')->toArray();
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

    public function pdf(Request $request, $id)
    {
        $purchase_request = $this->show($id);
        $count = 0;
        foreach ($purchase_request['items']['data'] as $key => $item) {
            $count++;
            $count += substr_count($item['item_name'],"\n");
        }
        // return $count;
        $purchase_request['count_items'] = $count;
        $pdf = PDF::loadView('pdf.purchase-request',$purchase_request);
        $pdf->shrink_tables_to_fit = 1.4;
        $pdf->use_kwt = true;
        // $pdf->setPaper('folio', 'portrait');
        // $pdf->loadView('pdf.purchase-request',$purchase_request);
        if($request->view){
            return $pdf->stream('purchase-request-'.$purchase_request['purchase_request_uuid'].'.pdf');
        }
        return $pdf->download('purchase-request-'.$purchase_request['purchase_request_uuid'].'.pdf');
    }

    public function approve(Request $request, $id)
    {
        PurchaseRequest::find($id)->update(['status' => 'approved']);
    }
}
