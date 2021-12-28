<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class LibraryTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        'parent'
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
    public function transform($table)
    {
        return [
            'id' => $table->id,
            'value' => $table->name,
            'title' => $table->title,
            'name' => $table->name,
            'type' => $table->type,
        ];
    }

    public function includeParent($table)
    {
        if ($table->parent) {
            return $this->item($table->parent, new LibraryTransformer);
        }
    }
}
