<?php

namespace App\Repositories;

use App\Models\PurchaseRequest;
use App\Models\PurchaseRequestItem;
use App\Repositories\Interfaces\PurchaseRequestRepositoryInterface;
use App\Repositories\HasCrud;
use Illuminate\Support\Facades\DB;
use App\Repositories\FormProcessRepository;
use App\Repositories\FormRouteRepository;
use App\Transformers\FormProcessTransformer;

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

    public function search($request, $filters)
    {
        $this->modelQuery()->whereIn('end_user_id', $filters['offices_ids']);
        return $this->modelQuery()->get();
    }

    public function createPurchaseRequest($request)
    {
        DB::beginTransaction();
        try {
            $items = $this->createItems($request);
            $purchase_request = $this->create($request->all());
            $purchase_request->items()->saveMany($items);
            $formProcess = (new FormProcessRepository)->purchaseRequest($purchase_request);
            $formRoute = (new FormRouteRepository)->purchaseRequest($purchase_request, $formProcess);
            DB::commit();
            return $purchase_request;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function createItems($request)
    {
        $items = array();
        foreach ($request->items as $key => $item) {
            $item['total_unit_cost'] = $item['unit_cost'] * $item['quantity'];
            $items[$key] = new PurchaseRequestItem($item);
        }
        return $items;
    }
}

