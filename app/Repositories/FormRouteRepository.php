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

    public function purchaseRequest($purchase_request, $formProcess, $step = 0){
        $data = [
            "route_type" => "purchase_request",
            "status" => "pending",
            "remarks" => "For Approval",
            "origin_office_id" => $purchase_request->end_user_id,
            "from_office_id" => $purchase_request->end_user_id,
            "to_office_id" => $formProcess['form_routes'][$step]['office_id'],
            "form_process_id" => $formProcess['id'],
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
        return $this->modelQuery()->where('status','pending')->whereIn('to_office_id',$filters['offices_ids'])->get();
    }

    public function getLatestRoute($form_process_id)
    {
        return $this->modelQuery()->where('form_process_id', $form_process_id)->orderBy('id', 'desc')->first();
    }

    public function approveLatestRoute($form_process_id)
    {
        $user = Auth::user();
        $latestRoute = $this->getLatestRoute($form_process_id);
        $latestRoute->status = "approved";
        $latestRoute->remarks_by_id = $user->id;
        $latestRoute->save();
        return $latestRoute;
    }

    public function createNextRoute($latestRoute, $nextRoute)
    {
        $data = [
            "route_type" => $latestRoute->route_type,
            "status" => "pending",
            "remarks" => $latestRoute->remarks,
            "origin_office_id" => $latestRoute->origin_office_id,
            "from_office_id" => $latestRoute->to_office_id,
            "to_office_id" => $nextRoute['office_id'],
            "form_process_id" => $latestRoute->form_process_id,
            "form_routable_id" => $latestRoute->form_routable_id,
            "form_routable_type" => $latestRoute->form_routable_type,
        ];
        $created_route = $this->create($data);
        return $created_route;
    }

    public function completeForm($form)
    {
        $form->process_complete_status = 1;
        $form->process_complete_date = Carbon::now();
        $form->save();
    }
}