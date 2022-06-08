<?php

namespace App\Transformers;

use App\Models\ProcurementPlanItem;
use League\Fractal\TransformerAbstract;

class ApprovedProcurementPlanItemTransformer extends TransformerAbstract
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
        'item'
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(ProcurementPlanItem $table)
    {
        return [
            'item_id' => $table->item_id,
            'key' => $table->item_id,
            'sum_quantity' => (integer)$table->sum_quantity,
            'sum_price' => $table->sum_price,
        ];
    }

    public function includeItem(ProcurementPlanItem $table)
    {
        if ($table->item) {
            return $this->item($table->item, new ItemTransformer);
        }
    }
}
