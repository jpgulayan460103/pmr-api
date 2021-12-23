<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Repositories\ItemRepository;
use App\Transformers\ItemTransformer;

class ItemController extends Controller
{

    private $itemRepository;

    public function __construct(ItemRepository $itemRepository)
    {
        $this->itemRepository = $itemRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = $this->itemRepository->getAllPaginated($request);
        return fractal($items, new ItemTransformer)->parseIncludes('unit_of_measure,item_category');
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
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = $this->itemRepository->getById($id);
        return fractal($item, new ItemTransformer)->parseIncludes('unit_of_measure,item_category');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
    }

    public function all(Request $request)
    {
        $item = $this->itemRepository->getAll($request);
        return fractal($item, new ItemTransformer)->parseIncludes('unit_of_measure,item_category');
    }
}
