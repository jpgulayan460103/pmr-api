<?php

namespace App\Repositories;

use App\Models\Quotation;
use App\Models\QuotationItem;
use App\Repositories\Interfaces\QuotationRepositoryInterface;
use App\Repositories\HasCrud;
use Illuminate\Support\Facades\DB;

class QuotationRepository implements QuotationRepositoryInterface
{
    use HasCrud {
        create as mCreate;
        update as mUpdate;
    }
    public function __construct(Quotation $quotation = null)
    {
        if(!($quotation instanceof Quotation)){
            $quotation = new Quotation;
        }
        $this->model($quotation);
        $this->perPage(200);
    }

    public function create($request)
    {
        // return $request->all();
        DB::beginTransaction();
        try {
            $items = $this->addItems($request);
            $quotation = $this->mCreate($request);
            $quotation->items()->saveMany($items);
            DB::commit();
            return $quotation;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function addItems($request)
    {
        $items = array();
        foreach ($request['items'] as $key => $item) {
            $item['total_unit_cost'] = $item['unit_cost'] * $item['quantity'];
            $items[$key] = new QuotationItem($item);
        }
        return $items;
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $new_items = $this->updateItems($request, $id);
            $quotation = $this->mUpdate($id, $request->all());
            $quotation->items()->saveMany($new_items);
            DB::commit();
            return $quotation;
        } catch (\Throwable $th) {
            throw $th;
        }

    }

    public function updateItems($request, $id)
    {
        $item_ids_form = array();
        $item_ids = QuotationItem::where('quotation_id',$id)->pluck('id')->toArray();
        $new_items = array();
        if($request['items'] != array()){
            foreach ($request['items'] as $key => $item) {
                $item['total_unit_cost'] = $item['unit_cost'] * $item['quantity'];
                if(isset($item['id'])){
                    QuotationItem::find($item['id'])->update($item);
                    $item_ids_form[] = $item['id']; 
                }else{
                    $new_items[$key] = new QuotationItem($item);
                    $new_items[$key]->save();
                }
            }
            $this->removeItems($item_ids,$item_ids_form);
        }
        return $new_items;
    }

    public function removeItems($item_ids,$item_ids_form)
    {
        $removed_item_ids = array_diff($item_ids,$item_ids_form);
        QuotationItem::whereIn('id', $removed_item_ids)->delete();
    }
}