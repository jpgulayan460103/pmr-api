<?php

namespace App\Transformers;

use App\Models\FormUpload;
use League\Fractal\TransformerAbstract;

class FormUploadTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'uploader'
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(FormUpload $formUpload)
    {
        return [
            'id' => $formUpload->id,
            'key' => $formUpload->id,
            'upload_uuid' => $formUpload->upload_uuid,
            'upload_type' => $formUpload->upload_type,
            'title' => $formUpload->title,
            'filename' => $formUpload->filename,
            'filesize' => $formUpload->filesize,
            'file_directory' => url($formUpload->file_directory),
            'user_id' => $formUpload->user_id,
            'form_uploadable_id' => $formUpload->form_uploadable_id,
            'form_uploadable_type' => $formUpload->form_uploadable_type,
            'created_at' => $formUpload->created_at->toDayDateTimeString(),
        ];
    }

    public function includeUploader(FormUpload $formUpload)
    {
        if ($formUpload->uploader) {
            return $this->item($formUpload->uploader, new UserTransformer);
        }
    }
}
