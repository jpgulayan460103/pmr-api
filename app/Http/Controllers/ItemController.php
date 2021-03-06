<?php

namespace App\Http\Controllers;

use App\Models\FormProcess;
use App\Models\Item;
use App\Models\Library;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\ItemRepository;
use App\Transformers\ItemTransformer;

class ItemController extends Controller
{

    private $itemRepository;

    public function __construct(ItemRepository $itemRepository)
    {
        $this->itemRepository = $itemRepository;
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = $this->itemRepository->getAllPaginated();
        return fractal($items, new ItemTransformer)->parseIncludes('unit_of_measure,item_category,item_type');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $office = Library::where('library_type','user_section')->where('title','ICTMS')->get();
        // return $office;

        $process = FormProcess::with('routes')->get();
        return $process;
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
    public function update(Request $request, $id)
    {
        $this->itemRepository->update($id, $request->all());
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
        $item = $this->itemRepository->getAll();
        return fractal($item, new ItemTransformer)->parseIncludes('unit_of_measure,item_category');
    }
}
