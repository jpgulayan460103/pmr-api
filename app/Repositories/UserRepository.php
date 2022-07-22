<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\UserOffice;
use App\Models\UserInformation;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\HasCrud;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use WhichBrowser\Parser;

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

    public function search($filters)
    {
        if(isset($filters['offices_ids'])){
            $this->modelQuery()->leftJoin('user_offices', 'users.id', '=', 'user_offices.user_id');
            $this->modelQuery()->whereIn('user_offices.office_id', $filters['offices_ids']);
            $this->modelQuery()->select('users.*');
        }
        $this->modelQuery()->orderBy('users.id','desc');
        $result = $this->modelQuery()->get();
        return $result;
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
                'profile.information.update',
                'purchase.request.view',
                'procurement.plan.view',
                'requisition.issue.view',
                'libraries.uom.view',
                'libraries.user.signatories.view',
            ]);
            $user->assignRole('user');

            $result = new Parser($_SERVER['HTTP_USER_AGENT']);
            (new ActivityLogBatchRepository())->startBatch();
            activity('user_login')
            ->causedBy($user)
            ->withProperties(
                [
                    "attributes" => [
                        'user_device' => $result->device->type,
                        'user_os' => $result->os->toString(),
                        'user_browser' => $result->browser->name . ' ' . $result->browser->version->toString(),
                        'user_ip' => $_SERVER['REMOTE_ADDR'],
                    ]
                ]
            )
            ->log('User login');
            (new ActivityLogBatchRepository())->endCustomBatch('user_login', $user);
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
            $user->user_offices()->forceDelete();
            $user_information_data = (new UserInformation($data))->getAttributes();
            $user_information = $user->user_information()->update($user_information_data);
            $offices = $this->addOffices($data['office_id']);
            $user_offices = $user->user_offices()->createMany($offices);
            $groups = $this->addGroups($data['group_id']);
            $user->user_groups()->forceDelete();
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

    public function getUsersByOfficeWithPermission($permission, $office_id)
    {
        $users = User::whereHas("permissions", function($q) use ($permission){
            $q->where("name", $permission);
        });
        $users->whereHas("user_offices", function($q) use ($office_id){
            $q->where("office_id", $office_id);
        });
        $users = $users->get();
        return $users;
    }

    public function getUsersByPermission($permission)
    {
        $users = User::whereHas("permissions", function($q) use ($permission){
            $q->where("name", $permission);
        });
        $users = $users->get();
        return $users;
    }

    public function getUsersByOffice($office_id)
    {
        $users = User::whereHas("user_offices", function($q) use ($office_id){
            $q->where("office_id", $office_id);
        });
        $users = $users->get();
        return $users;
    }

    
}