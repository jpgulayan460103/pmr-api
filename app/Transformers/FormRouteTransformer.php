<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\FormRoute;
use Illuminate\Support\Str;
use App\Transformers\LibraryTransformer;
use App\Transformers\FormProcessTransformer;
use App\Transformers\UserTransformer;

class FormRouteTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [

    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected array $availableIncludes = [
        'form_routable',
        'end_user',
        'from_office',
        'to_office',
        'form_process',
        'processed_by',
        'forwarded_by',
        'user',
        'parent'
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(FormRoute $table)
    {
        return [
            'id' => $table->id,
            'key' => $table->id,
            'route_type' => $table->route_type,
            'route_type_str' => Str::headline($table->route_type),
            'status' => $table->status,
            'status_str' => Str::headline($table->status),
            'remarks' => $table->remarks,
            'display_log' => $table->remarks,
            'forwarded_remarks' => $table->forwarded_remarks,
            'forwarded_by_id' => $table->forwarded_by_id,
            'processed_by_id' => $table->processed_by_id,
            'origin_office_id' => $table->origin_office_id,
            'from_office_id' => $table->from_office_id,
            'to_office_id' => $table->to_office_id,
            'form_routable_id' => $table->form_routable_id,
            'form_routable_type' => $table->form_routable_type,
            'form_process_id' => $table->form_process_id,
            'action_taken' => $table->action_taken,
            'created_at' => $table->created_at->toDayDateTimeString(),
            'created_at_raw' => $table->created_at->toDateTimeString(),
            'created_at_date' => $table->created_at->toDateString(),
            'updated_at' => $table->updated_at->toDayDateTimeString(),
            'updated_at_raw' => $table->updated_at->toDateTimeString(),
        ];
    }

    public function includeParent(FormRoute $table)
    {
        if ($table->form_routable) {
            return $this->formRoutable($table);
        }
    }
    public function includeFormRoutable(FormRoute $table)
    {
        if ($table->form_routable) {
            return $this->formRoutable($table);
        }
    }
    public function includeEndUser(FormRoute $table)
    {
        if ($table->end_user) {
            return $this->item($table->end_user, new LibraryTransformer);
        }
    }
    public function includeToOffice(FormRoute $table)
    {
        if ($table->to_office) {
            return $this->item($table->to_office, new LibraryTransformer);
        }
    }
    public function includeFromOffice(FormRoute $table)
    {
        if ($table->from_office) {
            return $this->item($table->from_office, new LibraryTransformer);
        }
    }
    public function includeFormProcess(FormRoute $table)
    {
        if ($table->form_process) {
            return $this->item($table->form_process, new FormProcessTransformer);
        }
    }
    public function includeUser(FormRoute $table)
    {
        if ($table->user) {
            return $this->item($table->user, new UserTransformer);
        }
    }
    public function includeForwardedBy(FormRoute $table)
    {
        if ($table->forwarded_by) {
            return $this->item($table->forwarded_by, new UserTransformer);
        }
    }
    public function includeProcessedBy(FormRoute $table)
    {
        if ($table->processed_by) {
            return $this->item($table->processed_by, new UserTransformer);
        }
    }

    private function formRoutable(FormRoute $table)
    {
        switch ($table->route_type) {
            case 'purchase_request':
                return $this->item($table->form_routable, new PurchaseRequestTransformer);
                break;
            
            default:
                # code...
                break;
        }
    }
}
