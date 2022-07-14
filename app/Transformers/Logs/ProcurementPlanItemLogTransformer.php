<?php

namespace App\Transformers\Logs;

use App\Models\ActivityLog;
use League\Fractal\TransformerAbstract;

class ProcurementPlanItemLogTransformer extends TransformerAbstract
{
    public $labels = [
        // 'procurement_plan_id' => 'procurement_plan_id',
        // 'item_id' => 'item_id',
        // 'unit_of_measure_id' => 'unit_of_measure_id',
        // 'item_type_id' => 'item_type_id',
        'description' => 'Item Description',
        'mon1' => 'Jan',
        'mon2' => 'Feb',
        'mon3' => 'Mar',
        'mon4' => 'Apr',
        'mon5' => 'May',
        'mon6' => 'Jun',
        'mon7' => 'Jul',
        'mon8' => 'Aug',
        'mon9' => 'Sept',
        'mon10' => 'Oct',
        'mon11' => 'Nov',
        'mon12' => 'Dec',
        'price' => 'Estimated Price',
        'total_quantity' => 'Total Quantity',
        'total_price' => 'Total Price',
        'unit_of_measure.name' => 'Unit of Measure',
        'item_type.name' => 'Item Type',
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
