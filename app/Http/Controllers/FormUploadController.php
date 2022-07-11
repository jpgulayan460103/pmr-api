<?php

namespace App\Http\Controllers;

use App\Models\FormUpload;
use Illuminate\Http\Request;
use App\Transformers\FormUploadTransformer;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\FormUploadRequest;
use App\Models\PurchaseRequest;
use App\Repositories\ActivityLogBatchRepository;
use App\Repositories\FormUploadRepository;
use Illuminate\Support\Facades\Auth;

class FormUploadController extends Controller
{
    private $formUploadRepository;

    public function __construct(FormUploadRepository $formUploadRepository)
    {
        $this->formUploadRepository = $formUploadRepository;
        $this->middleware('auth:api', [
            'except' => [
                'download',
            ]
        ]);
        $this->middleware('role_or_permission:super-admin|admin|purchase.requests.attachments.create',   ['only' => ['store']]);
        $this->middleware('role_or_permission:super-admin|admin|purchase.requests.attachments.view',   ['only' => ['show', 'index']]);
        $this->middleware('role_or_permission:super-admin|admin|purchase.requests.attachments.delete',   ['only' => ['destroy']]);
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
        (new ActivityLogBatchRepository())->startBatch();
        $upload = $this->formUploadRepository->upload($type, $id);
        (new ActivityLogBatchRepository())->endBatch($upload['form']);
        return $upload;
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

    public function download($uuid)
    {
        return $this->formUploadRepository->download($uuid);
    }
}
