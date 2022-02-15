<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Transformers\UserOfficeTransformer;
use App\Models\Library;
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
        'user_office'
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Library $table)
    {
        return [
            'id' => $table->id,
            'value' => $table->name,
            'title' => $table->title,
            'name' => $table->name,
            'text' => $table->name,
            'library_type' => $table->library_type,
            'key' => $table->id,
        ];
    }

    public function includeParent(Library $table)
    {
        if ($table->parent) {
            return $this->item($table->parent, new LibraryTransformer);
        }
    }

    public function includeUserOffice(Library $table)
    {
        if ($table->user_office) {
            return $this->item($table->user_office, new UserOfficeTransformer);
        }
    }
}
