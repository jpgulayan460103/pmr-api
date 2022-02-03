<?php

namespace App\Repositories;

use App\Models\PurchaseRequest;
use App\Models\PurchaseRequestItem;
use App\Repositories\Interfaces\PurchaseRequestRepositoryInterface;
use App\Repositories\HasCrud;
use Illuminate\Support\Facades\DB;
use App\Repositories\FormProcessRepository;
use App\Repositories\FormRouteRepository;
use App\Transformers\FormProcessTransformer;
use Carbon\Carbon;

class PurchaseRequestRepository implements PurchaseRequestRepositoryInterface
{
    use HasCrud {
        create as mCreate;
        update as mUpdate;
    }
    public function __construct(PurchaseRequest $purchaseRequest = null)
    {
        if(!($purchaseRequest instanceof PurchaseRequest)){
            $purchaseRequest = new PurchaseRequest;
        }
        $this->model($purchaseRequest);
        $this->perPage(2);
        $this->uuid = "purchase_request_uuid";
    }

    public function search($filters)
    {
        if(isset($filters['purpose'])){
            $this->modelQuery()->where('purpose', 'like', "%".$filters['purpose']."%");
        }
        if(isset($filters['total_cost'])){
            $this->modelQuery()->where('total_cost', $filters['total_cost']);
        }
        if(isset($filters['status'])){
            $this->modelQuery()->whereIn('status', $filters['status']);
        }
        if(isset($filters['offices_ids'])){
            $this->modelQuery()->whereIn('end_user_id', $filters['offices_ids']);
        }
        if(isset($filters['sa_or'])){
            $this->modelQuery()->where('sa_or', 'like', "%".$filters['sa_or']."%");
        }
        if(isset($filters['purchase_request_number'])){
            $this->modelQuery()->where('purchase_request_number', 'like', "%".$filters['purchase_request_number']."%");
        }
        if(isset($filters['end_user_id'])){
            $this->modelQuery()->whereIn('end_user_id', $filters['end_user_id']);
        }
        if(isset($filters['pr_date'])){
            $pr_date[] = Carbon::parse(str_replace('"', '', $filters['pr_date'][0]))->toDateString();
            $pr_date[] = Carbon::parse(str_replace('"', '', $filters['pr_date'][1]))->toDateString();
            $this->modelQuery()->whereBetween('pr_date', $pr_date);
        }
        return $this->modelQuery()->paginate($this->perPage);
    }

    public function create($request)
    {
        // return $request->all();
        DB::beginTransaction();
        try {
            $items = $this->addItems($request);
            $purchase_request = $this->mCreate($request);
            $purchase_request->items()->saveMany($items);
            $formProcess = (new FormProcessRepository)->purchaseRequest($purchase_request);
            $formRoute = (new FormRouteRepository)->purchaseRequest($purchase_request, $formProcess);
            DB::commit();
            return $purchase_request;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function addItems($request)
    {
        $items = array();
        foreach ($request['items'] as $key => $item) {
            $item['total_unit_cost'] = $item['unit_cost'] * $item['quantity'];
            $items[$key] = new PurchaseRequestItem($item);
        }
        return $items;
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $new_items = $this->updateItems($request, $id);
            $purchase_request = $this->mUpdate($id, $request->all());
            $purchase_request->items()->saveMany($new_items);
            DB::commit();
            return $purchase_request;
        } catch (\Throwable $th) {
            throw $th;
        }

    }

    public function updateItems($request, $id)
    {
        $item_ids_form = array();
        $item_ids = PurchaseRequestItem::where('purchase_request_id',$id)->pluck('id')->toArray();
        $new_items = array();
        if($request['items'] != array()){
            foreach ($request['items'] as $key => $item) {
                $item['total_unit_cost'] = $item['unit_cost'] * $item['quantity'];
                if(isset($item['id'])){
                    PurchaseRequestItem::find($item['id'])->update($item);
                    $item_ids_form[] = $item['id']; 
                }else{
                    $new_items[$key] = new PurchaseRequestItem($item);
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
        PurchaseRequestItem::whereIn('id', $removed_item_ids)->delete();
    }
}

