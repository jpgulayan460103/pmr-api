<?php

namespace App\Http\Controllers;

use App\Models\FormUpload;
use Illuminate\Http\Request;
use App\Transformers\FormUploadTransformer;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\FormUploadRequest;
use App\Models\PurchaseRequest;
use App\Repositories\FormUploadRepository;
use Illuminate\Support\Facades\Auth;

class FormUploadController extends Controller
{
    private $formUploadRepository;

    public function __construct(FormUploadRepository $formUploadRepository)
    {
        $this->formUploadRepository = $formUploadRepository;
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
    public function store(FormUploadRequest $request, $type, $id)
    {
        $url = $this->formUploadRepository->upload($type, $id);
        return $url;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FormUpload  $formUpload
     * @return \Illuminate\Http\Response
     */
    public function show(FormUpload $formUpload)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FormUpload  $formUpload
     * @return \Illuminate\Http\Response
     */
    public function edit(FormUpload $formUpload)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FormUpload  $formUpload
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FormUpload $formUpload)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FormUpload  $formUpload
     * @return \Illuminate\Http\Response
     */
    public function destroy($type,$id)
    {
        $this->formUploadRepository->delete($id);
    }
}
