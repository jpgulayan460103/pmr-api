<?php

namespace App\Repositories;

use App\Models\FormRoute;
use App\Repositories\Interfaces\FormRouteRepositoryInterface;
use App\Repositories\HasCrud;

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
}