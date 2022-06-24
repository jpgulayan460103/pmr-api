<?php

namespace App\Repositories;

use App\Models\ItemSupply;
use App\Repositories\Interfaces\ItemSupplyRepositoryInterface;
use App\Repositories\HasCrud;
use Illuminate\Support\Facades\DB;

class ItemSupplyRepository implements ItemSupplyRepositoryInterface
{
    use HasCrud;
    public function __construct(ItemSupply $ItemSupply = null)
    {
        if(!($ItemSupply instanceof ItemSupply)){
            $ItemSupply = new ItemSupply;
        }
        $this->model($ItemSupply);
        $this->perPage(20);
    }

    public function search()
    {
        $items = $this->modelQuery();
        if (request()->has('search') && request('search') != "") {
            $search = request('search');
            $items->where('item_name', 'like', "%$search%");
        }
        $items->orderBy('item_name');
        $items = $items->paginate($this->perPage);
        return $items;
    }
}