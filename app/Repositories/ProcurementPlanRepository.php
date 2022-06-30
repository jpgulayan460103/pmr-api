<?php

namespace App\Repositories;

use App\Models\Library;
use App\Models\ProcurementPlan;
use App\Models\ProcurementPlanItem;
use App\Repositories\Interfaces\ProcurementPlanRepositoryInterface;
use App\Repositories\HasCrud;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ProcurementPlanRepository implements ProcurementPlanRepositoryInterface
{
    use HasCrud;

    public function __construct(ProcurementPlan $procurementPlan = null)
    {
        if(!($procurementPlan instanceof ProcurementPlan)){
            $procurementPlan = new ProcurementPlan;
        }
        $this->model($procurementPlan);
        $this->perPage(200);
    }

    public function search($filters)
    {
        if(isset($filters['offices_ids'])){
            $this->modelQuery()->whereIn('end_user_id', $filters['offices_ids']);
        }
        if(request()->has('purpose') && request('purpose') != ""){
            $this->modelQuery()->where('purpose', 'like', "%".request('purpose')."%");
        }
        if(request()->has('title') && request('title') != ""){
            $this->modelQuery()->where('title', 'like', "%".request('title')."%");
        }
        if(request()->has('total_cost') && request()->has('total_cost_op') && request('total_cost') != "" && request('total_cost_op') != ""){
            $total_cost_op = ( request('total_cost_op') == "<=" ? request('total_cost_op') : ">=" );
            $this->modelQuery()->where('total_cost', $total_cost_op, request('total_cost'));
        }
        if(request()->has('status') && request('status') != ""){
            $this->modelQuery()->whereIn('status', request('status'));
        }
        if(isset($filters['status'])){
            $this->modelQuery()->whereIn('status', $filters['status']);
        }
        if(request()->has('sa_or') && request('sa_or') != ""){
            $this->modelQuery()->where('sa_or', 'like', "%".request('sa_or')."%");
        }
        if(request()->has('purchase_request_number') && request('purchase_request_number') != ""){
            $this->modelQuery()->where('purchase_request_number', 'like', "%".request('purchase_request_number')."%");
        }
        if(request()->has('end_user_id') && request('end_user_id') != ""){
            $this->modelQuery()->whereIn('end_user_id', request('end_user_id'));
        }
        if(request()->has('account_id') && request('account_id') != ""){
            $this->modelQuery()->whereIn('account_id', request('account_id'));
        }
        if(request()->has('mode_of_procurement_id') && request('mode_of_procurement_id') != ""){
            $this->modelQuery()->whereIn('mode_of_procurement_id', request('mode_of_procurement_id'));
        }
        if(request()->has('purchase_request_type_category') && request('purchase_request_type_category') != ""){
            $account_ids = (new LibraryRepository)->modelQuery()->without('parent')->select('id')->whereIn('parent_id',request('purchase_request_type_category'))->pluck('id');
            $this->modelQuery()->whereIn('account_id', $account_ids);
        }
        if(request()->has('ppmp_date') && request('ppmp_date') != ""){
            $ppmp_date[] = Carbon::parse(str_replace('"', '', request('ppmp_date')[0]))->toDateString();
            $ppmp_date[] = Carbon::parse(str_replace('"', '', request('ppmp_date')[1]))->toDateString();
            $this->modelQuery()->whereBetween('ppmp_date', $ppmp_date);
        }

        if(request()->has('sortColumn') && request()->has('sortOrder')){
            $sortOrder = request('sortOrder') ==  'ascend' ? 'ASC' : 'DESC';  
            $this->modelQuery()->orderBy(request('sortColumn'), $sortOrder);
        }
        // $this->modelQuery()->orderBy('ppmp_date','desc');
        $this->modelQuery()->orderBy('id','desc');
        $result = $this->modelQuery()->paginate(20);
        return $result;
    }

    public function updateProcurementPlan($id, $data)
    {
        $old_procurement_plan = $this->attach('form_process')->getById($id);
        $procurement_plan = $this->update($id, $data);
        if(request()->has('items') && request('items') != array()){
            $itemsA = $this->updateItemsA($id);
            $itemsB = $this->updateItemsB($id);
            $procurement_plan->items()->saveMany($itemsA['items']);
            $procurement_plan->items()->saveMany($itemsB['items']);
        }

        if(request()->has('approved_by_id')){
            if($old_procurement_plan->approved_by_id != request('approved_by_id')){
                $formProcessRepository = new FormProcessRepository();
                $formProcess = $old_procurement_plan->form_process;
                $formProcessRepository->updateRouting($formProcess->id, "approved_by");
            }
        }
    }

    public function updateItemsA($id)
    {
        $itemTypeA = (new LibraryRepository)->getBy("name", ppmpCse())->first();
        $item_ids_form = array();
        $item_ids = ProcurementPlanItem::where('procurement_plan_id',$id)->where('item_type_id', $itemTypeA->id)->pluck('id')->toArray();
        $new_items = array();
        $items = request('itemsA');
        if($items != array()){
            foreach ($items as $key => $item) {
                if(isset($item['id'])){
                    ProcurementPlanItem::find($item['id'])->update($item);
                    $item_ids_form[] = $item['id']; 
                }else{
                    $item['item_type_id'] = $itemTypeA->id;
                    $new_items[$key] = new ProcurementPlanItem($item);
                }
            }
            $this->removeItems($item_ids,$item_ids_form);
        }
        return [
            'items' => $new_items,
        ];
    }

    public function updateItemsB($id)
    {
        $itemTypeB = (new LibraryRepository)->getBy("name", ppmpNonCse())->first();
        $item_ids_form = array();
        $item_ids = ProcurementPlanItem::where('procurement_plan_id',$id)->where('item_type_id', $itemTypeB->id)->pluck('id')->toArray();
        $new_items = array();
        $items = request('itemsB');
        if($items != array()){
            foreach ($items as $key => $item) {
                if(isset($item['id'])){
                    ProcurementPlanItem::find($item['id'])->update($item);
                    $item_ids_form[] = $item['id']; 
                }else{
                    $item['item_type_id'] = $itemTypeB->id;
                    $new_items[$key] = new ProcurementPlanItem($item);
                }
            }
            $this->removeItems($item_ids,$item_ids_form);
        }
        return [
            'items' => $new_items,
        ];
    }

    public function removeItems($item_ids,$item_ids_form)
    {
        $removed_item_ids = array_diff($item_ids,$item_ids_form);
        foreach ($removed_item_ids as $removed_item_id) {
            ProcurementPlanItem::where('id', $removed_item_id)->first()->delete();
        }
    }

    public function addItemsA()
    {
        $total_cost = 0;
        $new_items = array();
        if(request()->has('itemsA') && request('itemsA') != array()){
            foreach (request('itemsA') as $key => $item) {
                $total_quantity = $this->sumAllMon($item);
                $item['total_price'] = $item['price'] * $total_quantity;
                $total_cost += $item['total_price'];
                $item['total_quantity'] = $total_quantity;
                $new_items[$key] = new ProcurementPlanItem($item);
            }
        }
        return [
            'items' => $new_items,
            'total_cost' => $total_cost,
        ];
    }

    public function addItemsB()
    {
        $nonCse = Library::where('library_type','item_type')->where('name', ppmpNonCse())->first();
        $total_cost = 0;
        $new_items = array();
        if(request()->has('itemsB') && request('itemsB') != array()){
            foreach (request('itemsB') as $key => $item) {
                $total_quantity = $this->sumAllMon($item);
                $item['total_price'] = $item['price'] * $total_quantity;
                $total_cost += $item['total_price'];
                $item['total_quantity'] = $total_quantity;
                $item['item_type_id'] = $nonCse->id;
                $new_items[$key] = new ProcurementPlanItem($item);
            }
        }
        return [
            'items' => $new_items,
            'total_cost' => $total_cost,
        ];
    }

    public function sumAllMon($items)
    {
        $total = 0;
        $total += $items['mon1'];
        $total += $items['mon2'];
        $total += $items['mon3'];
        $total += $items['mon4'];
        $total += $items['mon5'];
        $total += $items['mon6'];
        $total += $items['mon7'];
        $total += $items['mon8'];
        $total += $items['mon9'];
        $total += $items['mon10'];
        $total += $items['mon11'];
        $total += $items['mon12'];
        return $total;
    }

    public function getApprovedItems()
    {
        config(['database.connections.mysql.strict' => false]);
        $items = ProcurementPlanItem::with(['item', 'item.item_category', 'item.item_type', 'item.unit_of_measure']);
        $items->where('procurement_plans.status','approved');
        $items->where('procurement_plans.end_user_id',119);
        $items->select(
            'procurement_plan_items.item_id',
            DB::raw('SUM(total_quantity) as sum_quantity'),
            DB::raw('ROUND(SUM(procurement_plan_items.total_price), 2) as sum_price'),
            DB::raw('(SELECT SUM(quantity) as total_quantity_pr FROM purchase_request_items left join purchase_requests ON purchase_requests.id = purchase_request_items.purchase_request_id where item_id = procurement_plan_items.item_id and purchase_requests.end_user_id = 119 and purchase_requests.status = "approved") as test')
        );
        $items->groupBy('procurement_plan_items.item_id');
        $items->leftJoin('procurement_plans','procurement_plans.id','=','procurement_plan_items.procurement_plan_id');
        // $items->leftJoin('purchase_request_items','purchase_request_items.item_id','=','procurement_plan_items.item_id');
        $items =  $items->get();
        config(['database.connections.mysql.strict' => true]);
        return $items;
    }

    public function getLastNumber()
    {
        $year = date("Y");
        $start_year = Carbon::parse("$year-01-01");
        $end_year = Carbon::parse("$year-01-01")->addYear()->subSecond();

        $last_number = 0;
        $last_procurement_plan = $this->model
        ->where('status','Approved')
        ->whereBetween('created_at', [$start_year, $end_year])
        ->limit(1)
        ->orderBy('id', 'desc')
        ->first();
        if($last_procurement_plan){
            $ppmp_number_exploded = explode("-", $last_procurement_plan->ppmp_number);
            $last_number = end($ppmp_number_exploded);
        }
        return (integer) $last_number;
    }

    public function calculateBudgets($data, $itemsA, $itemsB)
    {
        $data['total_price_a'] = $itemsA['total_cost'];
        $data['inflation_a'] = $itemsA['total_cost'] * 0.1;
        $data['contingency_a'] = $itemsA['total_cost'] * 0.1;
        $data['total_estimated_budget_a'] = $itemsA['total_cost'] + $data['inflation_a'] + $data['contingency_a'];

        $data['total_price_b'] = $itemsB['total_cost'];
        $data['inflation_b'] = $itemsB['total_cost'] * 0.1;
        $data['contingency_b'] = $itemsB['total_cost'] * 0.1;
        $data['total_estimated_budget_b'] = $itemsB['total_cost'] + $data['inflation_b'] + $data['contingency_b'];
        
        $data['total_estimated_budget'] = $data['total_estimated_budget_a'] + $data['total_estimated_budget_b'];
        return $data;
    }
}