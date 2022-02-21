<?php

namespace App\Repositories;

use App\Models\FormRoute;
use App\Repositories\Interfaces\FormRouteRepositoryInterface;
use App\Repositories\HasCrud;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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
            "remarks_by_id" => $user->id,
            "origin_office_id" => $purchase_request->end_user_id,
            "from_office_id" => $purchase_request->end_user_id,
            "to_office_id" => $formProcess['form_routes'][$step]['office_id'],
            "form_process_id" => $formProcess['id'],
            "owner_id" => $user->id,
            "forwarded_by_id" => $user->id,
        ];
        $created_route = $purchase_request->form_routes()->create($data);
        return $created_route;
    }

    public function approve()
    {
        # code...
    }


    public function getForApproval($request, $filters)
    {
        return $this->modelQuery()->where(function($query) {
            $query->where('status','pending')
                  ->orWhere('status','with_issues');
            })->whereIn('to_office_id',$filters['offices_ids'])->paginate($this->perPage);
    }


    public function updateRoute($id, $data)
    {
        $user = Auth::user();
        $data['remarks_by_id'] = $user->id;
        return $this->update($id, $data);
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
            "form_process_id" => $formRoute->form_process_id,
            "form_routable_id" => $formRoute->form_routable_id,
            "form_routable_type" => $formRoute->form_routable_type,
            "owner_id" => $formRoute->owner_id,
        ];
        $created_route = $this->create($data);
        return $created_route;
    }

    public function completeForm($form)
    {
        $form->disableLogging();
        $form->process_complete_status = 1;
        $form->status = "Approved";
        $form->process_complete_date = Carbon::now();
        $form->save();
    }

    public function returnToRejecter($id, $data)
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
}