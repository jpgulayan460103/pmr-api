<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Transformers\LibraryTransformer;
use App\Models\PurchaseRequestItem;

class PurchaseRequestItemTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'unit_of_measure'
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(PurchaseRequestItem $table)
    {
        return [
            'item_name' => $table->item_name,
            'item_code' => $table->item_code,
            'item_id' => $table->item_id,
            'quantity' => $table->quantity,
            'unit_cost' => $table->unit_cost,
            'unit_of_measure_id' => $table->unit_of_measure_id,
            'total_unit_cost' => $table->total_unit_cost,
            'key' => $table->id,
            'id' => $table->id,
            'is_ppmp' => $table->id != null,
        ];
    }

    public function includeUnitOfMeasure(PurchaseRequestItem $table)
    {
        if ($table->unit_of_measure) {
            return $this->item($table->unit_of_measure, new LibraryTransformer);
        }
    }
}
