<?php

namespace App\Transformers;

use App\Models\ProcurementPlan;
use League\Fractal\TransformerAbstract;

class ProcurementPlanTransformer extends TransformerAbstract
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
        'end_user',
        'items',

    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(ProcurementPlan $table)
    {
        return [
            'id' => $table->id,
            'key' => $table->id,
            'annex' => $table->annex,
            'status' => $table->status,
            'remarks' => $table->remarks,
            'total_price' => $table->total_price,
            'inflation' => $table->inflation,
            'contingency' => $table->contingency,
            'total_estimated_budget' => $table->total_estimated_budget,
            'is_supplemental' => $table->is_supplemental,
            'created_by_id' => $table->created_by_id,
            'end_user_id' => $table->end_user_id,
            'prepared_by_name' => $table->prepared_by_name,
            'prepared_by_position' => $table->prepared_by_position,
            'certified_by_name' => $table->certified_by_name,
            'certified_by_position' => $table->certified_by_position,
            'approved_by_name' => $table->approved_by_name,
            'approved_by_position' => $table->approved_by_position,
        ];
    }

    public function includeItems(ProcurementPlan $table)
    {
        if ($table->items) {
            return $this->collection($table->items, new ProcurementPlanItemTransformer);
        }
    }
    public function includeEndUser(ProcurementPlan $table)
    {
        if ($table->end_user) {
            return $this->item($table->end_user, new LibraryTransformer);
        }
    }
}
