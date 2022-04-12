<?php

namespace Database\Seeders;

use App\Models\Library;
use Illuminate\Database\Seeder;

class TechnicalWorkingGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $twgs = [
            'Information Technology',
            'Goods and Services',
            'Vehicle Parts and Maintenance',
            'Engineering',
        ];

        foreach ($twgs as $technical_working_group) {
            $lib = Library::create(['library_type' => 'technical_working_group', 'name' => $technical_working_group]);
            echo $lib->library_type.": ".$lib->name."\n";
        }
    }
}
