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
        $user = Auth::user();
        if(!$user->hasPermissionTo($this->formUploadRepository->permissions($type))){
            abort(403);
        }
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
    public function destroy($type, $id)
    {
        $user = Auth::user();
        if(!$user->hasPermissionTo($this->formUploadRepository->permissions($type))){
            abort(403);
        }
        $form_upload = $this->formUploadRepository->getById($id);
        (new ActivityLogBatchRepository())->startBatch();
        $form = $this->formUploadRepository->getForm($type, $form_upload->form_uploadable_id);
        $this->formUploadRepository->delete($id);
        (new ActivityLogBatchRepository())->endBatch($form);
    }

    public function download($uuid)
    {
        return $this->formUploadRepository->download($uuid);
    }
}
