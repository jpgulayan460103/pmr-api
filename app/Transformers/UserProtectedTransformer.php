<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Transformers\UserInformationTransformer;
use App\Models\User;


class UserProtectedTransformer extends TransformerAbstract
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
        'user_information'
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $table)
    {
        return [
            // 'account_type' => $table->account_type,
            // 'is_active' => $table->is_active,
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
}
