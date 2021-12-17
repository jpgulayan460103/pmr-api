<?php

namespace Database\Seeders;

use App\Models\Library;
use Illuminate\Database\Seeder;

class AreaOfAssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            "RPMO",
            "Regional Office",
            "Davao City",
            "Davao De Oro",
            "Davao Oriental",
            "Davao Del Norte",
            "Davao Del Sur",
            "Davao Occidental",
        ];

        foreach ($categories as $category) {
            $lib = Library::create(['name' => $category, 'type' => 'user_area_of_assignment']);
            echo $lib->type.": ".$lib->name."\n";
        }
    }
}
