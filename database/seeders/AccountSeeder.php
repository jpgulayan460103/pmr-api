<?php

namespace Database\Seeders;

use App\Models\Library;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accounts = [
            [
                'name' => 'Furnitures and Fixtures',
                'category' => 'Capital Outlay'
            ],
            [
                'name' => 'IT Equipment',
                'category' => 'Capital Outlay'
            ],
            [
                'name' => 'Machinery and Equipment',
                'category' => 'Capital Outlay'
            ],
            [
                'name' => 'Office Equipment',
                'category' => 'Capital Outlay'
            ],
            [
                'name' => 'Cellcards/Mobile',
                'category' => 'Inventory Held for Consumption'
            ],
            [
                'name' => 'Office Supplies',
                'category' => 'Inventory Held for Consumption'
            ],
            [
                'name' => 'Other Supplies and Materials',
                'category' => 'Inventory Held for Consumption'
            ],
            [
                'name' => 'Toner',
                'category' => 'Inventory Held for Consumption'
            ],
            [
                'name' => 'Welfare Goods, Food Supplies, Drugs and Medicines, etc.',
                'category' => 'Inventory Held for Distribution'
            ],
            [
                'name' => 'Building',
                'category' => 'Property Plant and Equipment'
            ],
            [
                'name' => 'Infrastructure',
                'category' => 'Property Plant and Equipment'
            ],
            [
                'name' => 'Land',
                'category' => 'Property Plant and Equipment'
            ],
            [
                'name' => 'Machinery and Equipment, Others',
                'category' => 'Property Plant and Equipment'
            ],
            [
                'name' => 'Elevator',
                'category' => 'Repair and Maintenance'
            ],
            [
                'name' => 'IT Equipment',
                'category' => 'Repair and Maintenance'
            ],
            [
                'name' => 'Motor Vehicle',
                'category' => 'Repair and Maintenance'
            ],
            [
                'name' => 'Office Equipment',
                'category' => 'Repair and Maintenance'
            ],
            [
                'name' => 'Furnitures and Fixtures',
                'category' => 'Semi-expandable'
            ],
            [
                'name' => 'IT Equipment',
                'category' => 'Semi-expandable'
            ],
            [
                'name' => 'Machinery and Equipment',
                'category' => 'Semi-expandable'
            ],
            [
                'name' => 'Office Equipment',
                'category' => 'Semi-expandable'
            ],
            [
                'name' => 'Board and Lodging',
                'category' => 'Services'
            ],
            [
                'name' => 'Catering Services',
                'category' => 'Services'
            ],
            [
                'name' => 'Food and Venue',
                'category' => 'Services'
            ],
            [
                'name' => 'Janitorial',
                'category' => 'Services'
            ],
            [
                'name' => 'Office Rent',
                'category' => 'Services'
            ],
            [
                'name' => 'Others',
                'category' => 'Services'
            ],
            [
                'name' => 'Petroleum Oil and Lubricant',
                'category' => 'Services'
            ],
            [
                'name' => 'Printing and Publication',
                'category' => 'Services'
            ],
            [
                'name' => 'Security',
                'category' => 'Services'
            ],
            [
                'name' => 'Transportation',
                'category' => 'Services'
            ],

        ];

        foreach ($accounts as $account) {
            $category = Library::where('name', $account['category'])->where('library_type','account_classification')->first();
            $lib = Library::create(['name' => $account['name'], 'library_type' => 'account', 'parent_id' => $category->id]);
            echo $lib->library_type.": ".$lib->name."\n";
        }
    }
}
