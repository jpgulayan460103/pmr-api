<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Transformers\LibraryTransformer;
use App\Models\UserOffice;

class UserOfficeTransformer extends TransformerAbstract
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
        'office',
        'position'
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(UserOffice $table)
    {
        return [
            'id' => $table->id,
            'key' => $table->id,
            'office_id' => $table->office_id,
            'user_id' => $table->user_id,
            'designation' => $table->designation,
            'position_id' => $table->position_id,
        ];
    }

    public function includeOffice(UserOffice $table)
    {
        if ($table->office) {
            return $this->item($table->office, new LibraryTransformer);
        }
    }
    public function includePosition(UserOffice $table)
    {
        if ($table->position) {
            return $this->item($table->position, new LibraryTransformer);
        }
    }
}
