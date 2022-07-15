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
        'pr_number' => 'PR Number',
        'purpose' => 'Purpose',
        'title' => 'Title',
        'fund_cluster' => 'Fund Cluster',
        'center_code' => 'Responsibility Center Code',
        'total_cost' => 'Total Cost',
        // 'pr_dir' => 'pr_dir',
        // 'end_user_id' => 'end_user_id',
        // 'account_id' => 'account_id',
        // 'status' => 'status',
        'remarks' => 'Remarks',
        'pr_date' => 'PR Date',
        // 'mode_of_procurement_id' => 'mode_of_procurement_id',
        // 'uacs_code_id' => 'uacs_code_id',
        'charge_to' => 'Charge To',
        'alloted_amount' => 'Alloted Amount',
        'sa_or' => 'SA/OR',
        // 'bac_task_id' => 'bac_task_id',    
        // 'requested_by_id' => 'requested_by_id',
        'requested_by_name' => 'Requested By Name',
        'requested_by_designation' => 'Requested By Designation',
        // 'approved_by_id' => 'approved_by_id',
        'approved_by_name' => 'Approved By Name',
        'approved_by_designation' => 'Approved By Designation',
        // 'created_by_id' => 'created_by_id',
        'acount.name' => 'Account',
        'from_ppmp' => 'From PPMP',
        'mode_of_procurement.name' => 'Mode of Procurement',
        'end_user.name' => 'End-User',
        'uacs_code.name' => 'UACS Code',
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
