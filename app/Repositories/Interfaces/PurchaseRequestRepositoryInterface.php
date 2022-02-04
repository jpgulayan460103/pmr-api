<?php

namespace App\Repositories\Interfaces;

use App\Repositories\Interfaces\CrudInterface;

interface PurchaseRequestRepositoryInterface extends  CrudInterface{
    
    public function search($filters);
    public function addItems();
    public function updateItems($id);
    public function removeItems($item_ids,$item_ids_form);
}