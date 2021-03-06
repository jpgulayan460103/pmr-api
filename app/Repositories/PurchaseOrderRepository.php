<?php

namespace App\Repositories;

use App\Models\PurchaseOrder;
use App\Repositories\Interfaces\PurchaseOrderRepositoryInterface;
use App\Repositories\HasCrud;

class PurchaseOrderRepository implements PurchaseOrderRepositoryInterface
{
    use HasCrud;
    public function __construct(PurchaseOrder $purchaseOrder = null)
    {
        if(!($purchaseOrder instanceof PurchaseOrder)){
            $purchaseOrder = new PurchaseOrder;
        }
        $this->model($purchaseOrder);
        $this->perPage(2);
        $this->attach('purchase_request');
    }
    
}

