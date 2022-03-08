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
            "Agency to Agency",
            "Direct Contracting",
            "Direct Retail Purchase of POL Products and Airline Tickets",
            "Domestic and Foreign Procurement",
            "Emergency Cases",
            "Highly Technical Consultant",
            "Lease of Real Property and Venues",
            "Limited Source Bidding",
            "Negotiated Procurement",
            "Public Bidding",
            "Repeat Order",
            "Scientific, Scholarly, or Artistic Work, Exclusive Technology and Media Services",
            "Shopping A",
            "Shopping B",
            "Small Value Procurement",
            "Two (2) Failed Bidding",
            
        ];

        foreach ($mode_of_procurements as $mode_of_procurement) {
            $lib = Library::create(['name' => $mode_of_procurement, 'library_type' => 'mode_of_procurement']);
            echo $lib->library_type.": ".$lib->name."\n";
        }
    }
}
