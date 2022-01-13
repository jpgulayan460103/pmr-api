<?php

namespace App\Repositories;

use App\Models\Item;
use App\Repositories\Interfaces\ItemRepositoryInterface;
use App\Repositories\HasCrud;

class ItemRepository implements ItemRepositoryInterface
{
    use HasCrud;
    public function __construct(Item $item = null)
    {
        if(!($item instanceof Item)){
            $item = new Item;
        }
        $this->model($item);
        $this->perPage(200);
        $this->attach('item_category,unit_of_measure');
    }
}