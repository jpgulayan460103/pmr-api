<?php

namespace App\Transformers;

use App\Models\UserGroup;
use League\Fractal\TransformerAbstract;
use App\Transformers\UserTransformer;
use App\Transformers\LibraryTransformer;

class UserGroupTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'user',
        'group'
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(UserGroup $userGroup)
    {
        return [
            'id' => $userGroup->id,
            'key' => $userGroup->id,
            'user_id' => $userGroup->user_id,
            'group_id' => $userGroup->group_id,
        ];
    }

    public function includeUser(UserGroup $userGroup)
    {
        if ($userGroup->user) {
            return $this->item($userGroup->user, new UserTransformer);
        }
    }

    public function includeGroup(UserGroup $userGroup)
    {
        if ($userGroup->group) {
            return $this->item($userGroup->group, new LibraryTransformer);
        }
    }
}
