<?php

namespace App\Repositories;

use App\Models\BacTask;
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
        $this->perPage(10);
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
        if(isset($filters['purchase_request_type_id'])){
            $this->modelQuery()->whereIn('purchase_request_type_id', $filters['purchase_request_type_id']);
        }
        if(isset($filters['mode_of_procurement_id'])){
            $this->modelQuery()->whereIn('mode_of_procurement_id', $filters['mode_of_procurement_id']);
        }
        if(isset($filters['pr_date'])){
            $pr_date[] = Carbon::parse(str_replace('"', '', $filters['pr_date'][0]))->toDateString();
            $pr_date[] = Carbon::parse(str_replace('"', '', $filters['pr_date'][1]))->toDateString();
            $this->modelQuery()->whereBetween('pr_date', $pr_date);
        }
        $this->modelQuery()->orderBy('id','desc');
        return $this->modelQuery()->paginate($this->perPage);
    }

    public function create($data)
    {
        DB::beginTransaction();
        try {
            $items = $this->addItems();
            $data['total_cost'] = $items['total_cost'];
            $purchase_request = $this->mCreate($data);
            $purchase_request->items()->saveMany($items['items']);
            $formProcess = (new FormProcessRepository)->purchaseRequest($purchase_request);
            $formRoute = (new FormRouteRepository)->purchaseRequest($purchase_request, $formProcess);
            $purchase_request->save();
            DB::commit();
            return $purchase_request;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function addItems()
    {
        $total_cost = 0;
        $new_items = array();
        if(request()->has('items') && request('items') != array()){
            foreach (request('items') as $key => $item) {
                $item['total_unit_cost'] = $item['unit_cost'] * $item['quantity'];
                $total_cost += $item['total_unit_cost'];
                $new_items[$key] = new PurchaseRequestItem($item);
            }
        }
        return [
            'items' => $new_items,
            'total_cost' => $total_cost,
        ];
    }

    public function update($data, $id)
    {
        DB::beginTransaction();
        try {
            $old_purchase_request = $this->getById($id);
            if(request()->has('items') && request('items') != array()){
                $items = $this->updateItems($id);
                $data['total_cost'] = $items['total_cost'];
            }
            $purchase_request = $this->mUpdate($id, $data);
            if(request()->has('items') && request('items') != array()){
                $purchase_request->items()->saveMany($items['items']);
            }
            if(request()->has('requested_by_id')){
                if($old_purchase_request->requested_by_id != request('requested_by_id')){
                    $formProcessRepository = new FormProcessRepository;
                    $formProcess = $formProcessRepository->getByFormType('purchase_request', $id);
                    $formProcessRepository->updateRouting($formProcess->id, "OARD");
                }
            }
            DB::commit();
            return $purchase_request;
        } catch (\Throwable $th) {
            throw $th;
        }

    }

    public function updateItems($id)
    {
        $total_cost = 0;
        $item_ids_form = array();
        $item_ids = PurchaseRequestItem::where('purchase_request_id',$id)->pluck('id')->toArray();
        $new_items = array();
        foreach (request('items') as $key => $item) {
            $item['total_unit_cost'] = $item['unit_cost'] * $item['quantity'];
            $total_cost += $item['total_unit_cost'];
            if(isset($item['id'])){
                PurchaseRequestItem::find($item['id'])->update($item);
                $item_ids_form[] = $item['id']; 
            }else{
                $new_items[$key] = new PurchaseRequestItem($item);
            }
        }
        $this->removeItems($item_ids,$item_ids_form);
        return [
            'items' => $new_items,
            'total_cost' => $total_cost,
        ];
    }

    public function removeItems($item_ids,$item_ids_form)
    {
        $removed_item_ids = array_diff($item_ids,$item_ids_form);
        foreach ($removed_item_ids as $removed_item_id) {
            PurchaseRequestItem::where('id', $removed_item_id)->first()->delete();
        }
    }

    public function createOrUpdateBac($data)
    {
        $purchase_request = PurchaseRequest::with('bac_task')->find($data['purchase_request_id']);
        if($purchase_request->bac_task){
            $purchase_request->bac_task()->first()->update($data);
        }else{
            $purchase_request->bac_task()->create($data);
        }
        return $purchase_request;
        // return ;
    }
}

