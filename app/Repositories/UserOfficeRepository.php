<?php

namespace App\Repositories;

use App\Models\UserOffice;
use App\Repositories\Interfaces\UserOfficeRepositoryInterface;
use App\Repositories\HasCrud;

class UserOfficeRepository implements UserOfficeRepositoryInterface
{
    use HasCrud;
    public function __construct(UserOffice $user_office = null)
    {
        if(!($user_office instanceof UserOffice)){
            $user_office = new UserOffice;
        }
        $this->model($user_office);
        $this->perPage(200);
    }
    
}