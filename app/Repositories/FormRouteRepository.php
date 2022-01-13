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

    public function purchaseRequest($created_purchase_request, $formProcess){
        $data = [
            "route_type" => "purchase_request",
            "status" => "pending",
            "remarks" => "For Approval",
            "from_office_id" => $created_purchase_request->end_user_id,
            "to_office_id" => $formProcess['form_routes'][0]['office_id'],
            "form_process_id" => $formProcess['id'],
        ];
        $created_route = $created_purchase_request->form_routes()->create($data);
        return $created_route;
    }
}