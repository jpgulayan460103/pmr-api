<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'users-all',
            'users-view',
            'users-add',
            'users-update',
            'users-delete',
            'purchase-requests-all',
            'purchase-requests-approve',
            'purchase-requests-view',
            'purchase-requests-add',
            'purchase-requests-update',
            'purchase-requests-delete',
        ];
        foreach ($permissions as $permission) {
            $permission = Permission::create([
                'name' => $permission
            ]);
            echo "Inserted permission -> ".$permission->name."\n";
        }
    }
}
