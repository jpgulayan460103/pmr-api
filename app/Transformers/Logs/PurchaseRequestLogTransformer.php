<?php

namespace App\Transformers\Logs;

use League\Fractal\TransformerAbstract;
use App\Models\ActivityLog;

class PurchaseRequestLogTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    public $labels = [
        'uuid' => 'uuid',
        'pr_number' => 'pr_number',
        'purpose' => 'purpose',
        'title' => 'title',
        'fund_cluster' => 'fund_cluster',
        'center_code' => 'center_code',
        'total_cost' => 'total_cost',
        'pr_dir' => 'pr_dir',
        'end_user_id' => 'end_user_id',
        'account_id' => 'account_id',
        'status' => 'status',
        'remarks' => 'remarks',
        'pr_date' => 'pr_date',
        'mode_of_procurement_id' => 'mode_of_procurement_id',
        'uacs_code_id' => 'uacs_code_id',
        'charge_to' => 'charge_to',
        'alloted_amount' => 'alloted_amount',
        'sa_or' => 'sa_or',
        'bac_task_id' => 'bac_task_id',    
        'requested_by_id' => 'requested_by_id',
        'requested_by_name' => 'requested_by_name',
        'requested_by_designation' => 'requested_by_designation',
        'approved_by_id' => 'approved_by_id',
        'approved_by_name' => 'approved_by_name',
        'approved_by_designation' => 'approved_by_designation',
        'created_by_id' => 'created_by_id',
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
