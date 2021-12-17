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
        $this->attach(['user_information']);
    }

    public function register($data)
    {
        $user = $this->create($data);
        $user_information = $user->user_information()->create($data);
        $user->user_information_id = $user_information->id;
        $user->save();
        return $user;
    }
}