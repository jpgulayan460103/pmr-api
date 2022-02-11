<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\ActivityLog;
use App\Transformers\UserTransformer;

class PurchaseRequestLogTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $labels = [
        "sa_or" => "SA/OR",
        "pr_dir" => "pr_dir",
        "status" => "Status",
        "pr_date" => "PR Date",
        "purpose" => "Particulars",
        "charge_to" => "Charge To",
        "uacs_code" => "UACS Code",
        "total_cost" => "Total Cost",
        "center_code" => "Responsibility Center Code",
        "fund_cluster" => "Fund Cluster",
        "end_user.name" => "End User",
        "alloted_amount" => "ABC (PHP)",
        "purchase_request_uuid" => "UUID",
        "approved_by.name" => "Approved By",
        "purchase_request_number" => "PR Number",
        "mode_of_procurement.name" => "Mode of Procurement",
        "requested_by.name" => "Requested By",
        "purchase_request_type.name" => "Procurement Type",
        "purchase_request_type_id" => "purchase_request_type_id",
        "process_complete_date" => "process_complete_date",
        "process_complete_status" => "process_complete_status",
        "bac_task_id" => "bac_task_id",
        "end_user_id" => "end_user_id",
        "requested_by_id" => "requested_by_id",
        "approved_by_id" => "approved_by_id",
        "mode_of_procurement_id" => "mode_of_procurement_id",
        "id" => "id",
    ];
    protected $defaultIncludes = [
        //
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'user'
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
        ];
    }

    public function addLabels($properties)
    {
        // return json_decode($properties, true);
        $properties = json_decode($properties, true);
        $properties['changes'] = [];
        foreach ($properties['attributes'] as $key => $property) {
            $properties['changes'][] = [
                'label' => $this->labels[$key],
                'key' => $this->labels[$key],
                'old' => isset($properties['old'][$key]) ? $properties['old'][$key] : "",
                'new' => isset($properties['attributes'][$key]) ? $properties['attributes'][$key] : "",
            ];
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
}
