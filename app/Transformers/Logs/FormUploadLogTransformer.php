<?php

namespace App\Transformers\Logs;

use App\Models\ActivityLog;
use League\Fractal\TransformerAbstract;

class FormUploadLogTransformer extends TransformerAbstract
{
    public $labels = [
        // 'disk' => 'disk',
        // 'upload_type' => 'upload_type',
        'title' => 'Title',
        'filename' => 'Filname',
        'filesize' => 'Size',
        'file_directory' => 'URL',
        // 'user_id' => 'user_id',
        // 'form_type' => 'form_type',
        // 'form_uploadable_id' => 'form_uploadable_id',
        // 'form_uploadable_type' => 'form_uploadable_type',
        // 'form_attached' => 'form_attached',
        // 'form_attachable_id' => 'form_attachable_id',
        // 'form_attachable_type' => 'form_attachable_type',
        // 'is_removable' => 'is_removable',
        // 'parent_id' => 'parent_id',
    ];
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
    
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(ActivityLog $activityLog)
    {
        return [];
    }

}
