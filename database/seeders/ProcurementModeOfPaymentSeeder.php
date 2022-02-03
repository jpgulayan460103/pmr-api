<?php

namespace Database\Seeders;

use App\Models\Library;
use Illuminate\Database\Seeder;

class ProcurementModeOfPaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mode_of_procurements = [
            'Public Bidding',
            'Domestic and Foreign Procurement',
            'Limited Source Bidding',
            'Direct Contracting',
            'Repeat Order',
            'Shopping',
            'Negotiated Procurement',
        ];

        foreach ($mode_of_procurements as $mode_of_procurement) {
            $lib = Library::create(['name' => $mode_of_procurement, 'library_type' => 'mode_of_procurement']);
            echo $lib->library_type.": ".$lib->name."\n";
        }
    }
}
