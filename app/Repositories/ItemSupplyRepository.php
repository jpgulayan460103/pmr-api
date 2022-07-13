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
        if (request()->has('item_name') && request('item_name') != "") {
            $item_name = request('item_name');
            $items->where('item_name', 'like', "%$item_name%");
        }
        if(request()->has('item_category_id') && request('item_category_id') != ""){
            $this->modelQuery()->whereIn('item_category_id', request('item_category_id'));
        }
        if(request()->has('sortColumn') && request()->has('sortOrder')){
            $sortOrder = request('sortOrder') ==  'ascend' ? 'ASC' : 'DESC';  
            $this->modelQuery()->orderBy(request('sortColumn'), $sortOrder);
        }

        $items->orderBy('item_name');
        $items = $items->paginate($this->perPage);
        return $items;
    }

    public function updateItem($id, $data)
    {
        if(isset($data['adjusted_quantity']) && $data['adjusted_quantity'] != 0){
            (new ItemSupplyHistoryRepository())->createFromAdjustment($id);
        }
        $this->update($id, $data);
        return $this->getById($id);
    }

}