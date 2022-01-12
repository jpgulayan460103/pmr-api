<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\UserInformation;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\HasCrud;

class UserRepository implements UserRepositoryInterface
{
    use HasCrud;
    public function __construct(User $user)
    {
        $this->model($user);
        $this->perPage(2);
    }

    public function register($data)
    {
        if($data['account_type'] == "ad_account"){
            $data['password'] = config('services.ad.default_password');
        }
        $user = $this->create($data);
        $user_information = $user->user_information()->create($data);
        $data['office_id'] = $data['section_id'];
        $data['signatory_type'] = "Personnel";
        $user_information = $user->signatories()->create($data);
        $user->user_information_id = $user_information->id;
        $user->save();
        return $user;
    }
}