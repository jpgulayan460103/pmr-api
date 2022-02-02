<?php

namespace App\Repositories;

use App\Models\QuotationItem;
use App\Repositories\Interfaces\QuotationItemRepositoryInterface;
use App\Repositories\HasCrud;

class QuotationItemRepository implements QuotationItemRepositoryInterface
{
    use HasCrud;
    public function __construct(QuotationItem $quotationItem = null)
    {
        if(!($quotationItem instanceof QuotationItem)){
            $quotationItem = new QuotationItem;
        }
        $this->model($quotationItem);
        $this->perPage(200);
    }
}