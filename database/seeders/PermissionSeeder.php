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
            'activitylogs.all',
            'activitylogs.view',
            'form.routing.approved.all',
            'form.routing.approved.update',
            'form.routing.approved.view',
            'form.routing.disapproved.all',
            'form.routing.disapproved.view',
            'form.routing.pending.all',
            'form.routing.pending.approve',
            'form.routing.pending.attachment.create',
            'form.routing.pending.attachment.delete',
            'form.routing.pending.attachment.view',
            'form.routing.pending.disapprove',
            'form.routing.pending.view',
            'libraries.all',
            'libraries.items.categories.view',
            'libraries.items.categories.add',
            'libraries.items.categories.update',
            'libraries.items.categories.delete',
            'libraries.items.view',
            'libraries.items.add',
            'libraries.items.update',
            'libraries.items.delete',
            'libraries.office.divisions.view',
            'libraries.office.divisions.add',
            'libraries.office.divisions.update',
            'libraries.office.divisions.delete',
            'libraries.office.sections.view',
            'libraries.office.sections.add',
            'libraries.office.sections.update',
            'libraries.office.sections.delete',
            'libraries.signatories.administrators.view',
            'libraries.signatories.administrators.add',
            'libraries.signatories.administrators.update',
            'libraries.signatories.administrators.delete',
            'libraries.uom.view',
            'libraries.uom.add',
            'libraries.uom.update',
            'libraries.uom.delete',
            'libraries.uacs.view',
            'libraries.uacs.add',
            'libraries.uacs.update',
            'libraries.uacs.delete',
            'procurement.all',
            'procurement.attachment.create',
            'procurement.attachment.delete',
            'procurement.attachment.view',
            'procurement.view',
            'purchase.requests.all',
            'purchase.requests.attachments.create',
            'purchase.requests.attachments.delete',
            'purchase.requests.attachments.view',
            'purchase.requests.create',
            'purchase.requests.delete',
            'purchase.requests.update',
            'purchase.requests.view',
            'purchase.requests.cancellation',
            'users.all',
            'users.delete',
            'users.permission.update',
            'users.permission.view',
            'users.update',
            'users.view',
        ];
        foreach ($permissions as $permission) {
            $permission = Permission::create([
                'name' => $permission,
                'guard_name' => 'api'
            ]);
            echo "Inserted permission -> ".$permission->name."\n";
        }
    }
}
