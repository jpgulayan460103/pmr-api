<?php

namespace App\Repositories\Interfaces;

use App\Repositories\Interfaces\CrudInterface;

interface PurchaseRequestRepositoryInterface extends  CrudInterface{
    
    public function search($request, $filters);
    public function createPurchaseRequest($request);
    public function addItems($request);
    public function updatePurchaseRequest($request, $id);
    public function updateItems($request, $id);
    public function removeItems($item_ids,$item_ids_form);
}