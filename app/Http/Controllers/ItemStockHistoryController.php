<?php

namespace App\Http\Controllers;

use App\Models\ItemStockHistory;
use App\Repositories\ItemRepository;
use App\Repositories\ItemStockHistoryRepository;
use App\Transformers\ItemStockHistoryTransformer;
use App\Transformers\ItemTransformer;
use Illuminate\Http\Request;
use niklasravnsborg\LaravelPdf\Facades\Pdf as FacadesPdf;

class ItemStockHistoryController extends Controller
{
    private $itemStockHistoryRepository;

    public function __construct(ItemStockHistoryRepository $itemStockHistoryRepository)
    {
        $this->itemStockHistoryRepository = $itemStockHistoryRepository;
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ItemStockHistory  $itemStockHistory
     * @return \Illuminate\Http\Response
     */
    public function show(ItemStockHistory $itemStockHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ItemStockHistory  $itemStockHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemStockHistory $itemStockHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ItemStockHistory  $itemStockHistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemStockHistory $itemStockHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemStockHistory  $itemStockHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemStockHistory $itemStockHistory)
    {
        //
    }

    public function pdf(Request $request, $uuid)
    {
        $itemRepository = new ItemRepository();
        $itemRepository->attach('item_stock_histories,item_category,unit_of_measure');
        $item = $itemRepository->getByUuid($uuid);
        $item = fractal($item, new ItemTransformer)->parseIncludes('item_stock_histories,item_category,unit_of_measure')->toArray();
        // return $item;
        $pdf = FacadesPdf::loadView('pdf.stock-card', $item, [], []);
        // $pdf = FacadesPdf::loadView('pdf.procurement-plan', $procurement_plan, $config, $config);
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
