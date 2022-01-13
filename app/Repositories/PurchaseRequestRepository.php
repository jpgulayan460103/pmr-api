<?php

namespace App\Repositories;

use App\Models\PurchaseRequest;
use App\Models\PurchaseRequestItem;
use App\Repositories\Interfaces\PurchaseRequestRepositoryInterface;
use App\Repositories\HasCrud;
use Illuminate\Support\Facades\DB;

class PurchaseRequestRepository implements PurchaseRequestRepositoryInterface
{
    use HasCrud;
    public function __construct(PurchaseRequest $purchaseRequest = null)
    {
        if(!($purchaseRequest instanceof PurchaseRequest)){
            $purchaseRequest = new PurchaseRequest;
        }
        $this->model($purchaseRequest);
        $this->perPage(2);
        $this->uuid = "purchase_request_uuid";
    }

    public function createWithItems($request)
    {
        DB::beginTransaction();
        try {
            $purchase_request = $this->create($request->all());
            $items = array();
            foreach ($request->items as $key => $item) {
                $item['total_unit_cost'] = $item['unit_cost'] * $item['quantity'];
                $items[$key] = new PurchaseRequestItem($item);
            }
            $purchase_request->items()->saveMany($items);
            DB::commit();
            return $purchase_request;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}

