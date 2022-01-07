<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Transformers\UserInformationTransformer;


class UserProtectedTransformer extends TransformerAbstract
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
        'user_information'
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform($table)
    {
        return [
            // 'account_type' => $table->account_type,
            // 'is_active' => $table->is_active,
            'user_information_id' => $table->user_information_id,
            'key' => $table->id,
        ];
    }

    public function includeUserInformation($table)
    {
        if ($table->user_information) {
            return $this->item($table->user_information, new UserInformationTransformer);
        }
    }
}
