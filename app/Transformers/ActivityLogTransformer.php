<?php

namespace App\Transformers;

use App\Models\ActivityLog;
use App\Transformers\Logs\FormUploadLogTransformer;
use App\Transformers\Logs\ProcurementPlanItemLogTransformer;
use App\Transformers\Logs\ProcurementPlanLogTransformer;
use App\Transformers\Logs\PurchaseRequestItemLogTransformer;
use App\Transformers\Logs\PurchaseRequestLogTransformer;
use App\Transformers\Logs\RequisitionIssueItemLogTransformer;
use App\Transformers\Logs\RequisitionIssueLogTransformer;
use League\Fractal\TransformerAbstract;

class ActivityLogTransformer extends TransformerAbstract
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
        //
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(ActivityLog $table)
    {
        $form_type = getModelType($table->subject_type);
        switch ($form_type) {
            case 'procurement_plan':
                $logger = new ProcurementPlanLogTransformer;
                break;
            case 'procurement_plan_item':
                $logger = new ProcurementPlanItemLogTransformer;
                break;
            case 'requisition_issue':
                $logger = new RequisitionIssueLogTransformer;
                break;
            case 'requisition_issue_item':
                $logger = new RequisitionIssueItemLogTransformer;
            case 'purchase_request':
                $logger = new PurchaseRequestLogTransformer;
                break;
            case 'purchase_request_item':
                $logger = new PurchaseRequestItemLogTransformer;
                break;
            case 'form_upload':
                $logger = new FormUploadLogTransformer;
                break;
            
            default:
                # code...
                break;
        }
        return [
            'log_name' => $table->log_name,
            'description' => $table->description,
            'form_type' => $form_type,
            'event' => $table->event,
            'subject_type' => $table->subject_type,
            'subject_id' => $table->subject_id,
            'causer_type' => $table->causer_type,
            'properties' => $logger->addLabels($table->properties),
            'causer_id' => $table->causer_id,
            'batch_uuid' => $table->batch_uuid,
            'created_at' => $table->created_at,
        ];
    }
}
