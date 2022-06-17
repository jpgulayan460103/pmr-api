<?php

namespace Database\Seeders;

use App\Models\Library;
use Illuminate\Database\Seeder;

class ItemSubClassificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $item_subclassifications = [
            [
                'name' => 'Equipment',
                'item_classification' => 'Equipments'
            ],
            [
                'name' => 'Equipment',
                'item_classification' => 'Equipments'
            ],
            [
                'name' => 'Property Plant and Equipment',
                'item_classification' => 'Equipments'
            ],
            [
                'name' => 'Semi-expandable',
                'item_classification' => 'Equipments'
            ],
            [
                'name' => 'Services',
                'item_classification' => 'Services'
            ],
            [
                'name' => 'Advocacy Supplies',
                'item_classification' => 'Supplies and Consumables'
            ],
            [
                'name' => 'Other Supplies and Consumables',
                'item_classification' => 'Supplies and Consumables'
            ],
            [
                'name' => 'Construction Supplies',
                'item_classification' => 'Supplies and Consumables'
            ],
            [
                'name' => 'Donations',
                'item_classification' => 'Supplies and Consumables'
            ],
            [
                'name' => 'Medical Supplies',
                'item_classification' => 'Supplies and Consumables'
            ],
            [
                'name' => 'Office Supplies',
                'item_classification' => 'Supplies and Consumables'
            ],
            [
                'name' => 'Other Supplies',
                'item_classification' => 'Supplies and Consumables'
            ],
            [
                'name' => 'Other Supplies - Food Items',
                'item_classification' => 'Supplies and Consumables'
            ],
            [
                'name' => 'Other Supplies - Janitorial Services',
                'item_classification' => 'Supplies and Consumables'
            ],
            [
                'name' => 'Other Supplies - Non Food Items',
                'item_classification' => 'Supplies and Consumables'
            ],
            [
                'name' => 'Other Supplies - Toiletries',
                'item_classification' => 'Supplies and Consumables'
            ],
            [
                'name' => 'Welfare Goods for Consumption',
                'item_classification' => 'Supplies and Consumables'
            ],
            [
                'name' => 'Welfare Goods for Distribution',
                'item_classification' => 'Supplies and Consumables'
            ],


        ];
    
        foreach ($item_subclassifications as $item_subclassification) {
            $item_classification = Library::where('name',$item_subclassification['item_classification'])->where('library_type', 'item_classification')->first();
            $lib = Library::create(
                [
                    'name' => $item_subclassification['name'],
                    'library_type' => 'item_subclassification',
                    'parent_id' => $item_classification->id,
                ]
            );
            echo $lib->library_type.": ".$lib->name."\n";
        }
    }
}
