<?php

namespace App\Http\Controllers;

use App\Models\ItemSupplyHistory;
use App\Repositories\ItemSupplyHistoryRepository;
use App\Repositories\ItemSupplyRepository;
use App\Transformers\ItemSupplyTransformer;
use App\Transformers\ItemTransformer;
use Illuminate\Http\Request;
use niklasravnsborg\LaravelPdf\Facades\Pdf as FacadesPdf;

class ItemSupplyHistoryController extends Controller
{
    private $itemSupplyHistoryRepository;

    public function __construct(ItemSupplyHistoryRepository $itemSupplyHistoryRepository)
    {
        $this->itemSupplyHistoryRepository = $itemSupplyHistoryRepository;
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
     * @param  \App\Models\ItemSupplyHistory  $itemSupplyHistory
     * @return \Illuminate\Http\Response
     */
    public function show(ItemSupplyHistory $itemSupplyHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ItemSupplyHistory  $itemSupplyHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemSupplyHistory $itemSupplyHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ItemSupplyHistory  $itemSupplyHistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemSupplyHistory $itemSupplyHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemSupplyHistory  $itemSupplyHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemSupplyHistory $itemSupplyHistory)
    {
        //
    }

    public function pdf(Request $request, $uuid)
    {
        $itemSupplyRepository = new ItemSupplyRepository();
        $attach = 'item_supply_histories.form_sourceable.end_user';
        $itemSupplyRepository->attach($attach);
        $item = $itemSupplyRepository->getByUuid($uuid);
        $item = fractal($item, new ItemSupplyTransformer)->parseIncludes($attach)->toArray();
        // return $item;
        $pdf = FacadesPdf::loadView('pdf.stock-card', $item, [], []);
        // $pdf = FacadesPdf::loadView('pdf.procurement-plan', $procurement_plan, $config, $config);
        $pdf->shrink_tables_to_fit = 1.4;
        $pdf->use_kwt = true;
        // return $procurement_plan;
        // return view('pdf.purchase-request', $procurement_plan);
        if($request['view']){
            return $pdf->stream('stock-card-'.$item['uuid'].'.pdf');
        }
        // return $pdf->stream('stock-card-'.$item['uuid'].'.pdf');
        return $pdf->download('stock-card-'.$item['uuid'].'.pdf');
    }
}
