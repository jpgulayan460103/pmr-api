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
            [
                'name' => 'Office of the Regional Director',
                'title' => 'ORD',
                'division' => '',  
            ],
            [
                'name' => 'Office of the Assistant Regional Director for Operation',
                'title' => 'OARDO',
                'division' => 'Office of the Regional Director',  
            ],
            [
                'name' => 'Office of the Assistant Regional Director for Administration',
                'title' => 'OARDA',
                'division' => 'Office of the Regional Director',  
            ],
            [
                'name' => 'Promotive Services Division',
                'title' => 'PSD',
                'division' => 'Office of the Assistant Regional Director for Operation',  
            ],
            [
                'name' => 'Disaster Response Management Division',
                'title' => 'DRMD',
                'division' => 'Office of the Assistant Regional Director for Operation',  
            ],
            [
                'name' => 'Protective Services Division',
                'title' => 'PSD',
                'division' => 'Office of the Assistant Regional Director for Operation',  
            ],
            [
                'name' => 'Provincial Social Welfare and Development Office',
                'title' => 'PSWDO',
                'division' => 'Office of the Assistant Regional Director for Operation',  
            ],
            [
                'name' => 'Pantawid Pamilyang Pilipino Program Management',
                'title' => 'PPPPM',
                'division' => 'Office of the Assistant Regional Director for Operation',  
            ],
            [
                'name' => 'Policy and Plans Division',
                'title' => 'PPD',
                'division' => 'Office of the Regional Director',  
            ],
            [
                'name' => 'Administrative Division',
                'title' => 'AD',
                'division' => 'Office of the Assistant Regional Director for Administration',  
            ],
            [
                'name' => 'Human Resource Management and Development Division',
                'title' => 'HRMDD',
                'division' => 'Office of the Assistant Regional Director for Administration',  
            ],
            [
                'name' => 'Financial Management Division',
                'title' => 'FMD',
                'division' => 'Office of the Assistant Regional Director for Administration',  
            ],
            [
                'name' => 'Resource Management',
                'title' => 'RM',
                'division' => 'Office of the Regional Director',  
            ],
            [
                'name' => 'Regional Juvenile Justice Welfare Council',
                'title' => 'RJJWC',
                'division' => 'Office of the Regional Director',  
            ],
        ];

        foreach ($categories as $category) {
            $parent_lib = Library::where('type','user_division')->where('name', $category['division'])->first();
            $parent_id = null;
            if($parent_lib){
                $parent_id = $parent_lib->id;
            }
            $lib = Library::create(['name' => $category['name'], 'title' => $category['title'], 'type' => 'user_division', 'parent_id' => $parent_id]);
            echo $lib->type.": ".$lib->name."\n";
            // echo $lib->type.": ".$lib->name."\n";
        }
    }
}
