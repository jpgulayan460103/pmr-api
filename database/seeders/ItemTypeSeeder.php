<?php

namespace Database\Seeders;

use App\Models\Library;
use Illuminate\Database\Seeder;

class ItemTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $item_types = [
            [
                'name' => ppmpCse(),
                'title' => 'CSE'
            ],
            [
                'name' => ppmpNonCse(),
                'title' => 'NON-CSE'
            ],
        ];

        foreach ($item_types as $item_type) {
            $lib = Library::create(['name' => $item_type['name'], 'title' => $item_type['title'], 'library_type' => 'item_type']);
            echo $lib->library_type.": ".$lib->name."\n";
        }
    }
}
