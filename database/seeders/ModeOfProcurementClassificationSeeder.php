<?php

namespace Database\Seeders;

use App\Models\Library;
use Illuminate\Database\Seeder;

class ModeOfProcurementClassificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mode_of_procurement_classifications = [
            "Alternative Methods of Procurement",
            "Negotiated Procurement",
            "Public Bidding",
        ];

        foreach ($mode_of_procurement_classifications as $mode_of_procurement_classification) {
            $lib = Library::create(['name' => $mode_of_procurement_classification, 'library_type' => 'mode_of_procurement_classification']);
            echo $lib->library_type.": ".$lib->name."\n";
        }
    }
}
