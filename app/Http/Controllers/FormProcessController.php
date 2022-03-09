<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateFormProcessRequest;
use App\Models\FormProcess;
use Illuminate\Http\Request;
use App\Repositories\FormProcessRepository;

class FormProcessController extends Controller
{

    private $formProcessRepository;

    public function __construct(FormProcessRepository $formProcessRepository)
    {
        $this->formProcessRepository = $formProcessRepository;
        $this->middleware('auth:api');
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
     * @param  \App\Models\FormProcess  $formProcess
     * @return \Illuminate\Http\Response
     */
    public function show(FormProcess $formProcess)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FormProcess  $formProcess
     * @return \Illuminate\Http\Response
     */
    public function edit(FormProcess $formProcess)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FormProcess  $formProcess
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFormProcessRequest $request, $id)
    {
        $type = "";
        if(request()->has("type") && request("type") == "twg"){
            $type = "twg";
        }
        return $this->formProcessRepository->updateRouting($id, $type);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FormProcess  $formProcess
     * @return \Illuminate\Http\Response
     */
    public function destroy(FormProcess $formProcess)
    {
        //
    }
}
