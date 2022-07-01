<?php

namespace App\Transformers\Logs;

use League\Fractal\TransformerAbstract;
use App\Models\ActivityLog;
use App\Transformers\UserTransformer;
use App\Transformers\RequisitionIssueTransformer;

class RequisitionIssueLogTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $labels = [
        "title" => "title",
        "purpose" => "purpose",
        "remarks" => "remarks",
        "ris_date" => "ris_date",
        "from_ppmp" => "from_ppmp",
        "ris_number" => "ris_number",
        "center_code" => "center_code",
        "fund_cluster" => "fund_cluster",
        "created_by_id" => "created_by_id",
        "end_user.name" => "name",
        "approved_by_id" => "approved_by_id",
        "issued_by_date" => "issued_by_date",
        "issued_by_name" => "issued_by_name",
        "recommendation" => "recommendation",
        "requested_by_id" => "requested_by_id",
        "approved_by_date" => "approved_by_date",
        "approved_by_name" => "approved_by_name",
        "received_by_date" => "received_by_date",
        "received_by_name" => "received_by_name",
        "requested_by_date" => "requested_by_date",
        "requested_by_name" => "requested_by_name",
        "issued_by_designation" => "issued_by_designation",
        "approved_by_designation" => "approved_by_designation",
        "requested_by_designation" => "requested_by_designation",
    ];
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
            'properties' => $this->addLabels($activityLog->properties),
            'created_at' => $activityLog->created_at->toDateString(),
            'created_at_time' => $activityLog->created_at->toDayDateTimeString(),
        ];
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

    public function includeUser(ActivityLog $table)
    {
        if ($table->user) {
            return $this->item($table->user, new UserTransformer);
        }
    }
    public function includeSubject(ActivityLog $table)
    {
        if ($table->subject) {
            return $this->item($table->subject, new RequisitionIssueTransformer);
        }
    }
}
