<?php

namespace App\Http\Controllers;

use App\Models\FormUpload;
use Illuminate\Http\Request;
use App\Transformers\FormUploadTransformer;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\FormUploadRequest;
use App\Models\PurchaseRequest;
use Illuminate\Support\Facades\Auth;

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
    public function store(FormUploadRequest $request, $type, $id)
    {
        $user = Auth::user();
        $file = $request->file;
        $path = Storage::putFile('public/test', $file);
        $url = Storage::url($path);
        $classname = "";
        switch ($type) {
            case 'purchase-request':
                $classname = new PurchaseRequest;
                break;
            
            default:
                # code...
                break;
        }
        FormUpload::create([
            'upload_type' => $type,
            'title' => $request->meta['description'],
            'filename' => $file->getClientOriginalName(),
            'file_directory' => $url,
            'user_id' => $user->id,
            'form_uploadable_id' => $id,
            'form_uploadable_type' => get_class($classname),
        ]);
        return $url;
        return $path;
        return $request->all();
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
