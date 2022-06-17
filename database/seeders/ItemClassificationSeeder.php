<?php

namespace Database\Seeders;

use App\Models\Library;
use Illuminate\Database\Seeder;

class ItemClassificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $item_classifications = [
            [
                'name' => 'Equipments/Properties',
            ],
            [
                'name' => 'Supplies/Goods',
            ],
            [
                'name' => 'Services',
            ],
        ];

        foreach ($item_classifications as $item_classification) {
            $lib = Library::create(['name' => $item_classification['name'], 'library_type' => 'item_classification']);
            echo $lib->library_type.": ".$lib->name."\n";
        }
    }
}
