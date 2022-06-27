<?php

namespace App\Repositories;

use App\Models\RequisitionIssue;
use App\Models\RequisitionIssueItem;
use App\Repositories\Interfaces\RequisitionIssueRepositoryInterface;
use App\Repositories\HasCrud;
use App\Rules\RequisitionIssue\MaxIfHasStock;
use App\Rules\RequisitionIssue\MinIfHasStock;
use Carbon\Carbon;

class RequisitionIssueRepository implements RequisitionIssueRepositoryInterface
{
    use HasCrud;
    public function __construct(RequisitionIssue $RequisitionIssue = null)
    {
        if(!($RequisitionIssue instanceof RequisitionIssue)){
            $RequisitionIssue = new RequisitionIssue;
        }
        $this->model($RequisitionIssue);
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
        if(request()->has('ris_date') && request('ris_date') != ""){
            $ris_date[] = Carbon::parse(str_replace('"', '', request('ris_date')[0]))->toDateString();
            $ris_date[] = Carbon::parse(str_replace('"', '', request('ris_date')[1]))->toDateString();
            $this->modelQuery()->whereBetween('ris_date', $ris_date);
        }

        if(request()->has('sortColumn') && request()->has('sortOrder')){
            $sortOrder = request('sortOrder') ==  'ascend' ? 'ASC' : 'DESC';  
            $this->modelQuery()->orderBy(request('sortColumn'), $sortOrder);
        }
        // $this->modelQuery()->orderBy('ris_date','desc');
        $this->modelQuery()->orderBy('id','desc');
        $result = $this->modelQuery()->paginate(20);
        return $result;
    }

    public function updateRequisitionIssue($id, $data)
    {
        $requisition_issue = $this->update($id, $data);
        if(request()->has('items') && request('items') != array()){
            $items = $this->updateItems($id);
            $requisition_issue->items()->saveMany($items['items']);
        }
        return $requisition_issue;
    }

    public function issueItems($id, $request)
    {
        $rules = [];
        $validated = $request->validate([
            'items.*.has_stock' => 'required',
            'items.*.issue_quantity' => [
                'required',
                'integer',
                new MinIfHasStock(),
                new MaxIfHasStock("request"),
                $request->from_ppmp == 1 ? new MaxIfHasStock("ppmp") : "",
            ],
        ]);
        return (new RequisitionIssueRepository())->updateRequisitionIssue($id, $request->all());
    }    

    public function addItems()
    {
        $new_items = array();
        if(request()->has('items') && request('items') != array()){
            foreach (request('items') as $key => $item) {
                $new_items[$key] = new RequisitionIssueItem($item);
            }
        }
        return [
            'items' => $new_items,
        ];
    }

    public function updateItems($id)
    {
        $item_ids_form = array();
        $item_ids = RequisitionIssueItem::where('requisition_issue_id',$id)->pluck('id')->toArray();
        $new_items = array();
        foreach (request('items') as $key => $item) {
            if(isset($item['id'])){
                RequisitionIssueItem::find($item['id'])->update($item);
                $item_ids_form[] = $item['id']; 
            }else{
                $new_items[$key] = new RequisitionIssueItem($item);
            }
        }
        $this->removeItems($item_ids,$item_ids_form);
        return [
            'items' => $new_items,
        ];
    }

    public function removeItems($item_ids,$item_ids_form)
    {
        $removed_item_ids = array_diff($item_ids,$item_ids_form);
        foreach ($removed_item_ids as $removed_item_id) {
            RequisitionIssueItem::where('id', $removed_item_id)->first()->delete();
        }
    }

    public function countThisYear()
    {
        $year = date("Y");
        $start_year = Carbon::parse("$year-01-01");
        $end_year = Carbon::parse("$year-01-01")->addYear()->subSecond();
        $count = $this->model->whereBetween('created_at', [$start_year, $end_year])->where('status','approved')->count();
        return $count;
    }
    public function getLastNumber()
    {
        $year = date("Y");
        $start_year = Carbon::parse("$year-01-01");
        $end_year = Carbon::parse("$year-01-01")->addYear()->subSecond();

        $last_number = 0;
        $last_requisition_issue = $this->model
        ->whereIn('status',['Approved','Received'])
        ->whereBetween('created_at', [$start_year, $end_year])
        ->limit(1)
        ->orderBy('id', 'desc')
        ->first();
        if($last_requisition_issue){
            $ris_number_exploded = explode("-", $last_requisition_issue->ris_number);
            $last_number = end($ris_number_exploded);
        }
        return (integer) $last_number;
    }

}