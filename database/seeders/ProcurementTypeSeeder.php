<?php

namespace Database\Seeders;

use App\Models\Library;
use Illuminate\Database\Seeder;

class ProcurementTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $procurement_types = [
            'Inventory Held for Distribution (Welfare Goods,Food Supplies, Drugs and Medicines, etc. )',
            'Inventory Held for Consumption (Office Supply, Toner, Other Supplies and Materials, etc.)',
            'Property Plant and Equipment (Infrastructure)',
            'Property Plant and Equipment (Building)',
            'Property Plant and Equipment (Land)',
            'Property Plant and Equipment (Machinery and Equipment, Others)',
            'Semi-expandable (Machinery and Equipment)',
            'Services - Catering',
            'Services - Transportation',
            'Services - Consultancy',
        ];

        foreach ($procurement_types as $procurement_type) {
            $lib = Library::create(['name' => $procurement_type, 'library_type' => 'procurement_type']);
            echo $lib->library_type.": ".$lib->name."\n";
        }
    }
}
