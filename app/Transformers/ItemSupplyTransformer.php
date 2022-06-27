<?php

namespace App\Transformers;

use App\Models\ItemSupply;
use League\Fractal\TransformerAbstract;

class ItemSupplyTransformer extends TransformerAbstract
{
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
        'item_supply_histories',
        'remaining_quantity',
        'item_category',
        'unit_of_measure',
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(ItemSupply $table)
    {
        return [
            'id' => $table->id,
            'key' => $table->id,
            'uuid' => $table->uuid,
            'item_name' => $table->item_name,
            'item_category_id' => $table->item_category_id,
            'unit_of_measure_id' => $table->unit_of_measure_id,
            'is_active' => $table->is_active,
            'file' => route('api.stock-card.pdf', ['id' => $table->uuid]),
        ];
    }

    public function includeItemSupplyHistories(ItemSupply $table)
    {
        if ($table->item_supply_histories) {
            return $this->collection($table->item_supply_histories, new ItemSupplyHistoryTransformer);
        }
    }
    public function includeRemainingQuantity(ItemSupply $table)
    {
        if ($table->remaining_quantity) {
            return $this->item($table->remaining_quantity, function ($data) {
                return [
                    "quantity" => (int) $data->quantity,
                    "item_supply_id" => $data->item_supply_id,
                    "key" => $data->item_supply_id,
                ];
            });

        }
    }

    public function includeItemCategory(ItemSupply $table)
    {
        if ($table->item_category) {
            return $this->item($table->item_category, new LibraryTransformer);
        }
    }

    public function includeUnitOfMeasure(ItemSupply $table)
    {
        if ($table->unit_of_measure) {
            return $this->item($table->unit_of_measure, new LibraryTransformer);
        }
    }
}
