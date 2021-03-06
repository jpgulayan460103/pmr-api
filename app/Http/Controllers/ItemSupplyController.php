<?php

namespace App\Http\Controllers;

use App\Models\ItemSupply;
use App\Repositories\ItemSupplyRepository;
use App\Transformers\ItemSupplyTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemSupplyController extends Controller
{

    private $itemSupplyRepository;

    public function __construct(ItemSupplyRepository $itemSupplyRepository)
    {
        $this->itemSupplyRepository = $itemSupplyRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attach = "remaining_quantity, unit_of_measure, item_category";
        $this->itemSupplyRepository->attach($attach);
        $item_supplies = $this->itemSupplyRepository->search();
        $item_supplies = fractal($item_supplies, new ItemSupplyTransformer)->parseIncludes($attach);
        // return $item_supplies;
        return $item_supplies;
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
     * @param  \App\Models\ItemSupply  $itemSupply
     * @return \Illuminate\Http\Response
     */
    public function show(ItemSupply $itemSupply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ItemSupply  $itemSupply
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemSupply $itemSupply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ItemSupply  $itemSupply
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemSupply $itemSupply)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemSupply  $itemSupply
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemSupply $itemSupply)
    {
        //
    }
}
