<?php

namespace App\Transformers\Logs;

use League\Fractal\TransformerAbstract;
use App\Models\ActivityLog;

class RequisitionIssueLogTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    public $labels = [
        'title' => 'Title',
        'fund_cluster' => 'Fund Clust',
        'center_code' => 'Responsibility Center Code',
        'purpose' => 'Purpose',
        'recommendation' => 'Recommendation',
        'ris_date' => 'RIS Date',
        'ris_number' => 'RIS Number',
        'from_ppmp' => 'From PPMP',
        'status' => 'Status',
        'remarks' => 'Remarks',
        // 'created_by_id' => 'created_by_id',
        // 'end_user_id' => 'end_user_id',
        // 'requested_by_id' => 'requested_by_id',
        'requested_by_name' => 'Requested By Name',
        'requested_by_designation' => 'Requested By Designation',
        'requested_by_date' => 'Requested By Date',
        // 'approved_by_id' => 'approved_by_id',
        'approved_by_name' => 'Approved By Name',
        'approved_by_designation' => 'Approved By Designation',
        'approved_by_date' => 'Approved By Date',
        'issued_by_name' => 'Issued By Name',
        'issued_by_designation' => 'Issued By Designation',
        'issued_by_date' => 'Issued By Date',
        'received_by_name' => 'Received By Name',
        'received_by_designation' => 'Received By Designation',
        'received_by_date' => 'Received By Date',
        'end_user.name' => 'End-User',
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
