<?php

namespace App\Transformers;

use App\Models\ActivityLog;
use League\Fractal\TransformerAbstract;
use App\Transformers\PurchaseRequestTransformer;
use App\Transformers\PurchaseRequestItemTransformer;
use App\Transformers\PurchaseRequestItemLogTransformer;
use App\Transformers\BacTaskLogTransformer;
use App\Transformers\FormUploadTransformer;
use App\Transformers\BacTaskTransformer;
use App\Transformers\UserTransformer;


class AuditTrailTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'user',
        'subject',
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(ActivityLog $activityLog)
    {
        $properties = json_decode($activityLog->properties);
        $description_str = "";
        switch ($activityLog->subject_type) {
            case 'App\Models\FormUpload':
                $properties = (new FormUploadLogTransformer)->addLabels($activityLog);
                if($activityLog->description == "created"){
                    $description_str = "Uploaded an attachment.";
                }else{
                    $description_str = "Removed an attachment.";
                }
                break;
            case 'App\Models\PurchaseRequest':
                $properties = (new PurchaseRequestLogTransformer)->addLabels($activityLog->properties);
                $description_str = ucfirst($activityLog->description)." the purchase request.";
                break;
            case 'App\Models\PurchaseRequestItem':
                $properties = (new PurchaseRequestItemLogTransformer)->addLabels($activityLog);
                if($activityLog->description == "created"){
                    $description_str = "Added an item of the purchase request.";
                }else{
                    $description_str = ucfirst($activityLog->description)." an item of the purchase request.";
                }
                // $description_str = ucfirst($activityLog->description)." an item of the purchase request.";
                break;
            case 'App\Models\BacTask':
                $properties = (new BacTaskLogTransformer)->addLabels($activityLog->properties);
                $description_str = ucfirst($activityLog->description)." the BAC data of the purchase request";
                break;
            
            default:
                $description_str = $activityLog->description;
                break;
        }
        return [
            'id' => $activityLog->id,
            'key' => $activityLog->id,
            'log_name' => $activityLog->log_name,
            'description' => $activityLog->description,
            'description_str' => $description_str,
            'subject_type' => $activityLog->subject_type,
            'subject_id' => $activityLog->subject_id,
            'causer_type' => $activityLog->causer_type,
            'causer_id' => $activityLog->causer_id,
            'properties' => $properties,
            'created_at' => $activityLog->created_at->toDayDateTimeString(),
        ];
    }

    public function includeUser(ActivityLog $activityLog)
    {
        if ($activityLog->user) {
            return $this->item($activityLog->user, new UserTransformer);
        }
    }
    public function includeSubject(ActivityLog $activityLog)
    {
        if ($activityLog->subject) {
            switch ($activityLog->subject_type) {
                case 'App\Models\FormUpload':
                    return $this->item($activityLog->subject, new FormUploadTransformer);
                    break;
                case 'App\Models\PurchaseRequest':
                    return $this->item($activityLog->subject, new PurchaseRequestTransformer);
                    break;
                case 'App\Models\PurchaseRequestItem':
                    return $this->item($activityLog->subject, new PurchaseRequestItemTransformer);
                    break;
                case 'App\Models\BacTask':
                    return $this->item($activityLog->subject, new BacTaskTransformer);
                    break;
                
                default:
                    # code...
                    break;
            }
        }
    }
}
