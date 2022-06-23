<?php

namespace App\Transformers\Logs;

use League\Fractal\TransformerAbstract;
use App\Models\ActivityLog;
use App\Transformers\UserTransformer;
use App\Transformers\ProcurementPlanTransformer;

class ProcurementPlanLogTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $labels = [
        "title" => "Title",
        "purpose" => "Purpose",
        "remarks" => "Remarks",
        "inflation" => "Inflation",
        "contingency" => "Contingency",
        "total_price" => "Total Amount",
        "total_estimated_budget" => "Total Estimated Budget",
        "ppmp_date" => "PPMP Date",
        "ppmp_number" => "PPMP Number",
        "calendar_year" => "CY",
        "end_user.name" => "End User",
        "item_type.name" => "Item Type",
        "prepared_by_name" => "Prepared by name",
        "prepared_by_designation" => "Prepared by name",
        "approved_by_name" => "Approved by name",
        "approved_by_designation" => "Approved by name",
        "certified_by_name" => "Certified by name",
        "certified_by_designation" => "Certified by name",
        "procurement_plan_type" => "Procurement Plan Type",
        "id" => "id",
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
        if(isset($properties['attributes']) && $properties['attributes'] != array()){
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
            return $this->item($table->subject, new ProcurementPlanTransformer);
        }
    }
}
