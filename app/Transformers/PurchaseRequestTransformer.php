<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Transformers\PurchaseRequestItemTransformer;

class PurchaseRequestTransformer extends TransformerAbstract
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
        'purchase_orders',
        'items',
        'bac_task',
        'end_user',
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform($table)
    {
        return [
            'purchase_request_uuid' => $table->purchase_request_uuid,
            'code_uacs' => $table->code_uacs,
            'purchase_request_number' => $table->purchase_request_number,
            'purpose' => $table->purpose,
            'fund_cluster' => $table->fund_cluster,
            'center_code' => $table->center_code,
            'total_cost' => $table->total_cost,
            'pr_dir' => $table->pr_dir,
            'end_user_id' => $table->end_user_id,
            'types' => $table->types,
            'mode_of_procurement' => $table->mode_of_procurement,
            'pr_date' => $table->pr_date,
            'bac_task_id' => $table->bac_task_id,
            'key' => $table->id,
        ];
    }

    public function includePurchaseOrder($table)
    {
        if ($table->purchase_order) {
            return $this->item($table->purchase_order, new LibraryTransformer);
        }
    }

    public function includeItems($table)
    {
        if ($table->items) {
            return $this->collection($table->items, new PurchaseRequestItemTransformer);
        }
    }

    public function includeBacTask($table)
    {
        if ($table->bac_task) {
            return $this->item($table->bac_task, new LibraryTransformer);
        }
    }

    public function includeEndUser($table)
    {
        if ($table->end_user) {
            return $this->item($table->end_user, new LibraryTransformer);
        }
    }
}
