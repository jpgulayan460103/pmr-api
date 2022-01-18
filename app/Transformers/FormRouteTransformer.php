<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\FormRoute;
use Illuminate\Support\Str;
use App\Transformers\LibraryTransformer;
use App\Transformers\FormProcessTransformer;

class FormRouteTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [

    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'form_routable',
        'end_user',
        'to_office',
        'form_process',
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
            'remarks_by_id' => $table->remarks_by_id,
            'origin_office_id' => $table->origin_office_id,
            'from_office_id' => $table->from_office_id,
            'to_office_id' => $table->to_office_id,
            'form_routable_id' => $table->form_routable_id,
            'form_routable_type' => $table->form_routable_type,
            'form_process_id' => $table->form_process_id,
            'created_at' => $table->created_at->toDayDateTimeString(),
            'updated_at' => $table->updated_at->toDayDateTimeString(),
        ];
    }

    public function includeFormRoutable(FormRoute $table)
    {
        if ($table->form_routable) {
            return $this->item($table->form_routable, new PurchaseRequestTransformer);
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
    public function includeFormProcess(FormRoute $table)
    {
        if ($table->form_process) {
            return $this->item($table->form_process, new FormProcessTransformer);
        }
    }
}
