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
        $categories = [
            "AVAILABLE AT PROCUREMENT SERVICE STORES",
            "OTHER ITEMS NOT AVALABLE AT PS BUT REGULARLY PURCHASED FROM OTHER SOURCES",
        ];

        foreach ($categories as $category) {
            $lib = Library::create(['name' => $category, 'library_type' => 'item_type']);
            echo $lib->library_type.": ".$lib->name."\n";
        }
    }
}
