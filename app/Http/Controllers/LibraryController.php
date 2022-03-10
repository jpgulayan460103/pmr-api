<?php

namespace App\Http\Controllers;

use App\Models\Library;
use App\Models\Item;
use App\Repositories\ItemRepository;
use App\Transformers\ItemTransformer;
use App\Transformers\LibraryTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        DB::enableQueryLog();
        $library = Library::with('parent','children')->orderBy('library_type')->orderBy('name')->get();
        // return DB::getQueryLog();
        // return $library;
        return fractal($library, new LibraryTransformer)->parseIncludes('children');
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
    public function store(Request $request, $type)
    {
        $library = Library::create([
            'library_type' => $type,
            'name' => $request->name,
            'title' => $request->title,
            'parent_id' => $request->parent_id,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Library  $library
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Library $library, $type)
    {
        if($type == "items"){
            $itemRepository = new ItemRepository(new Item);
            $item = $itemRepository->getAll($request);
            return fractal($item, new ItemTransformer)->parseIncludes('unit_of_measure,item_category');
        }
        $library = $library->orderBy('name')->whereLibraryType($type)->get();
        return fractal($library, new LibraryTransformer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Library  $library
     * @return \Illuminate\Http\Response
     */
    public function edit(Library $library)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Library  $library
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $type, $id)
    {
        $library = Library::where('library_type', $type)->where('id',$id)->first();
        $library->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Library  $library
     * @return \Illuminate\Http\Response
     */
    public function destroy(Library $library)
    {
        //
    }
}
