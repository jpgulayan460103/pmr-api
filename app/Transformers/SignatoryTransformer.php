<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Transformers\UserProtectedTransformer;

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
        'user'
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform($table)
    {
        return [
            'id' => $table->id,
            'key' => $table->id,
            'office_id' => $table->office_id,
            'user_id' => $table->user_id,
            'designation' => $table->designation,
            'title' => $table->title,
            'signatory_type' => $table->signatory_type,
        ];
    }

    public function includeUser($table)
    {
        if ($table->user) {
            return $this->item($table->user, new UserProtectedTransformer);
        }
    }
}
