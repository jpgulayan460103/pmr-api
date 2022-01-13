<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\UserInformation;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\HasCrud;

class UserRepository implements UserRepositoryInterface
{
    use HasCrud;
    public function __construct(User $user = null)
    {
        if(!($user instanceof User)){
            $user = new User;
        }
        $this->model($user);
        $this->perPage(2);
    }

    public function register($data)
    {
        if($data['account_type'] == "ad_account"){
            $data['password'] = config('services.ad.default_password');
            $data['signatory_type'] = "Personnel";
        }
        $user = $this->create($data);
        $user_information = $user->user_information()->create($data);
        $user_sigatories = $user->signatories()->create($data);
        return $user;
    }
}