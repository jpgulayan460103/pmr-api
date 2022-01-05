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
            $lib = Library::create(['name' => $category, 'library_type' => 'user_area_of_assignment']);
            echo $lib->library_type.": ".$lib->name."\n";
        }
    }
}
