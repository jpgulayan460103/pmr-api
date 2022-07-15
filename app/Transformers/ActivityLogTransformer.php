<?php

namespace App\Transformers;

use App\Models\ActivityLog;
use App\Transformers\Logs\FormUploadLogTransformer;
use App\Transformers\Logs\ItemSupplyHistoryLogTransformer;
use App\Transformers\Logs\ItemSupplyLogTransformer;
use App\Transformers\Logs\ProcurementPlanItemLogTransformer;
use App\Transformers\Logs\ProcurementPlanLogTransformer;
use App\Transformers\Logs\PurchaseRequestItemLogTransformer;
use App\Transformers\Logs\PurchaseRequestLogTransformer;
use App\Transformers\Logs\RequisitionIssueItemLogTransformer;
use App\Transformers\Logs\RequisitionIssueLogTransformer;
use App\Transformers\Logs\UserAccessLogTransformer;
use League\Fractal\TransformerAbstract;
use Illuminate\Support\Str;

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
        'subject'
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(ActivityLog $table)
    {
        $form_type = getModelType($table->subject_type);
        if($table->subject_type){
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
                    break;
                case 'purchase_request':
                    $logger = new PurchaseRequestLogTransformer;
                    break;
                case 'purchase_request_item':
                    $logger = new PurchaseRequestItemLogTransformer;
                    break;
                case 'form_upload':
                    $logger = new FormUploadLogTransformer;
                    break;
                case 'item_supply':
                    $logger = new ItemSupplyLogTransformer;
                    break;
                case 'item_supply_history':
                    $logger = new ItemSupplyHistoryLogTransformer;
                    break;
                
                default:
                    # code...
                    break;
            }
        }else{
            switch ($table->log_name) {
                case 'user_login':
                case 'user_logout':
                    $logger = new UserAccessLogTransformer;
                    break;
                
                default:
                    # code...
                    break;
            }
        }
        return [
            'log_name' => $table->log_name,
            'key' => $table->id,
            'logger_id' => str_pad($table->id, 6, "0", STR_PAD_LEFT),
            'description' => ucwords($table->description),
            'form_type' => $form_type,
            'form_type_header' => Str::headline($form_type),
            'event' => $table->event,
            'subject_type' => $table->subject_type,
            'subject_id' => $table->subject_id,
            'causer_type' => $table->causer_type,
            'properties' => $this->addLabels($table, $logger->labels),
            'causer_id' => $table->causer_id,
            'batch_uuid' => $table->batch_uuid,
            'created_at' => $table->created_at,
        ];
    }

    public function addLabels($table, $labels)
    {
        // return json_decode($properties, true);
        $properties = $table->properties;
        $properties = json_decode($properties, true);
        $properties['changes'] = [];
        if($table->description == "deleted"){
            $properties['attributes'] = $properties['old'];   
        }
        if(isset($properties['attributes']) && $properties['attributes'] != array()){
            foreach ($properties['attributes'] as $key => $property) {
                if(isset($labels[$key])){
                    $data = [
                        'label' => $labels[$key],
                        'key' => "logger_$key",
                        'old' => isset($properties['old'][$key]) ? $properties['old'][$key] : "",
                        'new' => isset($properties['attributes'][$key]) ? $properties['attributes'][$key] : "",
                    ];
                    if($data['old'] == "" && $data['new'] == ""){
    
                    }else{
                        if($table->description == "deleted"){
                            $data['new'] = "";
                        }
                        $properties['changes'][] = $data;
                    }
                }
            }
        }
        unset($properties['old']);
        unset($properties['attributes']);
        return $properties['changes'];
    }

    public function includeSubject(ActivityLog $table)
    {
        if ($table->subject) {
            $form_type = getModelType($table->subject_type);
            switch ($form_type) {
                case 'form_upload':
                    return $this->item($table->subject, new FormUploadTransformer);
                    break;
                case 'procurement_plan':
                    return $this->item($table->subject, new ProcurementPlanTransformer);
                    break;
                case 'procurement_plan_item':
                    return $this->item($table->subject, new ProcurementPlanItemTransformer);
                    break;
                case 'requisition_issue':
                    return $this->item($table->subject, new RequisitionIssueTransformer);
                    break;
                case 'requisition_issue_item':
                    return $this->item($table->subject, new RequisitionIssueItemTransformer);
                    break;
                case 'purchase_request':
                    return $this->item($table->subject, new PurchaseRequestTransformer);
                    break;
                case 'item_supply':
                    return $this->item($table->subject, new ItemSupplyTransformer);
                    break;
                case 'item_supply_history':
                    return $this->item($table->subject, new ItemSupplyHistoryTransformer);
                    break;
                
                default:
                    # code...
                    break;
            }
        }
    }
}
