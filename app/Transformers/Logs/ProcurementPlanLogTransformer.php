<?php

namespace App\Transformers\Logs;

use App\Models\ActivityLog;
use League\Fractal\TransformerAbstract;

class ProcurementPlanLogTransformer extends TransformerAbstract
{
    public $labels = [
        'title' => 'Title',
        'purpose' => 'Purpose',
        // 'procurement_plan_type_id' => 'procurement_plan_type_id',
        'ppmp_date' => 'PPMP Date',
        'calendar_year' => 'CY',
        'ppmp_number' => 'PPMP Number',
        // 'status' => 'status',
        // 'remarks' => 'remarks',
        'total_price_a' => 'Grand Total for ANNEX A',
        'inflation_a' => 'Inflation for ANNEX A',
        'contingency_a' => 'Contingency for ANNEX A',
        'total_estimated_budget_a' => 'Total Estimated Budget for ANNEX A',
        'total_price_b' => 'Grand Total for ANNEX B',
        'inflation_b' => 'Inflation for ANNEX B',
        'contingency_b' => 'Contingency for ANNEX B',
        'total_estimated_budget_b' => 'Total Estimated Budget for ANNEX B',
        'total_estimated_budget' => 'Total Estimated Budget (A+B)',
        // 'is_supplemental' => 'Supplemental PPMP',
        // 'created_by_id' => 'created_by_id',
        // 'end_user_id' => 'end_user_id',
        'prepared_by_name' => 'Prepared By Name',
        'prepared_by_designation' => 'Prepared By Designation',
        // 'certified_by_id' => 'certified_by_id',
        'certified_by_name' => 'Certified By Name',
        'certified_by_designation' => 'Certified By Designation',
        // 'approved_by_id' => 'approved_by_id',
        'approved_by_name' => 'Approved By Name',
        'approved_by_designation' => 'Approved By Designation',
        'end_user.name' => 'End-User',
        'procurement_plan_type.name' => 'PPMP Type',
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
