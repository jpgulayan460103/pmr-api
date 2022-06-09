<?php

namespace App\Transformers;

use App\Models\ItemStockHistory;
use League\Fractal\TransformerAbstract;

class ItemStockHistoryTransformer extends TransformerAbstract
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
        'form_sourceable'
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(ItemStockHistory $table)
    {
        return [
            'id' => $table->id,
            'key' => $table->item_id,
            'item_id' => $table->item_id,
            'movement_quantity' => $table->movement_quantity,
            'remaining_quantity' => $table->remaining_quantity,
            'movement_type' => $table->movement_type,
            'form_sourceable_id' => $table->form_sourceable_id,
            'form_sourceable_type' => $table->form_sourceable_type,
            'form_source' => $table->form_source,
            'remarks' => $table->remarks,
            'created_at' => $table->created_at,
            'created_at_str' => $table->created_at->toDateString(),
            'created_at_custom' => $table->created_at->format("m/d/Y"),
        ];
    }

    public function includeItem(ItemStockHistory $table)
    {
        if ($table->item) {
            return $this->item($table->item, new ItemTransformer);
        }
    }

    public function includeFormSourceable(ItemStockHistory $table)
    {
        switch ($table->form_source) {
            case 'purchase_request':
                return $this->item($table->form_sourceable, new PurchaseRequestTransformer);
                break;
            case 'procurement_plan':
                return $this->item($table->form_sourceable, new ProcurementPlanTransformer);
                break;
            
            default:
                # code...
                break;
        }
    }
}
