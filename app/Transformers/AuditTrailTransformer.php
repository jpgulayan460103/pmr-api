<?php

namespace App\Transformers;

use App\Models\ActivityLog;
use League\Fractal\TransformerAbstract;
use App\Transformers\PurchaseRequestTransformer;
use App\Transformers\PurchaseRequestItemTransformer;
use App\Transformers\FormUploadTransformer;
use App\Transformers\BacTaskTransformer;
use App\Transformers\Logs\BacTaskLogTransformer;
use App\Transformers\Logs\FormRouteLogTransformer;
use App\Transformers\Logs\FormUploadLogTransformer;
use App\Transformers\Logs\ItemLogTransformer;
use App\Transformers\Logs\LibraryLogTransformer;
use App\Transformers\Logs\PurchaseRequestItemLogTransformer;
use App\Transformers\Logs\PurchaseRequestLogTransformer;
use App\Transformers\Logs\SupplierContactLogTransformer;
use App\Transformers\Logs\SupplierLogTransformer;
use App\Transformers\UserTransformer;
use Illuminate\Support\Str;


class AuditTrailTransformer extends TransformerAbstract
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
        $log_type = "";
        switch ($activityLog->subject_type) {
            case 'App\Models\FormUpload':
                $log_type = "form_upload";
                $properties = (new FormUploadLogTransformer)->addLabels($activityLog);
                if($activityLog->description == "created"){
                    $description_str = "Uploaded an attachment.";
                }else{
                    $description_str = "Removed an attachment.";
                }
                break;
            case 'App\Models\PurchaseRequest':
                $log_type = "purchase_request";
                $properties = (new PurchaseRequestLogTransformer)->addLabels($activityLog->properties);
                $description_str = ucfirst($activityLog->description)." the purchase request.";
                break;
            case 'App\Models\PurchaseRequestItem':
                $log_type = "purchase_request_item";
                $properties = (new PurchaseRequestItemLogTransformer)->addLabels($activityLog);
                if($activityLog->description == "created"){
                    $description_str = "Added an item of the purchase request.";
                }else{
                    $description_str = ucfirst($activityLog->description)." an item of the purchase request.";
                }
                // $description_str = ucfirst($activityLog->description)." an item of the purchase request.";
                break;
            case 'App\Models\BacTask':
                $log_type = "bac_task";
                $properties = (new BacTaskLogTransformer)->addLabels($activityLog->properties);
                $description_str = ucfirst($activityLog->description)." the BAC data of the purchase request";
                break;
            case 'App\Models\SupplierContact':
                $log_type = "supplier_contact_person";
                $properties = (new SupplierContactLogTransformer)->addLabels($activityLog->properties);
                $description_str = ucfirst($activityLog->description)." the contact persons of a supplier";
                break;
            case 'App\Models\Supplier':
                $log_type = "supplier";
                $properties = (new SupplierLogTransformer)->addLabels($activityLog->properties);
                $description_str = ucfirst($activityLog->description)." the supplier";
                break;
            case 'App\Models\FormRoute':
                $log_type = "form_routing";
                $properties = (new FormRouteLogTransformer)->addLabels($activityLog);
                // $properties = $activityLog->properties;
                $description_str = ucfirst($activityLog->description)." the form route";
                break;
            case 'App\Models\Item':
                $log_type = "item";
                $properties = (new ItemLogTransformer)->addLabels($activityLog->properties);
                $description_str = ucfirst($activityLog->description)." the item";
                break;
            case 'App\Models\Library':
                $log_type = "library";
                $properties = (new LibraryLogTransformer)->addLabels($activityLog->properties);
                $description_str = ucfirst($activityLog->description)." the item";
                break;
            default:
                $log_type = $activityLog->log_name;
                $description_str = $activityLog->description;
                break;
        }
        return [
            'id' => $activityLog->id,
            'key' => $activityLog->id,
            'log_type' => Str::headline($log_type),
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
                case 'App\Models\SupplierContact':
                    return $this->item($activityLog->subject, new SupplierContactTransformer);
                    break;
                case 'App\Models\Supplier':
                    return $this->item($activityLog->subject, new SupplierTransformer);
                    break;
                case 'App\Models\FormRoute':
                    return $this->item($activityLog->subject, new FormRouteTransformer);
                    break;
                case 'App\Models\Item':
                    return $this->item($activityLog->subject, new ItemTransformer);
                    break;
                case 'App\Models\Library':
                    return $this->item($activityLog->subject, new LibraryTransformer);
                    break;
                
                default:
                    # code...
                    break;
            }
        }
    }
}
