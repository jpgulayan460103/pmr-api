<?php

namespace App\Http\Controllers;

use App\Models\FormRoute;
use App\Repositories\FormRouteRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormRouteController extends Controller
{

    private $formRouteRepository;

    public function __construct(FormRouteRepository $formRouteRepository)
    {
        $this->formRouteRepository = $formRouteRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     //
    // }

    public function index(Request $request)
    {
        $user = Auth::user();
        $offices_ids = $user->signatories->pluck('office_id');
        $filters['offices_ids'] = $offices_ids;

        return $this->formRouteRepository->modelQuery();
        return $this->modelQuery()->get();
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
     * @param  \App\Models\FormRoute  $formRoute
     * @return \Illuminate\Http\Response
     */
    public function show(FormRoute $formRoute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FormRoute  $formRoute
     * @return \Illuminate\Http\Response
     */
    public function edit(FormRoute $formRoute)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FormRoute  $formRoute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FormRoute $formRoute)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FormRoute  $formRoute
     * @return \Illuminate\Http\Response
     */
    public function destroy(FormRoute $formRoute)
    {
        //
    }
}
