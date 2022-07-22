<?php

namespace App\Repositories;

use App\Repositories\Interfaces\FirebaseTokenRepositoryInterface;
use App\Models\FirebaseToken;
use App\Repositories\HasCrud;

class FirebaseTokenRepository implements FirebaseTokenRepositoryInterface
{
    use HasCrud;

    public function __construct(FirebaseToken $firebaseToken = null)
    {
        if(!($firebaseToken instanceof FirebaseToken)){
            $firebaseToken = new FirebaseToken;
        }
        $this->model($firebaseToken);
        $this->perPage(2);
    }

    public function deleteUserTokens($user_id)
    {
        FirebaseToken::where('user_id', $user_id)->delete();
    }

    public function getTokensByUserIds($user_ids)
    {
        return FirebaseToken::whereIn('user_id', $user_ids)->pluck('token');
    }
    
}