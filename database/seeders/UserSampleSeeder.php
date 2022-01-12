<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use App\Models\Signatory;

class UserSampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'account_type' => 'app_account',
            'username' => 'jpgulayan',
            'password' => 'admin123',
        ]);

        // $user->givePermissionTo(['edit articles', 'delete articles']);

        $user = User::create([
            'account_type' => 'app_account',
            'username' => 'ppd',
            'password' => 'admin123',
        ]);

        // $data = [
        //     'firstname'
        //     'middlename'
        //     'lastname'
        //     'user_dn'
        // ];
        // $user->user_information()->save($data);
    }
}
