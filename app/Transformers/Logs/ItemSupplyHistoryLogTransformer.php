<?php

namespace App\Transformers\Logs;

use App\Models\ActivityLog;
use League\Fractal\TransformerAbstract;

class ItemSupplyHistoryLogTransformer extends TransformerAbstract
{
    public $labels = [
        // 'item_supply_id' => 'item_supply_id',
        'movement_quantity' => 'Movement Quantity',
        'remaining_quantity' => 'Remaining Quantity',
        'movement_type' => 'Movement Type',
        // 'form_sourceable_id' => 'form_sourceable_id',
        // 'form_sourceable_type' => 'form_sourceable_type',
        // 'form_source' => 'form_source',
        'remarks' => 'Remarks',
        'item_supply.item_name' => 'Item Name',
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
