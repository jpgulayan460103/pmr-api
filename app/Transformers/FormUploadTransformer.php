<?php

namespace App\Transformers;

use App\Models\FormUpload;
use League\Fractal\TransformerAbstract;
use App\Transformers\PurchaseRequestTransformer;
use App\Transformers\UserTransformer;
use Illuminate\Support\Facades\Storage;

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
    public function transform(FormUpload $table)
    {
        return [
            'id' => $table->id,
            'key' => $table->id,
            'uuid' => $table->uuid,
            // 'disk' => $table->disk,
            'upload_type' => $table->upload_type,
            'title' => $table->title,
            'display_log' => $table->title,
            'filename' => $table->filename,
            'filesize' => $table->filesize,
            // 'file_directory' => url($table->file_directory),
            'file_directory' => route('api.downloads.form-uploads', ['id' => $table->uuid]),
            'user_id' => $table->user_id,
            'is_removable' => $table->is_removable == 1,
            'form_type' => $table->form_type,
            'form_uploadable_id' => $table->form_uploadable_id,
            'form_uploadable_type' => $table->form_uploadable_type,
            'form_attached' => $table->form_attached,
            'form_attachable_id' => $table->form_attachable_id,
            'form_attachable_type' => $table->form_attachable_type,
            'created_at' => $table->created_at->toDayDateTimeString(),
            'parent_id' => $table->parent_id,
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
            switch ($formUpload->form_type) {
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
