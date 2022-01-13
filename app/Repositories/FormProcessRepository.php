<?php

namespace App\Repositories;

use App\Models\FormProcess;
use App\Repositories\Interfaces\FormProcessRepositoryInterface;
use App\Repositories\HasCrud;
use App\Repositories\LibraryRepository;
use App\Repositories\SignatoryRepository;

class FormProcessRepository implements FormProcessRepositoryInterface
{
    use HasCrud;
    public function __construct(FormProcess $formProcess = null)
    {
        if(!($formProcess instanceof FormProcess)){
            $formProcess = new FormProcess;
        }
        $this->model($formProcess);
        $this->perPage(200);
    }

    public function purchaseRequest($created_purchase_request)
    {
        $origin_office = (new LibraryRepository)->getById($created_purchase_request->end_user_id);
        $requested_by = (new SignatoryRepository)->getById($created_purchase_request->requested_by_id);
        $requested_by_office = (new LibraryRepository)->getById($requested_by->office_id);
        $approved_by = (new SignatoryRepository)->getById($created_purchase_request->approved_by_id);
        $approved_by_office = (new LibraryRepository)->getById($approved_by->office_id);
        $bacs_office = (new LibraryRepository)->getBy('title','BACS');
        $budget_office = (new LibraryRepository)->getBy('title','BS');
        $routes = [];

        //skip division chief if parent is ORD, OARDA and OARDO
        if($origin_office->parent->title != "ORD" && $origin_office->parent->title != "OARDA" && $origin_office->parent->title != "OARDO"){
            $routes[] = [
                "office_id" => $origin_office->parent->id,
                "office_name" => $origin_office->parent->name,
                "label" => "Division Chief"
            ];
        }
        $routes[] = [
            "office_id" => $requested_by->office_id,
            "label" => $requested_by->designation,
            "office_name" => $requested_by_office->name,
        ];

        $routes[] = [
            "office_id" => $bacs_office->id,
            "label" => $bacs_office->name,
            "office_name" => $bacs_office->name,
        ];

        $routes[] = [
            "office_id" => $budget_office->id,
            "label" => $budget_office->name,
            "office_name" => $budget_office->name,
        ];

        $routes[] = [
            "office_id" => $approved_by->office_id,
            "label" => $approved_by->designation,
            "office_name" => $approved_by_office->name,
        ];
        
        $data = [
            'process_description' => "Purchase Request Routing",
            'form_type' => "purchase_request",
            'office_id' => $origin_office->id
        ];
        
        $created_process = $created_purchase_request->form_process()->create($data);
        $created_process->form_routes = $routes;
        $created_process->save();
        return $created_process;
    }
}