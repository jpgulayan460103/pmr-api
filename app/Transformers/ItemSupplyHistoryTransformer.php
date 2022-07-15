<?php

namespace App\Transformers;

use App\Models\ItemSupply;
use App\Models\ItemSupplyHistory;
use League\Fractal\TransformerAbstract;

class ItemSupplyHistoryTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [
        'item_supply'
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
    public function transform(ItemSupplyHistory $table)
    {
        return [
            'id' => $table->id,
            'key' => $table->id,
            'item_supply_id' => $table->item_supply_id,
            'movement_quantity' => $table->movement_quantity,
            'remaining_quantity' => $table->remaining_quantity,
            'movement_type' => $table->movement_type,
            'form_sourceable_id' => $table->form_sourceable_id,
            'form_sourceable_type' => $table->form_sourceable_type,
            'form_source' => $table->form_source,
            'remarks' => $table->remarks,
            'created_at' => $table->created_at,
            'display_log' => $table->item_supply->item_name,
            'created_at_str' => $table->created_at->toDateString(),
            'created_at_custom' => $table->created_at->format("m/d/Y"),
        ];
    }

    public function includeItemSupply(ItemSupplyHistory $table)
    {
        if ($table->item_supply) {
            return $this->item($table->item_supply, new ItemSupplyTransformer);
        }
    }

    public function includeFormSourceable(ItemSupplyHistory $table)
    {
        switch ($table->form_source) {
            // case 'purchase_request':
            //     return $this->item($table->form_sourceable, new PurchaseRequestTransformer);
            //     break;
            // case 'procurement_plan':
            //     return $this->item($table->form_sourceable, new ProcurementPlanTransformer);
            //     break;
            case 'requisition_issue':
                return $this->item($table->form_sourceable, new RequisitionIssueTransformer);
                break;
            
            default:
                # code...
                break;
        }
    }
}
