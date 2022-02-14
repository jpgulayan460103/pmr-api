<?php

namespace App\Transformers;

use App\Models\ActivityLog;
use League\Fractal\TransformerAbstract;
use App\Transformers\PurchaseRequestItemTransformer;

class PurchaseRequestItemLogTransformer extends TransformerAbstract
{
    protected $labels = [
        "item_id" => "Item ID",
        "quantity" => "Quantity",
        "item_code" => "Item Code",
        "item_name" => "Item Name",
        "unit_cost" => "Unit Cost",
        "total_unit_cost" => "Total Unit Cost",
        "unit_of_measure.name" => "Unit of Measure",
        "purchase_request_id" => "pr_id",
        "unit_of_measure_id" => "Unit of Measure",
        "deleted_at" => "Deleted At",
        "is_ppmp" => "Is in PPMP",
    ];
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
            if($key == 'is_ppmp'){
                $properties['changes'][] = [
                    'label' => $this->labels[$key],
                    'key' => $this->labels[$key],
                    'old' => isset($properties['old'][$key]) ? ($properties['old'][$key] == true ? "Yes" : "No") : "",
                    'new' => isset($properties['attributes'][$key]) ? ($properties['attributes'][$key] == true ? "Yes" : "No") : "",
                ];
            }else{
                $properties['changes'][] = [
                    'label' => $this->labels[$key],
                    'key' => $this->labels[$key],
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
            return $this->item($table->subject, new PurchaseRequestItemTransformer);
        }
    }
}
