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
            "Other Software",
            "Others",
            "Paper Materials and Products",
            "Pesticides or Pest Repellents",
            "Printed Publications",
            "Printer or Facsimile or Photocopier Supplies",
            "Purfumes or Colognes or Fragrances",
            "Software",
            "Solvents",
            
        ];

        foreach ($categories as $category) {
            $lib = Library::create(['name' => $category, 'type' => 'item_category']);
            echo $lib->type.": ".$lib->name."\n";
        }
    }
}
