<?php

namespace App\Http\Controllers;

use App\Models\Library;
use App\Models\Item;
use App\Repositories\ItemRepository;
use App\Repositories\LibraryRepository;
use App\Repositories\UserRepository;
use App\Transformers\ItemTransformer;
use App\Transformers\LibraryTransformer;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class LibraryController extends Controller
{

    private $libraryRepository;
    public function __construct(LibraryRepository $libraryRepository)
    {
        $this->libraryRepository = $libraryRepository;
        $this->middleware('auth:api', ['only' => ['store', 'update', 'index']]);
        // $this->middleware('role:super-admin', ['only' => ['store', 'update']]);
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
        return (new LibraryRepository)->all();
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
        $user = Auth::user();
        if(!$user->hasPermissionTo($this->libraryRepository->permissions($type)."add")){
            return response()->json([
                'error_code' => 403,
                'message' => "You don't have permission to access or to make action to this resource."
            ], 403);
        }
        switch ($type) {
            case 'items':
                $itemRepository = new ItemRepository();
                $itemRepository->create($request->all());
                return (new LibraryRepository())->showItems(true);
                break;
            case 'users':
                return (new LibraryRepository())->showUsers();
                break;
            
            default:
                $data = [
                    'library_type' => $type,
                    'name' => $request->name,
                    'title' => $request->title,
                    'parent_id' => $request->parent_id,
                ];
                $this->libraryRepository->create($data);
                return (new LibraryRepository())->showLibrary($type, true);
                break;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Library  $library
     * @return \Illuminate\Http\Response
     */
    public function show($type)
    {
        switch ($type) {
            case 'items':
                return (new LibraryRepository())->showItems();
                break;
            case 'users':
                return (new LibraryRepository())->showUsers();
                break;
            
            default:
                return (new LibraryRepository())->showLibrary($type, true);
                break;
        }
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
        $user = Auth::user();
        if(request()->has('is_active')){
            if(!$user->hasPermissionTo($this->libraryRepository->permissions($type)."delete")){
                return response()->json([
                    'error_code' => 403,
                    'message' => "You don't have permission to access or to make action to this resource."
                ], 403);
            }
        }else{
            if(!$user->hasRole('super-admin') && !$user->hasPermissionTo($this->libraryRepository->permissions($type)."update")){
                return response()->json([
                    'error_code' => 403,
                    'message' => "You don't have permission to access or to make action to this resource."
                ], 403);
            }
        }
        switch ($type) {
            case 'items':
                $itemRepository = new ItemRepository();
                $itemRepository->update($id, $request->all());
                return (new LibraryRepository())->showItems(true);
                break;
            case 'users':
                return (new LibraryRepository())->showUsers();
                break;
            
            default:
                $this->libraryRepository->update($id, $request->all());
                return (new LibraryRepository)->all();
                return (new LibraryRepository())->showLibrary($type, true);
                break;
        }
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
