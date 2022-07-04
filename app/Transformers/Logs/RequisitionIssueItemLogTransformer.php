<?php

namespace App\Transformers\Logs;

use App\Models\ActivityLog;
use League\Fractal\TransformerAbstract;

class RequisitionIssueItemLogTransformer extends TransformerAbstract
{
    protected $labels = [
        'requisition_issue_id' => 'requisition_issue_id',
        'procurement_plan_item_id' => 'procurement_plan_item_id',
        'unit_of_measure_id' => 'unit_of_measure_id',
        'description' => 'description',
        'remarks' => 'remarks',
        'item_id' => 'item_id',
        'request_quantity' => 'request_quantity',
        'issue_quantity' => 'issue_quantity',
        'has_stock' => 'has_stock',
        'has_issued_item' => 'has_issued_item',
        'is_pr_recommended' => 'is_pr_recommended',
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
