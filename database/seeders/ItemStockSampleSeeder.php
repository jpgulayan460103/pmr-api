<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemStockSampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = Item::all();
        foreach ($items as $item) {
            $faker = \Faker\Factory::create("en_PH");
            $quantity = $faker->numberBetween(0, 1000);
            $item->item_stock_histories()->create([
                'movement_quantity' => $quantity,
                'remaining_quantity' => $quantity,
                'movement_type' => 'in',
                'remarks' => 'Initial Inventory',
            ]);
        }
    }
}
