<?php

namespace Database\Seeders;

use App\Models\Library;
use Illuminate\Database\Seeder;

class EmploymentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            "PERMANENT",
            "CONTRACTUAL",
            "CASUAL",
            "COTERMINOUS",
            "CONTRACT OF SERVICE",    
        ];

        foreach ($categories as $category) {
            $lib = Library::create(['name' => $category, 'type' => 'user_area_of_assignment']);
            echo $lib->type.": ".$lib->name."\n";
        }
    }
}
