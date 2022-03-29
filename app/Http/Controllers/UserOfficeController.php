<?php

namespace App\Http\Controllers;

use App\Models\UserOffice;
use App\Repositories\UserRepository;
use App\Transformers\UserOfficeTransformer;
use Illuminate\Http\Request;

class UserOfficeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_offices =  (new UserRepository())->getOffices();
        return fractal($user_offices, new UserOfficeTransformer)->parseIncludes('user.user_information,office');

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
     * @param  \App\Models\UserOffice  $user_offices
     * @return \Illuminate\Http\Response
     */
    public function show(UserOffice $user_offices)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserOffice  $user_offices
     * @return \Illuminate\Http\Response
     */
    public function edit(UserOffice $user_offices)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserOffice  $user_offices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserOffice $user_offices)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserOffice  $user_offices
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserOffice $user_offices)
    {
        //
    }
}
