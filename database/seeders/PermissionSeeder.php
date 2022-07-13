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
            'activitylogs.view',
            'form.routing.approved.view',
            'form.routing.disapproved.view',
            'form.routing.pending.view',
            'form.routing.pending.review.procurement.plan',
            'form.routing.pending.approve.procurement.plan',
            'form.routing.pending.review.purchase.request',
            'form.routing.pending.approve.purchase.request',
            'form.routing.pending.review.requisition.issue',
            'form.routing.pending.approve.requisition.issue',
            'form.routing.pending.issue.requisition.issue',
            'inventories.items.view',
            'inventories.items.create',
            'inventories.items.update',
            'inventories.items.quantity.update',
            'libraries.user.signatories.view',
            'libraries.user.signatories.add',
            'libraries.user.signatories.update',
            'libraries.user.signatories.delete',
            'libraries.uom.view',
            'libraries.uom.add',
            'libraries.uom.update',
            'libraries.uom.delete',
            'libraries.uacs.view',
            'libraries.uacs.add',
            'libraries.uacs.update',
            'libraries.uacs.delete',
            'procurement.view',
            'procurement.plan.view',
            'procurement.plan.create',
            'procurement.plan.update',
            'procurement.plan.delete',
            'procurement.plan.attachments',
            'purchase.requests.view',
            'purchase.requests.create',
            'purchase.requests.update',
            'purchase.requests.delete',
            'purchase.requests.attachments',
            'profile.information.update',
            'profile.twg.update',
            'profile.office.update',
            'requisition.issue.view',
            'requisition.issue.create',
            'requisition.issue.update',
            'requisition.issue.delete',
            'requisition.issue.attachments',
            'users.view',
            'users.update',
            'users.delete',
            'users.permissions',
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
