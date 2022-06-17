<?php

namespace Database\Seeders;

use App\Models\ItemCategory;
use App\Models\Library;
use Illuminate\Database\Seeder;

class ItemCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => "Office Supplies - Semi-expendable",
                'parent_id' => "Equipments/Properties",
            ],
            [
                'name' => "Other Equipments",
                'parent_id' => "Equipments/Properties",
            ],
            [
                'name' => "Construction Supplies",
                'parent_id' => "Supplies/Goods",
            ],
            [
                'name' => "Donations",
                'parent_id' => "Supplies/Goods",
            ],
            [
                'name' => "Medical Supplies",
                'parent_id' => "Supplies/Goods",
            ],
            [
                'name' => "Office Supplies - Consumables",
                'parent_id' => "Supplies/Goods",
            ],
            [
                'name' => "Other Supplies - Food Items",
                'parent_id' => "Supplies/Goods",
            ],
            [
                'name' => "Other Supplies - Janitorial Supplies",
                'parent_id' => "Supplies/Goods",
            ],
            [
                'name' => "Other Supplies - Non Food Items",
                'parent_id' => "Supplies/Goods",
            ],
            [
                'name' => "Other Supplies - Toiletries",
                'parent_id' => "Supplies/Goods",
            ],
            [
                'name' => "Other Consumables",
                'parent_id' => "Supplies/Goods",
            ],
            [
                'name' => "Welfare Goods for Consumption",
                'parent_id' => "Supplies/Goods",
            ],
            [
                'name' => "Welfare Goods for Distribution",
                'parent_id' => "Supplies/Goods",
            ],
            [
                'name' => "Advocacy Supplies",
                'parent_id' => "Supplies/Goods",
            ],
            [
                'name' => "Board and Lodging",
                'parent_id' => "Services",
            ],
            [
                'name' => "Catering Services",
                'parent_id' => "Services",
            ],
            [
                'name' => "Food and Venue",
                'parent_id' => "Services",
            ],
            [
                'name' => "Janitorial Services",
                'parent_id' => "Services",
            ],
            [
                'name' => "Office Rent",
                'parent_id' => "Services",
            ],
            [
                'name' => "Others",
                'parent_id' => "Services",
            ],
            [
                'name' => "Petroleum Oil and Lubricant",
                'parent_id' => "Services",
            ],
            [
                'name' => "Printing and Publication",
                'parent_id' => "Services",
            ],
            [
                'name' => "Security",
                'parent_id' => "Services",
            ],
            [
                'name' => "Transportation",
                'parent_id' => "Services",
            ],

        ];

        foreach ($categories as $category) {
            $item_classification = Library::where('name',$category['parent_id'])->where('library_type', 'item_classification')->first();
            $lib = Library::create([
                'name' => $category['name'],
                'parent_id' => $item_classification->id,
                'library_type' => 'item_category'
            ]);
            echo $lib->library_type.": ".$lib->name."\n";
        }
    }
}
