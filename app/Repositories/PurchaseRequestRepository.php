<?php

namespace App\Repositories;

use App\Models\PurchaseRequest;
use App\Repositories\Interfaces\PurchaseRequestRepositoryInterface;
use App\Repositories\CrudRepository;

class PurchaseRequestRepository extends CrudRepository implements PurchaseRequestRepositoryInterface
{
    protected $model;
    public function __construct(PurchaseRequest $purchaseRequest)
    {
        $this->model = $purchaseRequest;
    }

}

