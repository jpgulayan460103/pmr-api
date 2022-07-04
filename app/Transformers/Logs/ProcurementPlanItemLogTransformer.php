<?php

namespace App\Transformers\Logs;

use App\Models\ActivityLog;
use League\Fractal\TransformerAbstract;

class ProcurementPlanItemLogTransformer extends TransformerAbstract
{
    public $labels = [
        'procurement_plan_id' => 'procurement_plan_id',
        'item_id' => 'item_id',
        'unit_of_measure_id' => 'unit_of_measure_id',
        'item_type_id' => 'item_type_id',
        'description' => 'description',
        'mon1' => 'mon1',
        'mon2' => 'mon2',
        'mon3' => 'mon3',
        'mon4' => 'mon4',
        'mon5' => 'mon5',
        'mon6' => 'mon6',
        'mon7' => 'mon7',
        'mon8' => 'mon8',
        'mon9' => 'mon9',
        'mon10' => 'mon10',
        'mon11' => 'mon11',
        'mon12' => 'mon12',
        'price' => 'price',
        'total_quantity' => 'total_quantity',
        'total_price' => 'total_price',
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
