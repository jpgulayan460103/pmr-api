<?php

namespace App\Transformers\Logs;

use App\Models\ActivityLog;
use App\Models\FormUpload;
use App\Transformers\FormRouteTransformer;
use App\Transformers\FormUploadTransformer;
use League\Fractal\TransformerAbstract;
use App\Transformers\PurchaseRequestTransformer;
use App\Transformers\UserTransformer;

class FormRouteLogTransformer extends TransformerAbstract
{
    protected $labels = [
        "status" => "Status",
        "remarks" => "Remarks",
        "user.name" => "Remarks By",
        "owner.name" => "Form Owner",
        "route_type" => "Form Type",
        "action_taken" => "Action Taken",
        "end_user.name" => "Form Owner Office",
        "to_office.name" => "Forwarded to Office",
        "from_office.name" => "Forwarded from Office",
        "forwarded_by.name" => "Forwarded By",
        "forwarded_remarks" => "Forwarded Remarks",
        "form_routable.uuid" => "Form UUID",
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
        'user',
        'subject'
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(ActivityLog $activityLog)
    {
        return [
            'key' => $activityLog->id,
            'id' => $activityLog->id,
            'log_name' => $activityLog->log_name,
            'description' => ucfirst($activityLog->description),
            'subject_type' => $activityLog->subject_type,
            'subject_id' => $activityLog->subject_id,
            'causer_type' => $activityLog->causer_type,
            'causer_id' => $activityLog->causer_id,
            'properties' => $this->addLabels($activityLog),
            'created_at' => $activityLog->created_at->toDateString(),
            'created_at_time' => $activityLog->created_at->toDayDateTimeString(),
        ];
    }

    public function addLabels($activityLog)
    {
        // return json_decode($properties, true);
        $properties = json_decode($activityLog->properties, true);
        $properties['changes'] = [];
        $logger = [];
        if($activityLog->description == "deleted"){
            $properties['old'] = $properties['attributes'];
            $logger = $properties['attributes'];
            unset($properties['attributes']);
        }else{
            $logger = $properties['attributes'];
        }
        foreach ($logger as $key => $property) {
            if(isset($this->labels[$key])){
                if($key == 'file_directory'){
                    $properties['changes'][] = [
                        'label' => $this->labels[$key],
                        'key' => "logger_$key",
                        'old' => isset($properties['old'][$key]) ? url($properties['old'][$key]) : "",
                        'new' => isset($properties['attributes'][$key]) ? url($properties['attributes'][$key]) : "",
                        'is_url' => true,
                    ];
                }else{
                    $properties['changes'][] = [
                        'label' => $this->labels[$key],
                        'key' => "logger_$key",
                        'old' => isset($properties['old'][$key]) ? $properties['old'][$key] : "",
                        'new' => isset($properties['attributes'][$key]) ? $properties['attributes'][$key] : "",
                        'is_url' => false,
                    ];
                }
            }
        }
        unset($properties['old']);
        unset($properties['attributes']);
        return $properties['changes'];
    }

    public function includeUser(ActivityLog $table)
    {
        if ($table->user) {
            return $this->item($table->user, new UserTransformer);
        }
    }
    public function includeSubject(ActivityLog $table)
    {
        if ($table->subject) {
            return $this->item($table->subject, new FormRouteTransformer);
        }
    }
}
