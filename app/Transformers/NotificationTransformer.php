<?php

namespace App\Transformers;

use App\Models\Notification;
use League\Fractal\TransformerAbstract;

class NotificationTransformer extends TransformerAbstract
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
        //
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Notification $table)
    {
        return [
            'id' => $table->id,
            'key' => $table->id,
            'user_id' => $table->user_id,
            'message' => json_decode($table->message, true),
            'status' => $table->status,
        ];
    }
}
