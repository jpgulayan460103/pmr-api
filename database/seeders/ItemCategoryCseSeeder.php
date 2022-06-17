<?php

namespace Database\Seeders;

use App\Models\Library;
use Illuminate\Database\Seeder;

class ItemCategoryCseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $item_category_cses = [
            "Arts and Crafts Equipment and Accessories and Supplies",
            "Audio and Visual Equipment and Supplies",
            "Batteries and Cells and Accessories",
            "Cleaning Equipment and Supplies",
            "Color Compounds and Dispersions",
            "Consumer Electronics",
            "Films",
            "Fire Fighting Equipment",
            "Flag or Accessories",
            "Furniture and Furnishings",
            "Heating and Ventilation and Air Circulation",
            "Information and Communication Technology (ICT) Equipment and Devices and Accessories",
            "Lighting and Fixtures and Accessories",
            "Manufacturing Components and Supplies",
            "Measuring and Observing and Testing Equipment",
            "Office Equipment and Accessories and Supplies",
            "Others",
            "Paper Materials and Products",
            "Pesticides or Pest Repellents",
            "Printed Publications",
            "Printer or Facsimile or Photocopier Supplies",
            "Purfumes or Colognes or Fragrances",
            "Software",
            "Solvents",
        ];

        foreach ($item_category_cses as $item_category_cse) {
            $lib = Library::create([
                'name' => $item_category_cse,
                'library_type' => 'item_category_cse'
            ]);
            echo $lib->library_type.": ".$lib->name."\n";
        }
    }
}
