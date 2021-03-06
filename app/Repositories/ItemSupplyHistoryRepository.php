<?php

namespace App\Repositories;

use App\Models\ItemSupply;
use App\Models\ItemSupplyHistory;
use App\Repositories\Interfaces\ItemSupplyHistoryRepositoryInterface;
use App\Repositories\HasCrud;

class ItemSupplyHistoryRepository implements ItemSupplyHistoryRepositoryInterface
{
    use HasCrud;
    public function __construct(ItemSupplyHistory $ItemSupplyHistory = null)
    {
        if(!($ItemSupplyHistory instanceof ItemSupplyHistory)){
            $ItemSupplyHistory = new ItemSupplyHistory;
        }
        $this->model($ItemSupplyHistory);
        $this->perPage(200);
    }

    public function createFromRequisitionIssue($requisition_issue, $data)
    {
        $issued_items = $data['issued_items'];
        foreach ($issued_items as $issued_item) {
            $item = ItemSupply::with('remaining_quantity')->whereId($issued_item['item_supply_id'])->first();
            $insert = [
                'item_supply_id' => $issued_item['item_supply_id'],
                'movement_quantity' => ($issued_item['quantity'] * -1),
                'remaining_quantity' => ($item->remaining_quantity->quantity - $issued_item['quantity']),
                'item_supply_id' => $issued_item['item_supply_id'],
                'movement_type' => 'out',
                'form_source' => 'requisition_issue',
                'form_sourceable_id' => $requisition_issue->id,
                'form_sourceable_type' => get_class($requisition_issue),
            ];
            $this->create($insert);
        }
    }
}