<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Transformers\UserInformationTransformer;
use App\Transformers\UserOfficeTransformer;
use App\Transformers\PermissionTransformer;
use App\Transformers\RoleTransformer;
use App\Transformers\UserGroupTransformer;
use App\Models\User;

class UserTransformer extends TransformerAbstract
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
        'user_information',
        'user_offices',
        'permissions',
        'roles',
        'user_groups',
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
    public function includeUserOffices(User $table)
    {
        if ($table->user_offices) {
            return $this->collection($table->user_offices, new UserOfficeTransformer);
        }
    }
    public function includePermissions(User $table)
    {
        if ($table->permissions) {
            return $this->collection($table->permissions, new PermissionTransformer);
        }
    }
    public function includeRoles(User $table)
    {
        if ($table->roles) {
            return $this->collection($table->roles, new RoleTransformer);
        }
    }
    public function includeUserGroups(User $table)
    {
        if ($table->user_groups) {
            return $this->collection($table->user_groups, new UserGroupTransformer);
        }
    }
}
