<?php

namespace Database\Seeders;

use App\Models\Library;
use Illuminate\Database\Seeder;

class ProcurementTypeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $procurement_type_categories = [
            "Capital Outlay",
            "Inventory Held for Consumption",
            "Inventory Held for Distribution",
            "Property Plant and Equipment",
            "Repair and Maintenance",
            "Semi-expandable",
            "Services",
        ];

        foreach ($procurement_type_categories as $procurement_type_categories) {
            $lib = Library::create(['name' => $procurement_type_categories, 'library_type' => 'procurement_type_category']);
            echo $lib->library_type.": ".$lib->name."\n";
        }
    }
}
