<?php

namespace App\Repositories;

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
        $this->modelQuery()->orderBy('ppmp_date','desc');
        // $this->modelQuery()->orderBy('id','desc');
        $result = $this->modelQuery()->paginate(20);
        return $result;
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
        $total_cost = 0;
        $new_items = array();
        if(request()->has('itemsB') && request('itemsB') != array()){
            foreach (request('itemsB') as $key => $item) {
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
}