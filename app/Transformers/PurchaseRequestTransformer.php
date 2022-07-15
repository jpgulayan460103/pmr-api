<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Transformers\PurchaseRequestItemTransformer;
use App\Transformers\UserTransformer;
use App\Transformers\FormProcessTransformer;
use App\Transformers\FormRouteTransformer;
use App\Transformers\BacTaskTransformer;

class PurchaseRequestTransformer extends TransformerAbstract
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
        'purchase_orders',
        'items',
        'bac_task',
        'end_user',
        'requested_by',
        'approved_by',
        'form_process',
        'form_routes',
        'account',
        'mode_of_procurement',
        'uacs_code',
        'form_uploads',
        'created_by',
        'requisition_issue'
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform($table)
    {
        $uuid_last = explode("-",$table->uuid);
        return [
            'id' => $table->id,
            'uuid' => $table->uuid,
            'uuid_last' => end($uuid_last),
            'display_log' => $table->pr_number ? $table->pr_number : $table->purpose,
            'pr_number' => $table->pr_number,
            'form_number' => $table->pr_number,
            'gen_number' => $table->gen_number,
            'purpose' => $table->purpose,
            'title' => $table->title,
            'fund_cluster' => $table->fund_cluster,
            'center_code' => $table->center_code,
            'total_cost' => $table->total_cost,
            'total_cost_formatted' => number_format($table->total_cost, 2),
            'common_amount' => $table->total_cost,
            'common_amount_formatted' => number_format($table->total_cost, 2),
            'pr_dir' => $table->pr_dir,
            'end_user_id' => $table->end_user_id,
            'account_id' => $table->account_id,
            'status' => $table->status,
            'remarks' => $table->remarks,
            'pr_date' => $table->pr_date,
            'bac_task_id' => $table->bac_task_id,
            'key' => $table->id,
            'requested_by_id' => $table->requested_by_id,
            'requested_by_name' => $table->requested_by_name,
            'requested_by_designation' => $table->requested_by_designation,
            'approved_by_id' => $table->approved_by_id,
            'approved_by_name' => $table->approved_by_name,
            'approved_by_designation' => $table->approved_by_designation,
            'mode_of_procurement_id' => $table->mode_of_procurement_id,
            'requisition_issue_id' => $table->requisition_issue_id,
            'uacs_code_id' => $table->uacs_code_id,
            'charge_to' => $table->charge_to,
            'alloted_amount' => $table->alloted_amount,
            'from_ppmp' => $table->from_ppmp,
            'sa_or' => $table->sa_or,
            'file' => route('api.purchase-requests.pdf', ['id' => $table->uuid]),
            'particulars' => $table->purpose, // set common field for all forms
        ];
    }

    public function includePurchaseOrders($table)
    {
        if ($table->purchase_orders) {
            return $this->item($table->purchase_orders, new LibraryTransformer);
        }
    }

    public function includeItems($table)
    {
        if ($table->items) {
            return $this->collection($table->items, new PurchaseRequestItemTransformer);
        }
    }

    public function includeBacTask($table)
    {
        if ($table->bac_task) {
            return $this->item($table->bac_task, new BacTaskTransformer);
        }
    }

    public function includeAccount($table)
    {
        if ($table->account) {
            return $this->item($table->account, new LibraryTransformer);
        }
    }
    public function includeModeOfProcurement($table)
    {
        if ($table->mode_of_procurement) {
            return $this->item($table->mode_of_procurement, new LibraryTransformer);
        }
    }
    public function includeUacsCode($table)
    {
        if ($table->uacs_code) {
            return $this->item($table->uacs_code, new LibraryTransformer);
        }
    }
    public function includeEndUser($table)
    {
        if ($table->end_user) {
            return $this->item($table->end_user, new LibraryTransformer);
        }
    }
    public function includeRequestedBy($table)
    {
        if ($table->requested_by) {
            return $this->item($table->requested_by, new LibraryTransformer);
        }
    }
    public function includeCreatedBy($table)
    {
        if ($table->created_by) {
            return $this->item($table->created_by, new UserTransformer);
        }
    }
    public function includeApprovedBy($table)
    {
        if ($table->approved_by) {
            return $this->item($table->approved_by, new LibraryTransformer);
        }
    }
    public function includeFormProcess($table)
    {
        if ($table->form_process) {
            return $this->item($table->form_process, new FormProcessTransformer);
        }
    }
    public function includeFormRoutes($table)
    {
        if ($table->form_routes) {
            return $this->collection($table->form_routes, new FormRouteTransformer);
        }
    }
    public function includeFormUploads($table)
    {
        if ($table->form_uploads) {
            return $this->collection($table->form_uploads, new FormUploadTransformer);
        }
    }
    public function includeRequisitionIssue($table)
    {
        if ($table->requisition_issue) {
            return $this->collection($table->requisition_issue, new FormUploadTransformer);
        }
    }
}
