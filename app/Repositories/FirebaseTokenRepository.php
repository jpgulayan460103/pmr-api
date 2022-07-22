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

    public function filterUserByOffice($office_id)
    {
        return FirebaseToken::leftJoin('user_offices', 'firebase_tokens.user_id', '=', 'user_offices.user_id')->where('user_offices.office_id', $office_id)->pluck('token');
    }

    public function filterUserByPermission($office_id)
    {
        $query = FirebaseToken::query();
        $query->leftJoin('user_offices', 'firebase_tokens.user_id', '=', 'user_offices.user_id');
        $query->leftJoin('user_offices', 'firebase_tokens.user_id', '=', 'user_offices.user_id');
        $query->where('user_offices.office_id', $office_id);
        return $query->pluck('token');
    }
    
}