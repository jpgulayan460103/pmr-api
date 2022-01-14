<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Transformers\UserInformationTransformer;
use App\Transformers\SignatoryTransformer;
use App\Transformers\PermissionTransformer;
use App\Models\User;

class UserTransformer extends TransformerAbstract
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
        'user_information',
        'signatories',
        'permissions',
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $table)
    {
        return [
            'username' => $table->username,
            'account_type' => $table->account_type,
            'is_active' => $table->is_active,
            'user_information_id' => $table->user_information_id,
            'key' => $table->id,
        ];
    }

    public function includeUserInformation(User $table)
    {
        if ($table->user_information) {
            return $this->item($table->user_information, new UserInformationTransformer);
        }
    }
    public function includeSignatories(User $table)
    {
        if ($table->signatories) {
            return $this->collection($table->signatories, new SignatoryTransformer);
        }
    }
    public function includePermissions(User $table)
    {
        if ($table->permissions) {
            return $this->collection($table->permissions, new PermissionTransformer);
        }
    }
}
