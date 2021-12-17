<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Library;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            "Office of the Regional Director",
            "Office of the Assistant Regional Director for Operation",
            "Office of the Assistant Regional Director for Administration",
            "Promotive Services Division",
            "Disaster Response Management Division",
            "Protective Services Division",
            "Provincial Social Welfare and Development Office",
            "Pantawid Pamilyang Pilipino Program Management",
            "Policy and Plans Division",
            "Administrative Division",
            "Human Resource Management and Development Division",
            "Financial Management Division",
            "Resource Management",
            "Regional Juvenile Justice Welfare Council",
        ];

        foreach ($categories as $category) {
            $lib = Library::create(['name' => $category, 'type' => 'user_division']);
            echo $lib->type.": ".$lib->name."\n";
        }
    }
}
