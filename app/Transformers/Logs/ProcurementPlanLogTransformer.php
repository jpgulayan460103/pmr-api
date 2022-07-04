<?php

namespace App\Transformers\Logs;

use App\Models\ActivityLog;
use League\Fractal\TransformerAbstract;

class ProcurementPlanLogTransformer extends TransformerAbstract
{
    protected $labels = [
        'title' => 'title',
        'purpose' => 'purpose',
        'procurement_plan_type_id' => 'procurement_plan_type_id',
        'ppmp_date' => 'ppmp_date',
        'calendar_year' => 'calendar_year',
        'ppmp_number' => 'ppmp_number',
        'status' => 'status',
        'remarks' => 'remarks',
        'total_price_a' => 'total_price_a',
        'inflation_a' => 'inflation_a',
        'contingency_a' => 'contingency_a',
        'total_estimated_budget_a' => 'total_estimated_budget_a',
        'total_price_b' => 'total_price_b',
        'inflation_b' => 'inflation_b',
        'contingency_b' => 'contingency_b',
        'total_estimated_budget_b' => 'total_estimated_budget_b',
        'total_estimated_budget' => 'total_estimated_budget',
        'is_supplemental' => 'is_supplemental',
        'created_by_id' => 'created_by_id',
        'end_user_id' => 'end_user_id',
        'prepared_by_name' => 'prepared_by_name',
        'prepared_by_designation' => 'prepared_by_designation',
        'certified_by_id' => 'certified_by_id',
        'certified_by_name' => 'certified_by_name',
        'certified_by_designation' => 'certified_by_designation',
        'approved_by_id' => 'approved_by_id',
        'approved_by_name' => 'approved_by_name',
        'approved_by_designation' => 'approved_by_designation',
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
