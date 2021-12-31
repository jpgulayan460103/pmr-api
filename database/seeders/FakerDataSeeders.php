<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserInformation;
use App\Models\Item;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderDelivery;
use App\Models\PurchaseRequest;

class FakerDataSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'type' => 'app_account',
            'username' => 'jpgulayan',
            'password' => 'admin123',
        ]);
        // User::factory(10)->has(UserInformation::factory()->count(1))->create();
        // PurchaseRequest::factory(10)->has(PurchaseOrder::factory()->count(3)->has(PurchaseOrderDelivery::factory()->count(4), 'purchase_order_delieveries'),'purchase_orders')->create();
        // Item::factory(10)->create();
    }
}
