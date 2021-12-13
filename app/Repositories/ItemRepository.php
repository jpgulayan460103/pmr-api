<?php

namespace App\Repositories;

use App\Models\Item;
use App\Repositories\Interfaces\ItemRepositoryInterface;
use App\Repositories\CrudRepositoryTrait;

class ItemRepository implements ItemRepositoryInterface
{
    use CrudRepositoryTrait;
    public function __construct(Item $item)
    {
        $this->model($item);
        $this->perPage(2);
        $this->attach(['item_category','unit_of_measure']);
    }
}