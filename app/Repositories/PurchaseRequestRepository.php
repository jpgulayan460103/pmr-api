<?php

namespace App\Repositories;

use App\Models\BacTask;
use App\Models\FormUpload;
use App\Models\PurchaseRequest;
use App\Models\PurchaseRequestItem;
use App\Repositories\Interfaces\PurchaseRequestRepositoryInterface;
use App\Repositories\HasCrud;
use Illuminate\Support\Facades\DB;
use App\Repositories\FormProcessRepository;
use App\Repositories\FormRouteRepository;
use App\Repositories\LibraryRepository;
use App\Transformers\FormProcessTransformer;
use App\Transformers\RequisitionIssueTransformer;
use Carbon\Carbon;

class PurchaseRequestRepository implements PurchaseRequestRepositoryInterface
{
    use HasCrud;
    public function __construct(PurchaseRequest $purchaseRequest = null)
    {
        if(!($purchaseRequest instanceof PurchaseRequest)){
            $purchaseRequest = new PurchaseRequest;
        }
        $this->model($purchaseRequest);
        $this->perPage(10);
        $this->uuid = "uuid";
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
        if(request()->has('pr_date') && request('pr_date') != ""){
            $pr_date[] = Carbon::parse(str_replace('"', '', request('pr_date')[0]))->toDateString();
            $pr_date[] = Carbon::parse(str_replace('"', '', request('pr_date')[1]))->toDateString();
            $this->modelQuery()->whereBetween('pr_date', $pr_date);
        }

        if(request()->has('sortColumn') && request()->has('sortOrder')){
            $sortOrder = request('sortOrder') ==  'ascend' ? 'ASC' : 'DESC';  
            $this->modelQuery()->orderBy(request('sortColumn'), $sortOrder);
        }
        // $this->modelQuery()->orderBy('pr_date','desc');
        $this->modelQuery()->orderBy('id','desc');
        $result = $this->modelQuery()->paginate(20);
        return $result;
    }

    public function updatePurchaseRequest($id, $data)
    {
        $old_purchase_request = $this->attach('form_process')->getById($id);
        if(request()->has('items') && request('items') != array()){
            $items = $this->updateItems($id);
            $data['total_cost'] = $items['total_cost'];
        }
        $purchase_request = $this->update($id, $data);
        if(request()->has('items') && request('items') != array()){
            $purchase_request->items()->saveMany($items['items']);
        }
        if(request()->has('requested_by_id')){
            if($old_purchase_request->requested_by_id != request('requested_by_id')){
                $formProcessRepository = new FormProcessRepository();
                $formProcess = $old_purchase_request->form_process;
                $formProcessRepository->updateRouting($formProcess->id, "requested_by");
            }
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
    }

    public function getLastNumber()
    {
        $year = date("Y");
        $start_year = Carbon::parse("$year-01-01");
        $end_year = Carbon::parse("$year-01-01")->addYear()->subSecond();
        return $this->modelQuery()->whereBetween('created_at', [$start_year, $end_year])->whereNotNull('purchase_request_number')->orderBy('id','desc')->limit(1)->first();
    }

    public function attachRequistionIssue($purchase_request)
    {
        $requisition_issue = (new RequisitionIssueRepository())->getById(request('requisition_issue_id'));
        $requisition_issue_transformed = fractal($requisition_issue, new RequisitionIssueTransformer)->toArray();
        $created = $purchase_request->form_uploads()->create([
            'upload_type' => 'database',
            'title' => $requisition_issue_transformed['form_number'],
            'form_type' => 'purchase_request',
            'form_attached' => 'requisition_issue',
            'form_attachable_id' => $requisition_issue->id,
            'form_attachable_type' => get_class($requisition_issue),
            'file_directory' => $requisition_issue_transformed['file'],
            'is_removable' => 0,
        ]);
        $purchase_request = $this->addRequistionIssueAttachments($purchase_request, $requisition_issue);
        return $purchase_request;
    }

    public function addRequistionIssueAttachments($purchase_request, $requisition_issue)
    {
        // $attachments = $requisition_issue->form_uploads()->where('upload_type', 'database')->get()->toArray();
        $attachments = $requisition_issue->form_uploads()->get()->toArray();
        $new_attachments = [];
        foreach ($attachments as $key => $attachment) {
            $attachment['is_removable'] = 0;
            $new_attachments[] = new FormUpload($attachment);
        }
        $purchase_request->form_uploads()->saveMany($new_attachments);
        return $purchase_request;
    }
}

