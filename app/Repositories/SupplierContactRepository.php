<?php

namespace App\Repositories;

use App\Models\SupplierContact;
use App\Repositories\Interfaces\SupplierContactRepositoryInterface;
use App\Repositories\HasCrud;

class SupplierContactRepository implements SupplierContactRepositoryInterface
{
    use HasCrud;
    public function __construct(SupplierContact $supplierContact = null)
    {
        if(!($supplierContact instanceof SupplierContact)){
            $supplierContact = new SupplierContact;
        }
        $this->model($supplierContact);
        $this->perPage(200);
    }
}