<?php

namespace App\Repositories;

use App\Models\PurchaseOrder;
use App\Repositories\Interfaces\PurchaseOrderRepositoryInterface;
use App\Repositories\CrudRepositoryTrait;

class PurchaseOrderRepository implements PurchaseOrderRepositoryInterface
{
    use CrudRepositoryTrait;
    public function __construct(PurchaseOrder $purchaseOrder)
    {
        $this->model = $purchaseOrder;
        $this->per_page = 2;
    }

}
