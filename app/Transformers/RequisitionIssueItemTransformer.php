<?php

namespace App\Transformers;

use App\Models\RequisitionIssueItem;
use League\Fractal\TransformerAbstract;
use App\Transformers\ItemTransformer;
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
            'item_id' => $table->item_id,
            'request_quantity' => $table->request_quantity,
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

    public function includeItem(RequisitionIssueItem $table)
    {
        if ($table->item) {
            return $this->item($table->item, new ItemTransformer);
        }
    }
    
}
