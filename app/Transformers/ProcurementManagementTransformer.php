<?php

namespace App\Transformers;

use App\Models\ProcurementManagement;
use League\Fractal\TransformerAbstract;
use App\Transformers\ProcurementManagementItemTransformer;
use App\Transformers\LibraryTransformer;

class ProcurementManagementTransformer extends TransformerAbstract
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
        'items',
        'end_user'
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(ProcurementManagement $table)
    {
        return [
            'id' => $table->id,
            'key' => $table->id,
            'uuid' => $table->uuid,
            'end_user_id' => $table->end_user_id,
            'calendar_year' => $table->calendar_year,
        ];
    }

    public function includeItems(ProcurementManagement $table)
    {
        if ($table->items) {
            return $this->collection($table->items, new ProcurementManagementItemTransformer);
        }
    }
    public function includeEndUser(ProcurementManagement $table)
    {
        if ($table->end_user) {
            return $this->item($table->end_user, new LibraryTransformer);
        }
    }
}
