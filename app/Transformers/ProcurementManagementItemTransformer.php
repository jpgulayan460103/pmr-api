<?php

namespace App\Transformers;

use App\Models\ProcurementManagementItem;
use League\Fractal\TransformerAbstract;

class ProcurementManagementItemTransformer extends TransformerAbstract
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
        'procurement_management',
        'item',
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(ProcurementManagementItem $table)
    {
        $is_consolidated = ($table->id == null);
        if($is_consolidated){
            return [
                'key' => $table->item_id,
                'procurement_management_id' => $table->procurement_management_id,
                'item_id' => $table->item_id,
                'mon1' => (int) $table->mon1,
                'mon2' => (int) $table->mon2,
                'mon3' => (int) $table->mon3,
                'mon4' => (int) $table->mon4,
                'mon5' => (int) $table->mon5,
                'mon6' => (int) $table->mon6,
                'mon7' => (int) $table->mon7,
                'mon8' => (int) $table->mon8,
                'mon9' => (int) $table->mon9,
                'mon10' => (int) $table->mon10,
                'mon11' => (int) $table->mon11,
                'mon12' => (int) $table->mon12,
                'total_quantity' => (int) $table->total_quantity,
                'total_price' => (float) $table->total_price,
            ];
        };
        return [
            'id' => $table->id,
            'key' => $table->id,
            'procurement_management_id' => $table->procurement_management_id,
            'item_id' => $table->item_id,
            'mon1' => (int) $table->mon1,
            'mon2' => (int) $table->mon2,
            'mon3' => (int) $table->mon3,
            'mon4' => (int) $table->mon4,
            'mon5' => (int) $table->mon5,
            'mon6' => (int) $table->mon6,
            'mon7' => (int) $table->mon7,
            'mon8' => (int) $table->mon8,
            'mon9' => (int) $table->mon9,
            'mon10' => (int) $table->mon10,
            'mon11' => (int) $table->mon11,
            'mon12' => (int) $table->mon12,
            'price' => (float) $table->price,
            'total_quantity' => (int) $table->total_quantity,
            'total_price' => (float) $table->total_price,
            'form_type' => $table->form_type,
            'form_sourceable_id' => $table->form_sourceable_id,
            'form_sourceable_type' => $table->form_sourceable_type,
        ];
    }

    public function includeItem(ProcurementManagementItem $table)
    {
        if ($table->item) {
            return $this->item($table->item, new ItemTransformer);
        }
    }
}
