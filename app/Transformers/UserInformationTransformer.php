<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Transformers\LibraryTransformer;
use App\Models\UserInformation;

class UserInformationTransformer extends TransformerAbstract
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
        'section',
        'position',
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(UserInformation $table)
    {
        return [
            'user_id' => $table->user_id,
            'fullname' => "$table->firstname $table->middlename $table->lastname",
            'firstname' => $table->firstname,
            'middlename' => $table->middlename,
            'lastname' => $table->lastname,
            'user_dn' => $table->user_dn,
            'user_office_id' => $table->user_office_id,
            'cellphone_number' => $table->cellphone_number,
            'email_address' => $table->email_address,
            'section_id' => $table->section_id,
            'position_id' => $table->position_id,
            'key' => $table->id,
        ];
    }

    public function includeSection(UserInformation $table)
    {
        if ($table->section) {
            return $this->item($table->section, new LibraryTransformer);
        }
    }
    public function includePosition(UserInformation $table)
    {
        if ($table->position) {
            return $this->item($table->position, new LibraryTransformer);
        }
    }
}
