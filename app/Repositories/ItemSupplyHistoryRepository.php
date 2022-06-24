<?php

namespace App\Repositories;

use App\Models\ItemSupplyHistory;
use App\Repositories\Interfaces\ItemSupplyHistoryRepositoryInterface;
use App\Repositories\HasCrud;

class ItemSupplyHistoryRepository implements ItemSupplyHistoryRepositoryInterface
{
    use HasCrud;
    public function __construct(ItemSupplyHistory $ItemSupplyHistory = null)
    {
        if(!($ItemSupplyHistory instanceof ItemSupplyHistory)){
            $ItemSupplyHistory = new ItemSupplyHistory;
        }
        $this->model($ItemSupplyHistory);
        $this->perPage(200);
    }
}