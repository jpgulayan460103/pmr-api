<?php

namespace App\Repositories;

use App\Models\PurchaseRequest;
use App\Repositories\Interfaces\PurchaseRequestRepositoryInterface;
use App\Repositories\HasCrud;

class PurchaseRequestRepository implements PurchaseRequestRepositoryInterface
{
    use HasCrud;
    public function __construct(PurchaseRequest $purchaseRequest)
    {
        $this->model($purchaseRequest);
        $this->perPage(2);
        $this->attach(['purchase_orders']);
    }

}

