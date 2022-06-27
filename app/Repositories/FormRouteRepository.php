<?php

namespace App\Repositories;

use App\Models\FormRoute;
use App\Repositories\Interfaces\FormRouteRepositoryInterface;
use App\Repositories\HasCrud;
use App\Rules\LibraryExistRule;
use App\Rules\RequisitionIssue\MaxIfHasStock;
use App\Rules\RequisitionIssue\MaxInventoryQuantity;
use App\Rules\RequisitionIssue\MinIfHasStock;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FormRouteRepository implements FormRouteRepositoryInterface
{
    use HasCrud;
    public function __construct(FormRoute $formRoute = null)
    {
        if(!($formRoute instanceof FormRoute)){
            $formRoute = new FormRoute;
        }
        $this->model($formRoute);
        $this->perPage(200);
    }

    public function getCurrentRoute($process_id)
    {
        return $this->model->where('form_process_id', $process_id)->orderBy('id','desc')->first();
    }

    public function purchaseRequest($purchase_request, $formProcess, $step = 0){
        $user = Auth::user();
        $data = [
            "route_type" => "purchase_request",
            "status" => "pending",
            "remarks" => "Finalization from the end user.",
            "processed_by_id" => null,
            "origin_office_id" => $purchase_request->end_user_id,
            "from_office_id" => $purchase_request->end_user_id,
            "to_office_id" => $formProcess['form_routes'][$step]['office_id'],
            "route_code" => $formProcess['form_routes'][$step]['description_code'],
            "form_process_id" => $formProcess['id'],
            "owner_id" => $user->id,
            "forwarded_by_id" => $user->id,
        ];
        $created_route = $purchase_request->form_routes()->create($data);
        return $created_route;
    }

    public function procurementPlan($procurement_plan, $formProcess, $step = 0){
        $user = Auth::user();
        $data = [
            "route_type" => "procurement_plan",
            "status" => "pending",
            "remarks" => "Finalization from the end user.",
            "processed_by_id" => null,
            "origin_office_id" => $procurement_plan->end_user_id,
            "from_office_id" => $procurement_plan->end_user_id,
            "to_office_id" => $formProcess['form_routes'][$step]['office_id'],
            "route_code" => $formProcess['form_routes'][$step]['description_code'],
            "form_process_id" => $formProcess['id'],
            "owner_id" => $user->id,
            "forwarded_by_id" => $user->id,
        ];
        $created_route = $procurement_plan->form_routes()->create($data);
        return $created_route;
    }
    public function requisitionIssue($requisition_issue, $formProcess, $step = 0){
        $user = Auth::user();
        $data = [
            "route_type" => "requisition_issue",
            "status" => "pending",
            "remarks" => "Finalization from the end user.",
            "processed_by_id" => null,
            "origin_office_id" => $requisition_issue->end_user_id,
            "from_office_id" => $requisition_issue->end_user_id,
            "to_office_id" => $formProcess['form_routes'][$step]['office_id'],
            "route_code" => $formProcess['form_routes'][$step]['description_code'],
            "form_process_id" => $formProcess['id'],
            "owner_id" => $user->id,
            "forwarded_by_id" => $user->id,
        ];
        $created_route = $requisition_issue->form_routes()->create($data);
        return $created_route;
    }

    public function getProcessed($type, $filters)
    {
        $user = Auth::user();
        $results = $this->modelQuery()->where('form_routes.status', $type);
        if(!$user->hasRole('super-admin')){
            $results->where('processed_by_id',$user->id);
        }
        if($type == "approved"){
            $results->where('route_code','<>','route_origin');
        }
        $results = $this->filters($results, $filters);
        $results = $results->paginate(20);
        return $results;   
    }

    public function getPending($filters)
    {
        $results = $this->modelQuery();
        $results->where(function($query) {
            $query->where('form_routes.status','pending')
                  ->orWhere('form_routes.status','with_issues');
            }
        );
        $results = $this->filters($results, $filters);
        $results = $results->paginate(20);
        return $results;
    }

    public function filters($results, $filters)
    {
        if(
            isset($filters['title']) ||
            isset($filters['purpose']) ||
            isset($filters['sortColumn']) ||
            (isset($filters['total_cost']) && isset($filters['total_cost_op']))
        ){
            $results->join('purchase_requests', 'form_routes.form_routable_id', '=', 'purchase_requests.id');
            $results->select('form_routes.*','purchase_requests.title', 'purchase_requests.purpose', 'purchase_requests.total_cost');
            if(isset($filters['title'])){
                $results->where('title','like',"%".$filters['title']."%");
            }
            if(isset($filters['purpose'])){
                $results->where('purpose','like',"%".$filters['purpose']."%");
            }

            if(isset($filters['total_cost']) && isset($filters['total_cost_op'])){
                $total_cost_op = $filters['total_cost_op'] == "<=" ? $filters['total_cost_op'] : ">=" ;
                $results->where('total_cost', $total_cost_op, $filters['total_cost']);
            }


            if(isset($filters['sortColumn']) && isset($filters['sortOrder'])){
                $table = "form_routes.";
                $column = $filters['sortColumn'];
                switch ($column) {
                    case 'title':
                    case 'purpose':
                    case 'total_cost':
                        $table = "purchase_requests.";
                        break;
                    default:
                        # code...
                        break;
                }
                $filters['sortOrder'] = $filters['sortOrder'] ==  'ascend' ? 'ASC' : 'DESC';  
                $results->orderBy($table.$column, $filters['sortOrder']);
            }else{
                $results->orderBy('id','desc');
            }
        }
        if(isset($filters['end_user_id'])){
            $results->whereIn('form_routes.origin_office_id', $filters['end_user_id']);
        }
        if(isset($filters['created_at']) && $filters['created_at'] != array() && count($filters['created_at']) == 2){
            $results->whereBetween('form_routes.created_at', [
                Carbon::parse($filters['created_at'][0]),
                Carbon::parse($filters['created_at'][1])->addDay()->subSecond()
            ]);
        }
        if(isset($filters['updated_at']) && $filters['updated_at'] != array() && count($filters['updated_at']) == 2){
            $results->whereBetween('form_routes.updated_at', [
                Carbon::parse($filters['updated_at'][0]),
                Carbon::parse($filters['updated_at'][1])->addDay()->subSecond()
            ]);
        }

        if(isset($filters['remarks'])){
            $results->where('form_routes.remarks', 'like', "%".$filters['remarks']."%");
        }
        if(isset($filters['forwarded_remarks'])){
            $results->where('form_routes.forwarded_remarks', 'like', "%".$filters['forwarded_remarks']."%");
        }
        if(isset($filters['offices_ids'])){
            $results->whereIn('form_routes.to_office_id',$filters['offices_ids']);
        }
        return $results;
    }


    public function updateRoute($formRoute, $data)
    {
        $user = Auth::user();
        $data['processed_by_id'] = $user->id;
        return $this->update($formRoute->id, $data);
    }

    public function proceedNextRoute($formRoute, $nextRoute, $remarks)
    {
        $user = Auth::user();
        $data = [
            "route_type" => $formRoute->route_type,
            "status" => "pending",
            "remarks" => $nextRoute['description'],
            "forwarded_remarks" => (isset($remarks) && $remarks != "") ? $remarks : null,
            "forwarded_by_id" => $user->id,
            "origin_office_id" => $formRoute->origin_office_id,
            "from_office_id" => $formRoute->to_office_id,
            "to_office_id" => $nextRoute['office_id'],
            "route_code" => $nextRoute['description_code'],
            "form_process_id" => $formRoute->form_process_id,
            "form_routable_id" => $formRoute->form_routable_id,
            "form_routable_type" => $formRoute->form_routable_type,
            "owner_id" => $formRoute->owner_id,
        ];
        $created_route = $this->create($data);
        return $created_route;
    }

    public function completeForm($formRoute)
    {
        $formProcess = $formRoute->form_process;
        $form = $formRoute->form_routable;
        $form->disableLogging();
        $formProcess->is_complete = 1;
        $formProcess->completed_date = Carbon::now();
        $form->status = "Approved";
        $formProcess->save();
        $form->save();

        switch ($formRoute->route_type) {
            case 'purchase_request':
                return "The purchase request is approved.";
                break;
            case 'procurement_plan':
                return "The procurement plan is approved.";
                break;
            case 'requisition_issue':
                $form->status = "Received";
                $form->save();
                return "The items on requisition and issue slip is received.";
                break;
            
            default:
                # code...
                break;
        }
    }

    public function updateProcurementManagement($formRoute)
    {
        $formProcess = $formRoute->form_process;
        $form = $formRoute->form_routable;
        switch ($formProcess->form_type) {
            case 'procurement_plan':
                if($formRoute->route_code == "last_route"){
                    $procurementManagement = new ProcurementManagementRepository();
                    return $procurementManagement->createOrUpdateFromProcurementPlan($form);
                }
                break;
            case 'requisition_issue':
                if($formRoute->route_code == "ris_issuance_from_property" && $form->from_ppmp == 1){
                    $procurementManagement = new ProcurementManagementRepository();
                    return $procurementManagement->updateFromRequisitionIssue($form);
                }
                break;
            
            default:
                # code...
                break;
        }
    }

    public function returnTo($id, $data)
    {
        
        $form_route = $this->getById($id);
        $data = [
            'from_office_id'=> $form_route->to_office_id,
            'route_type'=> $form_route->route_type,
            'rejected_route_id'=> $form_route->id,
            'origin_office_id'=> $form_route->origin_office_id,
            'form_routable_id'=> $form_route->form_routable_id,
            'form_routable_type'=> $form_route->form_routable_type,
            'form_process_id'=> $form_route->form_process_id,
            'owner_id'=> $form_route->owner_id,
            'to_office_id'=> isset($data['to_office_id']) ? $data['to_office_id'] : $form_route->origin_office_id,
        ];
        return $data;
    }

    public function isFormProcessed($id)
    {
        $form = $this->getById($id);
        return $form->status != "pending" && $form->status != "with_issues";
    }

    public function verifyRoute($id)
    {
        if($this->isFormProcessed($id)){
            abort(404);
        }
    }

    public function updateFormRoutable($request, $id)
    {
        $formRoute = $this->attach('form_process, form_routable.end_user')->getById($id);
        switch ($formRoute->route_type) {
            case 'purchase_request':
                $this->updatePurchaseRequestForm($formRoute, $request);
                break;
            case 'requisition_issue':
                $this->updateRequisitionIssueForm($formRoute, $request);
                break;
            
            default:
                # code...
                break;
        }
    }

    public function updatePurchaseRequestForm($formRoute, $request)
    {
        if(request()->input() != array()){
            if(request()->has("updater") && (request('updater') == "procurement" || request('updater') == "budget")){
                switch (request('updater')) {
                    case 'procurement':
                        if(request()->has('type') && request('type') == "twg"){
                            $validated = $request->validate([
                                'type' => 'required',
                                'technical_working_group_id' => ['required', new LibraryExistRule('technical_working_group')],
                            ]);
                        }else{
                            $validated = $request->validate([
                                'type' => 'required',
                                'account_id' => ['required', new LibraryExistRule('account')],
                                'mode_of_procurement_id' => ['required', new LibraryExistRule('mode_of_procurement')],
                                'account_classification' => ['required', new LibraryExistRule('account_classification')],
                            ]);
                        }
                        break;
                    case 'budget':
                        $validated = $request->validate([
                            'purchase_request_number_last' => 'required|numeric|digits:5',
                            'fund_cluster' => 'required|string',
                            'charge_to' => 'required|string',
                            'alloted_amount' => 'required|numeric',
                            'uacs_code_id' => ['required', new LibraryExistRule('uacs_code')],
                            'sa_or' => 'required|string',
                            'purchase_request_number' => 'required|string|unique:purchase_requests,purchase_request_number',
                        ], [
                            'purchase_request_number.unique' => "The purchase request number has already been in the database."
                        ]);
                        break;
                    
                    default:
                        
                        break;
                }
                $formId = $formRoute->form_process->form_processable_id;
                (new PurchaseRequestRepository())->update($formId, $request->all());
    
                $this->modifyRoute($formRoute);
            }
        }
    }

    public function updateRequisitionIssueForm($formRoute, $request)
    {
        $user = Auth::user();
        $formId = $formRoute->form_process->form_processable_id;
        switch ($formRoute->route_code) {
            case 'ris_aprroval_from_division':
            case 'ris_aprroval_from_section':
                $data = [
                    'requested_by_date' => Carbon::now()
                ];
                (new RequisitionIssueRepository())->updateRequisitionIssue($formId, $data);
                break;
            case 'ris_aprroval_from_property':
                $data = [
                    'approved_by_date' => Carbon::now(),
                    'status' => 'Approved'
                ];
                (new RequisitionIssueRepository())->updateRequisitionIssue($formId, $data);
                break;
            case 'ris_issuance_from_property':
                $data = [
                    'issued_by_date' => Carbon::now(),
                    'issued_by_designation' => $user->user_information->position->name,
                    'issued_by_name' => $user->user_information->fullname,
                    'issued_items' => request('issued_items')
                ];
                if(request()->has('issued_items') && request('issued_items') != []){
                    $validated = $request->validate([
                        'issued_items.*.quantity' => ['required', new MaxInventoryQuantity],
                        'issued_items.*.item_supply_id' => ['required'],
                    ]);
                }
                $form = (new RequisitionIssueRepository())->updateRequisitionIssue($formId, $data);
                (new ItemSupplyHistoryRepository())->createFromRequisitionIssue($form, $data);
                break;
            case 'last_route':
                $data = [
                    'received_by_date' => Carbon::now(),
                    'received_by_designation' => $user->user_information->position->name,
                    'received_by_name' => $user->user_information->fullname,
                    'status' => 'Received'
                ];
                (new RequisitionIssueRepository())->updateRequisitionIssue($formId, $data);
                break;
            default:
                # code...
                break;
        }
    }

    public function modifyRoute($formRoute)
    {
        if(request()->has("type") && request("type") == "twg" && request('updater') == "procurement"){
            $formProcessId = $formRoute->form_process->id;
            (new FormProcessRepository())->updateRouting($formProcessId, request("type"));
        }
    }

    public function addFormNumber($formRoute, $form_id)
    {
        switch ($formRoute->route_type) {
            case 'requisition_issue':
                if($formRoute->route_code == "ris_aprroval_from_property"){
                    $form = (new RequisitionIssueRepository())->getById($form_id);
                    $last_number = (new RequisitionIssueRepository())->getLastNumber();
                    $form->ris_number = "RIS-".Carbon::now()->format('Y-m-').str_pad(++$last_number, 5, "0", STR_PAD_LEFT);
                    $form->save();
                }
                break;
            
            default:
                # code...
                break;
        }
    }

}