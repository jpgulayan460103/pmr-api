<?php

namespace App\Repositories\Interfaces;

use App\Repositories\Interfaces\CrudInterface;

interface FormProcessRepositoryInterface extends  CrudInterface{

    public function purchaseRequest($created);

    public function getByFormType($type, $id);
}