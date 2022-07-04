<?php

namespace App\Transformers\Logs;

use League\Fractal\TransformerAbstract;
use App\Models\ActivityLog;

class PurchaseRequestItemLogTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    public $labels = [
        'item_name' => 'item_name',
        'description' => 'description',
        'item_code' => 'item_code',
        'item_id' => 'item_id',
        'quantity' => 'quantity',
        'unit_cost' => 'unit_cost',
        'unit_of_measure_id' => 'unit_of_measure_id',
        'total_unit_cost' => 'total_unit_cost',
        'purchase_request_id' => 'purchase_request_id',
        'purchase_request_item_uuid' => 'purchase_request_item_uuid',
        'is_ppmp' => 'is_ppmp',
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
