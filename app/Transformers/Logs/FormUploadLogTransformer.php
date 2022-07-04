<?php

namespace App\Transformers\Logs;

use App\Models\ActivityLog;
use League\Fractal\TransformerAbstract;

class FormUploadLogTransformer extends TransformerAbstract
{
    protected $labels = [
        'disk' => 'disk',
        'upload_type' => 'upload_type',
        'title' => 'title',
        'filename' => 'filename',
        'filesize' => 'filesize',
        'file_directory' => 'file_directory',
        'user_id' => 'user_id',
        'form_type' => 'form_type',
        'form_uploadable_id' => 'form_uploadable_id',
        'form_uploadable_type' => 'form_uploadable_type',
        'form_attached' => 'form_attached',
        'form_attachable_id' => 'form_attachable_id',
        'form_attachable_type' => 'form_attachable_type',
        'is_removable' => 'is_removable',
        'parent_id' => 'parent_id',
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

    public function addLabels($properties)
    {
        // return json_decode($properties, true);
        $properties = json_decode($properties, true);
        $properties['changes'] = [];
        foreach ($properties['attributes'] as $key => $property) {
            if(isset($this->labels[$key])){
                $properties['changes'][] = [
                    'label' => $this->labels[$key],
                    'key' => "logger_$key",
                    'old' => isset($properties['old'][$key]) ? $properties['old'][$key] : "",
                    'new' => isset($properties['attributes'][$key]) ? $properties['attributes'][$key] : "",
                ];
            }
        }
        unset($properties['old']);
        unset($properties['attributes']);
        return $properties['changes'];
    }
}
