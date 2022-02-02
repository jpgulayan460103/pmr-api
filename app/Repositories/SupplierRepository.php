<?php

namespace App\Repositories;

use App\Models\Supplier;
use App\Repositories\Interfaces\SupplierRepositoryInterface;
use App\Repositories\HasCrud;

class SupplierRepository implements SupplierRepositoryInterface
{
    use HasCrud;
    public function __construct(Supplier $supplier = null)
    {
        if(!($supplier instanceof Supplier)){
            $supplier = new Supplier;
        }
        $this->model($supplier);
        $this->perPage(200);
    }
}