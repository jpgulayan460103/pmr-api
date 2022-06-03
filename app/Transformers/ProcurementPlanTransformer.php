<?php

namespace App\Transformers;

use App\Models\ProcurementPlan;
use League\Fractal\TransformerAbstract;
use App\Transformers\FormProcessTransformer;
use App\Transformers\FormRouteTransformer;
use App\Transformers\FormUploadTransformer;

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
        'form_process',
        'form_routes',
        'form_uploads'
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(ProcurementPlan $table)
    {
        $uuid_last = explode("-",$table->uuid);
        return [
            'id' => $table->id,
            'key' => $table->id,
            'uuid_last' => end($uuid_last),
            'title' => $table->title,
            'display_log' => $table->ppmp_number ? $table->ppmp_number : $table->title,
            'purpose' => $table->purpose,
            'procurement_plan_type' => $table->procurement_plan_type,
            'item_type_id' => $table->item_type_id,
            'ppmp_date' => $table->ppmp_date,
            'calendar_year' => $table->calendar_year,
            'ppmp_number' => $table->ppmp_number,
            'status' => $table->status,
            'remarks' => $table->remarks,
            'total_price' => $table->total_price,
            'inflation' => $table->inflation,
            'contingency' => $table->contingency,
            'total_estimated_budget' => $table->total_estimated_budget,
            'common_amount' => $table->total_estimated_budget,
            'common_amount_formatted' => number_format($table->total_estimated_budget, 2),
            'is_supplemental' => $table->is_supplemental,
            'created_by_id' => $table->created_by_id,
            'end_user_id' => $table->end_user_id,
            'prepared_by_name' => $table->prepared_by_name,
            'prepared_by_position' => $table->prepared_by_position,
            'certified_by_name' => $table->certified_by_name,
            'certified_by_position' => $table->certified_by_position,
            'approved_by_name' => $table->approved_by_name,
            'approved_by_position' => $table->approved_by_position,
            'file' => route('api.procurement-plans.pdf', ['id' => $table->uuid]),
        ];
    }

    public function includeFormProcess($table)
    {
        if ($table->form_process) {
            return $this->item($table->form_process, new FormProcessTransformer);
        }
    }
    public function includeFormRoutes($table)
    {
        if ($table->form_routes) {
            return $this->collection($table->form_routes, new FormRouteTransformer);
        }
    }
    public function includeFormUploads($table)
    {
        if ($table->form_uploads) {
            return $this->collection($table->form_uploads, new FormUploadTransformer);
        }
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
