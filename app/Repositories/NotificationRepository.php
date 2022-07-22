<?php

namespace App\Repositories;

use App\Models\Notification;
use App\Repositories\Interfaces\NotificationRepositoryInterface;
use App\Repositories\HasCrud;

class NotificationRepository implements NotificationRepositoryInterface
{
    use HasCrud;

    public function __construct(Notification $Notification = null)
    {
        if(!($Notification instanceof Notification)){
            $Notification = new Notification;
        }
        $this->model($Notification);
        $this->perPage(2);
    }

    public function createNotifications($user_ids, $message)
    {
        foreach ($user_ids as $id) {
            $this->create([
                'user_id' => $id,
                'message' => json_encode($message),
            ]);
        }
    }

    public function getByUserId($user_id)
    {
        return $this->modelQuery()->where('user_id', $user_id)->orderBy('id', 'desc')->limit(20)->get();
    }
    
    public function clearNotifications($user_id)
    {
        return $this->modelQuery()->where('user_id', $user_id)->delete();
    }

    
}