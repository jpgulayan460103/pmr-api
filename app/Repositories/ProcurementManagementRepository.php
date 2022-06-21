<?php

namespace App\Repositories;

use App\Models\ProcurementManagement;
use App\Models\ProcurementManagementItem;
use App\Models\RequisitionIssue;
use App\Repositories\Interfaces\ProcurementManagementRepositoryInterface;
use App\Repositories\HasCrud;

class ProcurementManagementRepository implements ProcurementManagementRepositoryInterface
{
    use HasCrud;
    public function __construct(ProcurementManagement $ProcurementManagement = null)
    {
        if(!($ProcurementManagement instanceof ProcurementManagement)){
            $ProcurementManagement = new ProcurementManagement;
        }
        $this->model($ProcurementManagement);
        $this->perPage(200);
    }

    public function createOrUpdateFromProcurementPlan($form)
    {
        $procurementPlanRepository = new ProcurementPlanRepository();
        $procurementPlanRepository->attach('items');
        $procurement_plan = $procurementPlanRepository->getById($form->id);
        $procurement_plan_data = [
            'end_user_id' => $procurement_plan->end_user_id,
            'calendar_year' => $procurement_plan->calendar_year,
        ];
        $procurement_management = $this->procurementManagement($procurement_plan_data);
        if($procurement_management == null){
            $procurement_management = $this->create($procurement_plan_data);
        }
        $items = $this->extractItemsFromProcurementPlan($procurement_plan);
        $procurement_management->items()->saveMany($items);
    }

    public function procurementManagement($data)
    {
        $procurement_management = $this->modelQuery()->where('end_user_id', $data['end_user_id'])->where('calendar_year', $data['calendar_year'])->first();
        return $procurement_management;
    }

    public function extractItemsFromProcurementPlan($procurement_plan)
    {
        $items = $procurement_plan->items->toArray();
        $new_items = array();
        foreach ($items as $key => $item) {
            $new_items[$key] = new ProcurementManagementItem($item);
            $new_items[$key]['form_type'] = 'procurement_plan';
            $new_items[$key]['form_sourceable_id'] = $procurement_plan->id;
            $new_items[$key]['procurement_plan_item_id'] = $item['id'];
            $new_items[$key]['form_sourceable_type'] = get_class($procurement_plan);
        }
        return $new_items;
    }

    public function updateFromRequisitionIssue($form)
    {
        $requisitionIssueRepository = new RequisitionIssueRepository();
        $requisition_issue = $requisitionIssueRepository->getById($form->id);

        $procurement_plan_data = [
            'end_user_id' => $requisition_issue->end_user_id,
            'calendar_year' => date("Y"),
        ];
        $procurement_management = $this->procurementManagement($procurement_plan_data);
        $items = $this->extractItemsFromRequisitionIssue($requisition_issue);
        $procurement_management->items()->saveMany($items);
    }

    public function extractItemsFromRequisitionIssue($requisition_issue)
    {
        $items = $requisition_issue->items->toArray();
        $new_items = array();
        foreach ($items as $key => $item) {
            $new_items[$key] = new ProcurementManagementItem($item);
            $new_items[$key]['form_type'] = 'requisition_issue';
            $new_items[$key]['form_sourceable_id'] = $requisition_issue->id;
            $new_items[$key]['procurement_plan_item_id'] = $item['procurement_plan_item_id'];
            $new_items[$key]['mon'.date('n')] = ($item['issue_quantity'] * -1);
            $new_items[$key]['total_quantity'] = ($item['issue_quantity'] * -1);
            $new_items[$key]['form_sourceable_type'] = get_class($requisition_issue);
        }
        return $new_items;
    }

    public function getItem($procurement_plan_item_id)
    {
        $procurement_management = ProcurementManagement::first();
        return $procurement_management->items($procurement_plan_item_id)->first();
    }
}