<?php

namespace App\Repositories;

use App\Models\Quotation;
use App\Repositories\Interfaces\QuotationRepositoryInterface;
use App\Repositories\HasCrud;

class QuotationRepository implements QuotationRepositoryInterface
{
    use HasCrud;
    public function __construct(Quotation $quotation = null)
    {
        if(!($quotation instanceof Quotation)){
            $quotation = new Quotation;
        }
        $this->model($quotation);
        $this->perPage(200);
    }
}