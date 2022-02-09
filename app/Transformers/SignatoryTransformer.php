<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Transformers\LibraryTransformer;
use App\Models\Signatory;

class SignatoryTransformer extends TransformerAbstract
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
        'office'
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Signatory $table)
    {
        return [
            'id' => $table->id,
            'key' => $table->id,
            'office_id' => $table->office_id,
            'user_id' => $table->user_id,
            'designation' => $table->designation,
            'title' => $table->title,
            'signatory_type' => $table->signatory_type,
            'signatory_name' => $table->signatory_name,
            'position' => $table->position,
        ];
    }

    public function includeOffice(Signatory $table)
    {
        if ($table->office) {
            return $this->item($table->office, new LibraryTransformer);
        }
    }
}
