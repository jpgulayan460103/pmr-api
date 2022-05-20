<?php

namespace App\Transformers;

use App\Models\FormUpload;
use League\Fractal\TransformerAbstract;
use App\Transformers\PurchaseRequestTransformer;
use App\Transformers\UserTransformer;

class FormUploadTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [
        //
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected array $availableIncludes = [
        'uploader',
        'parent'
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
            'display_log' => $formUpload->title,
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

    public function includeParent(FormUpload $formUpload)
    {
        if ($formUpload->form_uploadable) {
            switch ($formUpload->upload_type) {
                case 'purchase_request':
                    return $this->item($formUpload->form_uploadable, new PurchaseRequestTransformer);
                    break;
                
                default:
                    # code...
                    break;
            }
        }
    }
    
}
