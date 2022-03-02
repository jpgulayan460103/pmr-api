<?php

namespace App\Http\Controllers;

use App\Models\FormUpload;
use Illuminate\Http\Request;
use App\Transformers\FormUploadTransformer;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\FormUploadRequest;

class FormUploadController extends Controller
{
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
    public function store(FormUploadRequest $request)
    {
        foreach ($request->file('files') as $file) {
            $path = Storage::putFile('avatars', $file);
        }
        return $request->all();
        // echo $path;
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
    public function destroy(FormUpload $formUpload)
    {
        //
    }
}
