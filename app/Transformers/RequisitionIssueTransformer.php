<?php

namespace App\Transformers;

use App\Models\RequisitionIssue;
use League\Fractal\TransformerAbstract;
use App\Transformers\FormProcessTransformer;
use App\Transformers\FormRouteTransformer;
use App\Transformers\FormUploadTransformer;
use App\Transformers\ProcurementPlanItemTransformer;
use App\Transformers\LibraryTransformer;

class RequisitionIssueTransformer extends TransformerAbstract
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
        'form_process',
        'form_routes',
        'form_uploads',
        'items',
        'end_user',
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(RequisitionIssue $table)
    {
        return [
            'uuid' => $table->uuid,
            'title' => $table->title,
            'fund_cluster' => $table->fund_cluster,
            'center_code' => $table->center_code,
            'purpose' => $table->purpose,
            'recommendation' => $table->recommendation,
            'ris_date' => $table->ris_date,
            'ris_number' => $table->ris_number,
            'status' => $table->status,
            'remarks' => $table->remarks,
            'created_by_id' => $table->created_by_id,
            'end_user_id' => $table->end_user_id,
            'requested_by_name' => $table->requested_by_name,
            'requested_by_name' => $table->requested_by_name,
            'requested_by_date' => $table->requested_by_date,
            'approved_by_name' => $table->approved_by_name,
            'approved_by_name' => $table->approved_by_name,
            'approved_by_date' => $table->approved_by_date,
            'issued_by_name' => $table->issued_by_name,
            'issued_by_name' => $table->issued_by_name,
            'issued_by_date' => $table->issued_by_date,
            'received_by_name' => $table->received_by_name,
            'received_by_name' => $table->received_by_name,
            'received_by_date' => $table->received_by_date,
            'file' => "",
        ];
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

    public function includeItems(RequisitionIssue $table)
    {
        if ($table->items) {
            return $this->collection($table->items, new ProcurementPlanItemTransformer);
        }
    }
    public function includeEndUser(RequisitionIssue $table)
    {
        if ($table->end_user) {
            return $this->item($table->end_user, new LibraryTransformer);
        }
    }
}
