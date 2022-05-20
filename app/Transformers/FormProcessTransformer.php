<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\FormProcess;

class FormProcessTransformer extends TransformerAbstract
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
        //
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(FormProcess $table)
    {
        return [
            'id' => $table->id,
            'key' => $table->id,
            'process_description' => $table->process_description,
            'form_routes' => is_array($table->form_routes) ? $table->form_routes : json_decode(json_decode($table->form_routes, true), true),
            'form_type' => $table->form_type,
            'office_id' => $table->office_id,
            'form_processable_id' => $table->form_processable_id,
            'form_processable_type' => $table->form_processable_type,
            'is_complete' => $table->is_complete,
            'completed_date' => $table->completed_date,
        ];
    }
}
