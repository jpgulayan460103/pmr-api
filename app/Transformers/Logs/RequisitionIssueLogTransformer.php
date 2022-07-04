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
        'title' => 'title',
        'fund_cluster' => 'fund_cluster',
        'center_code' => 'center_code',
        'purpose' => 'purpose',
        'recommendation' => 'recommendation',
        'ris_date' => 'ris_date',
        'ris_number' => 'ris_number',
        'from_ppmp' => 'from_ppmp',
        'status' => 'status',
        'remarks' => 'remarks',
        'created_by_id' => 'created_by_id',
        'end_user_id' => 'end_user_id',
        'requested_by_id' => 'requested_by_id',
        'requested_by_name' => 'requested_by_name',
        'requested_by_designation' => 'requested_by_designation',
        'requested_by_date' => 'requested_by_date',
        'approved_by_id' => 'approved_by_id',
        'approved_by_name' => 'approved_by_name',
        'approved_by_designation' => 'approved_by_designation',
        'approved_by_date' => 'approved_by_date',
        'issued_by_name' => 'issued_by_name',
        'issued_by_designation' => 'issued_by_designation',
        'issued_by_date' => 'issued_by_date',
        'received_by_name' => 'received_by_name',
        'received_by_designation' => 'received_by_designation',
        'received_by_date' => 'received_by_date',
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
