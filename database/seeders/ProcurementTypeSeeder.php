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
            "Consultancy",
            "Goods",
            "Infrastructure",
            "Services",         
        ];

        foreach ($procurement_types as $procurement_types) {
            $lib = Library::create(['name' => $procurement_types, 'library_type' => 'procurement_type']);
            echo $lib->library_type.": ".$lib->name."\n";
        }
    }
}
