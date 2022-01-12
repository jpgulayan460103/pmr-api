<?php

namespace App\Repositories\Interfaces;

use App\Repositories\Interfaces\CrudInterface;

interface FormRouteRepositoryInterface extends  CrudInterface{

    public function purchaseRequest($created, $proccess);
}