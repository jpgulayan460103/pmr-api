<?php

namespace App\Repositories;

use App\Models\FormProcess;
use App\Repositories\Interfaces\FormProcessRepositoryInterface;
use App\Repositories\HasCrud;
use App\Repositories\LibraryRepository;
use App\Repositories\UserOfficeRepository;
use App\Transformers\FormProcessTransformer;

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

    public function getByFormType($type, $id)
    {
        return $this->modelQuery()->where('form_type', $type)->where('id', $id)->first();
    }

    public function purchaseRequest($created_purchase_request)
    {
        $origin_office = (new LibraryRepository)->getById($created_purchase_request->end_user_id);
        $requested_by = (new LibraryRepository)->getById($created_purchase_request->requested_by_id);
        $requested_by_office = (new LibraryRepository)->getUserSectionBy('title',$requested_by->title);
        $approved_by = (new LibraryRepository)->getById($created_purchase_request->approved_by_id);
        $approved_by_office = (new LibraryRepository)->getUserSectionBy('title',$approved_by->title);
        $bacs_office = (new LibraryRepository)->getUserSectionBy('title','BACS');
        $budget_office = (new LibraryRepository)->getUserSectionBy('title','BS');
        $procurement_office = (new LibraryRepository)->getUserSectionBy('title','PS');
        $routes = [];

        //skip route if user section is procurement
        if($origin_office->id != $procurement_office->id){
            $routes[] = [
                "office_id" => $origin_office->id,
                "office_name" => $origin_office->name,
                "label" => "ORIGIN",
                "status" => "pending",
                "description" => "Finalization from the end user.",
                "description_code" => "aprroval_from_enduser",
            ];
        }

        $routes[] = [
            "office_id" => $procurement_office->id,
            "label" => "PROCUREMENT_1",
            "office_name" => $procurement_office->name,
            "status" => "pending",
            "description" => "Specification checking.",
            "description_code" => "select_action",
        ];

        //skip route if user division chief if parent is ORD, OARDA and OARDO
        if($origin_office->parent->title != "ORD" && $origin_office->parent->title != "OARDA" && $origin_office->parent->title != "OARDO"){
            $division = (new LibraryRepository)->getUserSectionBy('title',$origin_office->parent->title);
            $routes[] = [
                "office_id" => $division->id,
                "office_name" => $division->name,
                "label" => "DIVISION_CHIEF",
                "status" => "pending",
                "description" => "Approval from the division chief.",
                "description_code" => "aprroval_from_division",
            ];
        }

        $routes[] = [
            "office_id" => $bacs_office->id,
            "label" => "BACS",
            "office_name" => $bacs_office->name,
            "status" => "pending",
            "description" => "PPMP checking.",
            "description_code" => "aprroval_from_bac",
        ];

        
        $routes[] = [
            "office_id" => $requested_by_office->id,
            "label" => "OARD",
            "office_name" => $requested_by_office->name,
            "status" => "pending",
            "description" => "Approval from the ".$requested_by_office->title,
            "description_code" => "aprroval_from_oard",
        ];

        $routes[] = [
            "office_id" => $budget_office->id,
            "label" => "BS",
            "office_name" => $budget_office->name,
            "status" => "pending",
            "description" => "Budget allocation.",
            "description_code" => "aprroval_from_budget",
        ];

        $routes[] = [
            "office_id" => $approved_by_office->id,
            "label" => "ORD",
            "office_name" => $approved_by_office->name,
            "status" => "pending",
            "description" => "Approval from the ".$approved_by_office->title,
            "description_code" => "aprroval_from_ord",
        ];
        
        $data = [
            'process_description' => "Purchase Request Form Routing",
            'form_type' => "purchase_request",
            'office_id' => $origin_office->id,
            "status" => "pending",
        ];
        
        $created_process = $created_purchase_request->form_process()->create($data);
        $created_process->form_routes = $routes;
        $created_process->save();
        return $created_process;
    }

    public function updatePurchaseRequestRouting($process, $type)
    {
        if($type == "twg"){
            $new_routes = $this->purchaseRequestAddTwgRoute($process);
            $process->form_routes = $new_routes;
            $process->save();
        }elseif($type == "OARD"){
            $updated_oard_route = $this->purchaseRequestUpdateOardRoute($process);
            $process->form_routes = $updated_oard_route['new_routes'];
            $form_route_repository = new FormRouteRepository;
            $current_route = $form_route_repository->getCurrentRoute($process->id);
            if($updated_oard_route['old_oard_route']['office_id'] == $current_route->to_office_id){
                $data = [];
                $data['remarks'] = $updated_oard_route['new_oard_route']['description'];
                $data['to_office_id'] = $updated_oard_route['new_oard_route']['office_id'];
                $form_route_repository->update($current_route->id, $data);
            }
            $process->save();
        }
        return $process;
    }

    public function purchaseRequestAddTwgRoute($process)
    {
        $process = fractal($process, new FormProcessTransformer)->toArray();
        $form_routes = $process['form_routes'];
        $new_routes = [];
        foreach ($form_routes as $key => $form_route) {
            if($form_route['description_code'] == "select_action"){
                $new_routes[] = $form_route;
                $technical_working_group = (new LibraryRepository)->getById(request('technical_working_group_id'));
                $new_routes[] = [
                    "office_id" => $technical_working_group->id,
                    "label" => "TWG",
                    "office_name" => $technical_working_group->name,
                    "status" => "pending",
                    "description" => "Approval from the Technical Working Group",
                    "description_code" => "aprroval_from_twg",
                ];

                $procurement_office = (new LibraryRepository)->getUserSectionBy('title','PS');

                $new_routes[] = [
                    "office_id" => $procurement_office->id,
                    "label" => "PROCUREMENT_2",
                    "office_name" => $procurement_office->name,
                    "status" => "pending",
                    "description" => "Approval from the Procurement Section",
                    "description_code" => "aprroval_from_proc",
                ];
            }else{
                $new_routes[] = $form_route;
            }
        }
        return $new_routes;
    }

    public function purchaseRequestUpdateOardRoute($process)
    {
        $requested_by = (new LibraryRepository)->getById(request('requested_by_id'));
        $requested_by_office = (new LibraryRepository)->getUserSectionBy('title',$requested_by->title);
        $process = fractal($process, new FormProcessTransformer)->toArray();
        $form_routes = $process['form_routes'];
        $key = array_search("OARD", array_column($form_routes, 'label'));
        $new_oard_route = [
            "office_id" => $requested_by_office->id,
            "label" => "OARD",
            "office_name" => $requested_by_office->name,
            "status" => "pending",
            "description" => "Approval from the ".$requested_by_office->title,
            "description_code" => "aprroval_from_oard",
        ];
        $old_oard_route = $form_routes[$key];
        $form_routes[$key] = $new_oard_route;
        return [
            'new_routes' => $form_routes,
            'new_oard_route' => $new_oard_route,
            'old_oard_route' => $old_oard_route,
        ];
    }

    public function updateRouting($id, $type)
    {
        $process = $this->getById($id);
        if($process['form_processable_type'] == "App\\Models\\PurchaseRequest"){
            return $this->updatePurchaseRequestRouting($process, $type);
        }
    }

    public function procurementPlan($created_procurement_plan)
    {
        $origin_office = (new LibraryRepository)->getById($created_procurement_plan->end_user_id);
        $budget_office = (new LibraryRepository)->getUserSectionBy('title','BS');
        $rd_office = (new LibraryRepository)->getUserSectionBy('title','ORD');
        $routes = [];
        $routes[] = [
            "office_id" => $origin_office->id,
            "office_name" => $origin_office->name,
            "label" => "ORIGIN",
            "status" => "pending",
            "description" => "Finalization from the end user.",
            "description_code" => "ppmp_aprroval_from_enduser",
        ];

        $routes[] = [
            "office_id" => $budget_office->id,
            "label" => "BS",
            "office_name" => $budget_office->name,
            "status" => "pending",
            "description" => "Budget PPMP Approval.",
            "description_code" => "ppmp_aprroval_from_budget",
        ];

        if($origin_office->parent->title == "OARDO" || $origin_office->parent->title == "OARDA"){
            $oard = (new LibraryRepository)->getUserSectionBy('title',$origin_office->parent->title);
            $routes[] = [
                "office_id" => $oard->id,
                "office_name" => $oard->name,
                "label" => "OARD",
                "status" => "pending",
                "description" => "Approval from the OARD.",
                "description_code" => "ppmp_aprroval_from_division",
            ];
        }else{
            $routes[] = [
                "office_id" => $rd_office->id,
                "label" => "ORD",
                "office_name" => $rd_office->name,
                "status" => "pending",
                "description" => "Approval from the ".$rd_office->title,
                "description_code" => "ppmp_aprroval_from_ord",
            ];
        }

        $data = [
            'process_description' => "Project Procurement Management Plan (PPMP) Form Routing",
            'form_type' => "procurement_plan",
            'office_id' => $origin_office->id,
            "status" => "pending",
        ];
        
        $created_process = $created_procurement_plan->form_process()->create($data);
        $created_process->form_routes = $routes;
        $created_process->save();
        return $created_process;
    }
}