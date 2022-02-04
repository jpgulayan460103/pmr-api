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

    public function create($data)
    {
        DB::beginTransaction();
        try {
            $items = $this->addItems();
            $data['total_amount'] = $items['total_amount'];
            $quotation = $this->mCreate($data);
            $quotation->items()->saveMany($items['items']);
            DB::commit();
            return $quotation;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function addItems()
    {
        $total_amount = 0;
        $items = array();
        if(request()->has('items') && request('items') != array()){
            foreach (request('items') as $key => $item) {
                $item['total_unit_cost'] = $item['unit_cost'] * $item['quantity'];
                $total_amount += $item['total_unit_cost'];
                $items[$key] = new QuotationItem($item);
            }
        }
        return [
            'items' => $items,
            'total_amount' => $total_amount,
        ];
    }

    public function update($data, $id)
    {
        DB::beginTransaction();
        try {
            $items = $this->updateItems($data, $id);
            $data['total_amount'] = $items['total_amount'];
            $quotation = $this->mUpdate($id, $data);
            $quotation->items()->saveMany($items['items']);
            DB::commit();
            return $quotation;
        } catch (\Throwable $th) {
            throw $th;
        }

    }

    public function updateItems($data, $id)
    {
        $total_amount = 0;
        $item_ids_form = array();
        $item_ids = QuotationItem::where('quotation_id',$id)->pluck('id')->toArray();
        $new_items = array();
        if(request()->has('items') && request('items') != array()){
            foreach (request('items') as $key => $item) {
                $item['total_unit_cost'] = $item['unit_cost'] * $item['quantity'];
                $total_amount += $item['total_unit_cost'];
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
        return [
            'items' => $new_items,
            'total_amount' => $total_amount,
        ];
    }

    public function removeItems($item_ids,$item_ids_form)
    {
        $removed_item_ids = array_diff($item_ids,$item_ids_form);
        QuotationItem::whereIn('id', $removed_item_ids)->delete();
    }
}