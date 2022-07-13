<?php

namespace App\Transformers;

use App\Models\ActivityLogBatch;
use App\Transformers\Logs\RequisitionIssueLogTransformer;
use League\Fractal\TransformerAbstract;
use Illuminate\Support\Str;

class ActivityLogBatchTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [
        'subject',
        'logs',
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected array $availableIncludes = [
        'causer'
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(ActivityLogBatch $table)
    {
        return [
            'id' => $table->id,
            'key' => $table->id,
            'batch_uuid' => $table->batch_uuid,
            'form_type' => $table->form_type,
            'form_type_header' => Str::headline($table->form_type),
            'subject_type' => $table->subject_type,
            'subject_id' => $table->subject_id,
            'created_at' => $table->created_at->toDayDateTimeString(),
        ];
    }

    public function includeSubject(ActivityLogBatch $table)
    {
        if ($table->subject) {
            switch ($table->form_type) {
                case 'procurement_plan':
                    return $this->item($table->subject, new ProcurementPlanTransformer);
                    break;
                case 'requisition_issue':
                    return $this->item($table->subject, new RequisitionIssueTransformer);
                    break;
                case 'purchase_request':
                    return $this->item($table->subject, new PurchaseRequestTransformer);
                    break;
                case 'item_supply':
                    return $this->item($table->subject, new ItemSupplyTransformer);
                    break;
                
                default:
                    # code...
                    break;
            }
        }
    }
    public function includeLogs(ActivityLogBatch $table)
    {
        if ($table->logs) {
            return $this->collection($table->logs, new ActivityLogTransformer);
        }
    }
    public function includeCauser(ActivityLogBatch $table)
    {
        if ($table->causer) {
            return $this->item($table->causer, new UserTransformer);
        }
    }
}
