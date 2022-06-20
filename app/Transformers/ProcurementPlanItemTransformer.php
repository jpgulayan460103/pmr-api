<?php

namespace App\Transformers;

use App\Models\ProcurementPlanItem;
use League\Fractal\TransformerAbstract;

class ProcurementPlanItemTransformer extends TransformerAbstract
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
        'item',
        'unit_of_measure',
        'item_type',
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(ProcurementPlanItem $table)
    {
        return [
            'id' => $table->id,
            'key' => $table->id,
            'procurement_plan_id' => $table->procurement_plan_id,
            'unit_of_measure_id' => $table->unit_of_measure_id,
            'item_type_id' => $table->item_type_id,
            'item_id' => $table->item_id,
            'description' => $table->description,
            'mon1' => $table->mon1,
            'mon2' => $table->mon2,
            'mon3' => $table->mon3,
            'mon4' => $table->mon4,
            'mon5' => $table->mon5,
            'mon6' => $table->mon6,
            'mon7' => $table->mon7,
            'mon8' => $table->mon8,
            'mon9' => $table->mon9,
            'mon10' => $table->mon10,
            'mon11' => $table->mon11,
            'mon12' => $table->mon12,
            'price' => $table->price,
            'total_quantity' => $table->total_quantity,
            'total_price' => $table->total_price,
            'display_log' => $table->item ? $table->item->item_name : $table->description,
        ];
    }

    public function includeItem(ProcurementPlanItem $table)
    {
        if ($table->item) {
            return $this->item($table->item, new ItemTransformer);
        }
    }
    public function includeUnitOfMeasure(ProcurementPlanItem $table)
    {
        if ($table->unit_of_measure) {
            return $this->item($table->unit_of_measure, new LibraryTransformer);
        }
    }
    public function includeItemType(ProcurementPlanItem $table)
    {
        if ($table->item_type_id) {
            return $this->item($table->item_type_id, new LibraryTransformer);
        }
    }
}
