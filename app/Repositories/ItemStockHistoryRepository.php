<?php

namespace App\Repositories;

use App\Models\ItemStockHistory;
use App\Repositories\Interfaces\ItemStockHistoryRepositoryInterface;
use App\Repositories\HasCrud;

class ItemStockHistoryRepository implements ItemStockHistoryRepositoryInterface
{
    use HasCrud;
    public function __construct(ItemStockHistory $ItemStockHistory = null)
    {
        if(!($ItemStockHistory instanceof ItemStockHistory)){
            $ItemStockHistory = new ItemStockHistory;
        }
        $this->model($ItemStockHistory);
        $this->perPage(200);
    }
}