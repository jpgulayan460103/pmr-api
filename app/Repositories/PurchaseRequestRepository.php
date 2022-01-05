<?php

namespace App\Repositories;

use App\Models\PurchaseRequest;
use App\Models\PurchaseRequestItem;
use App\Repositories\Interfaces\PurchaseRequestRepositoryInterface;
use App\Repositories\HasCrud;

class PurchaseRequestRepository implements PurchaseRequestRepositoryInterface
{
    use HasCrud;
    public function __construct(PurchaseRequest $purchaseRequest)
    {
        $this->model($purchaseRequest);
        $this->perPage(2);
        $this->attach(['end_user']);
        $this->uuid = "purchase_request_uuid";
    }

    public function createWithItems($request)
    {
        $purchase_request = $this->create($request->all());
        $items = array();
        foreach ($request->items as $key => $item) {
            $item['total_unit_cost'] = $item['unit_cost'] * $item['quantity'];
            $items[$key] = new PurchaseRequestItem($item);
        }
        $purchase_request->items()->saveMany($items);
        return $purchase_request;
    }
}

