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
    public function __construct(PurchaseRequest $purchaseRequest)
    {
        $this->model($purchaseRequest);
        $this->perPage(2);
        $this->attach(['end_user']);
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

    // public function create($data): object
    // {
    //     $requested_by = (new SignatoryRepository)->getBy('signatory_type', $data['requestedBy']);
    //     $approved_by = (new SignatoryRepository)->getBy('signatory_type', $data['approvedBy']);
    //     $data['requested_by_id'] = $requested_by;
    //     $data['approved_by_id'] = $approved_by;
    //     return $this->model->create($data);
    // }
}

