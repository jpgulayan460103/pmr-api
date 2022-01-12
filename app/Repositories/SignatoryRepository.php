<?php

namespace App\Repositories;

use App\Models\Signatory;
use App\Repositories\Interfaces\SignatoryRepositoryInterface;
use App\Repositories\HasCrud;

class SignatoryRepository implements SignatoryRepositoryInterface
{
    use HasCrud;
    public function __construct(Signatory $signatory = null)
    {
        if(!($signatory instanceof Signatory)){
            $signatory = new Signatory;
        }
        $this->model($signatory);
        $this->perPage(200);
    }
    
}