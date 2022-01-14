<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\FormRoute;
use Illuminate\Support\Str;
use App\Transformers\LibraryTransformer;

class FormRouteTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        'form_routable',
        'end_user'
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
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
            'route_type' => Str::headline($table->route_type),
            'status' => $table->status,
            'remarks' => $table->remarks,
            'remarks_by_id' => $table->remarks_by_id,
            'origin_office_id' => $table->origin_office_id,
            'from_office_id' => $table->from_office_id,
            'to_office_id' => $table->to_office_id,
            'form_routable_id' => $table->form_routable_id,
            'form_routable_type' => $table->form_routable_type,
            'form_process_id' => $table->form_process_id,
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
}
