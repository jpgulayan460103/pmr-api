<?php

namespace Database\Seeders;

use App\Models\Library;
use Illuminate\Database\Seeder;

class ProcurementPlanTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $procurement_plan_types = [
            [
                'name' => ppmpValue(),
                'title' => 'PPMP',
            ],
            [
                'name' => supplementalPpmpValue(),
                'title' => '    ',
            ],
        ];

        foreach ($procurement_plan_types as $procurement_plan_type) {
            $lib = Library::create(['name' => $procurement_plan_type['name'], 'title' => $procurement_plan_type['title'], 'library_type' => 'procurement_plan_type']);
            echo $lib->library_type.": ".$lib->name."\n";
        }
    }
}
