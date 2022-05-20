<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\UserOffice;
use App\Models\UserInformation;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\HasCrud;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class UserRepository implements UserRepositoryInterface
{
    use HasCrud {
        create as mCreate;
        update as mUpdate;
        getAll as mGetAll;
    }
    public function __construct(User $user = null)
    {
        if(!($user instanceof User)){
            $user = new User;
        }
        $this->model($user);
        $this->perPage(2);
    }

    public function create($data)
    {
        try {
            DB::beginTransaction();
            if($data['account_type'] == "ad_account"){
                $data['password'] = config('services.ad.default_password');
            }
            $user = $this->mCreate($data);
            $user_information = $user->user_information()->create($data);
            $user_sigatories = $user->user_offices()->create($data);
            $user->givePermissionTo([
                'purchase.requests.create',
                'purchase.requests.view',
                'libraries.items.categories.view',
                'libraries.items.view',
                'libraries.office.divisions.view',
                'libraries.office.sections.view',
                'libraries.signatories.administrators.view',
                'libraries.uom.view',
                'libraries.uacs.view',
            ]);
            $user->assignRole('user');
            DB::commit();
            return $user;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update($data, $id)
    {
        try {
            DB::beginTransaction();
            if(isset($data['account_type']) && $data['account_type'] == "ad_account"){
                $data['password'] = config('services.ad.default_password');
            }
            $user = $this->mUpdate($id, $data);
            $user->user_offices()->delete();
            $user_information_data = (new UserInformation($data))->getAttributes();
            $user_information = $user->user_information()->update($user_information_data);
            $offices = $this->addOffices($data['office_id']);
            $user_offices = $user->user_offices()->createMany($offices);
            $groups = $this->addGroups($data['group_id']);
            $user->user_groups()->delete();
            $user_groups = $user->user_groups()->createMany($groups);
            DB::commit();
            return $user;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function addOffices($office_ids)
    {
        return collect($office_ids)->map(function ($item, $key) {
            $new_item = [
                'office_id' => $item
            ];
            return $new_item;
        })->toArray();
    }
    public function addGroups($group_ids)
    {
        return collect($group_ids)->map(function ($item, $key) {
            $new_item = [
                'group_id' => $item
            ];
            return $new_item;
        })->toArray();
    }

    public function getAll()
    {
        return $this->modelQuery()->orderBy('id', 'desc')->where('username',"<>","admin")->get();
    }

    public function getOffices()
    {
        return UserOffice::with('user.user_information','office')->get();
    }

    
}