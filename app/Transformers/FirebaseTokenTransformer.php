<?php

namespace App\Transformers;

use App\Models\FirebaseToken;
use League\Fractal\TransformerAbstract;

class FirebaseTokenTransformer extends TransformerAbstract
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
        'user'
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(FirebaseToken $table)
    {
        return [
            'id' => $table->id,
            'key' => $table->id,
            'token' => $table->token,
            'user_id' => $table->user_id,
        ];
    }
}
