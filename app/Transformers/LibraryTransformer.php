<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Transformers\SignatoryTransformer;
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
        'signatory'
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
            'library_type' => $table->library_type,
            'key' => $table->id,
        ];
    }

    public function includeParent($table)
    {
        if ($table->parent) {
            return $this->item($table->parent, new LibraryTransformer);
        }
    }

    public function includeSignatory($table)
    {
        if ($table->signatory) {
            return $this->item($table->signatory, new SignatoryTransformer);
        }
    }
}
