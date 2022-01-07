<?php

namespace App\Http\Controllers;

use App\Models\Signatory;
use Illuminate\Http\Request;
use App\Transformers\SignatoryTransformer;

class SignatoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $signatories =  Signatory::with('user.user_information','office')->get();
        return fractal($signatories, new SignatoryTransformer)->parseIncludes('user.user_information,office');

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
     * @param  \App\Models\Signatory  $signatories
     * @return \Illuminate\Http\Response
     */
    public function show(Signatory $signatories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Signatory  $signatories
     * @return \Illuminate\Http\Response
     */
    public function edit(Signatory $signatories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Signatory  $signatories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Signatory $signatories)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Signatory  $signatories
     * @return \Illuminate\Http\Response
     */
    public function destroy(Signatory $signatories)
    {
        //
    }
}
