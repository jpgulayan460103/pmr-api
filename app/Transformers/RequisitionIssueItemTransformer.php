<?php

namespace App\Transformers;

use App\Models\RequisitionIssueItem;
use League\Fractal\TransformerAbstract;
use App\Transformers\ProcurementPlanItemTransformer;
use App\Transformers\RequisitionIssueTransformer;

class RequisitionIssueItemTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [
        //
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected array $availableIncludes = [
        'requisition_issue',
        'procurement_plan_item',
        'unit_of_measure',
        'item',
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(RequisitionIssueItem $table)
    {
        return [
            'requisition_issue_id' => $table->requisition_issue_id,
            'id' => $table->id,
            'key' => $table->id,
            'procurement_plan_item_id' => $table->procurement_plan_item_id,
            'item_id' => $table->item_id,
            'request_quantity' => $table->request_quantity,
            'description' => $table->description,
            'issue_quantity' => $table->issue_quantity,
            'has_stock' => $table->has_stock,
        ];
    }

    public function includeRequisitionIssue(RequisitionIssueItem $table)
    {
        if ($table->requisition_issue) {
            return $this->item($table->requisition_issue, new RequisitionIssueTransformer);
        }
    }

    public function includeProcurementPlanItem(RequisitionIssueItem $table)
    {
        if ($table->procurement_plan_item) {
            return $this->item($table->procurement_plan_item, new ProcurementPlanItemTransformer);
        }
    }
    public function includeItem(RequisitionIssueItem $table)
    {
        if ($table->item) {
            return $this->item($table->item, new ItemTransformer);
        }
    }
    public function includeUnitOfMeasure(RequisitionIssueItem $table)
    {
        if ($table->unit_of_measure) {
            return $this->item($table->unit_of_measure, new LibraryTransformer);
        }
    }
    
}
