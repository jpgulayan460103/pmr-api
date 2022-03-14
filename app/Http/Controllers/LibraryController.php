<?php

namespace App\Http\Controllers;

use App\Models\Library;
use App\Models\Item;
use App\Repositories\ItemRepository;
use App\Repositories\LibraryRepository;
use App\Transformers\ItemTransformer;
use App\Transformers\LibraryTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class LibraryController extends Controller
{

    private $libraryRepository;
    public function __construct(LibraryRepository $libraryRepository)
    {
        $this->libraryRepository = $libraryRepository;
        $this->middleware('auth:api', ['only' => ['store', 'update']]);
        $this->middleware('role:super-admin', ['only' => ['store', 'update']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($librariesRedis = Redis::get('libraries.all')) {
            return json_decode($librariesRedis);
        }
        return (new LibraryRepository)->cacheRedis();
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
        $data = [
            'library_type' => $type,
            'name' => $request->name,
            'title' => $request->title,
            'parent_id' => $request->parent_id,
        ];
        $library = $this->libraryRepository->create($data);
        
        (new LibraryRepository)->cacheRedis();

        return $library;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Library  $library
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $type)
    {
        if($type == "items"){
            return $this->showItems($request);
        }
        $library = $this->libraryRepository->getBy('library_type', $type);
        return fractal($library, new LibraryTransformer)->parseIncludes('children');
    }

    public function showItems(Request $request)
    {
        if ($itemsRedis = Redis::get('libraries.items')) {
            return json_decode($itemsRedis);
        }
        $items = (new ItemRepository)->getAll();
        $items = fractal($items, new ItemTransformer)->parseIncludes('unit_of_measure,item_category');
        Redis::set('libraries.items', $items->toJson());
        return $items;


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
        $this->libraryRepository->update($id, $request->all());
        return (new LibraryRepository)->cacheRedis();
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
