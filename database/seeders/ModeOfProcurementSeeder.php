<?php

namespace Database\Seeders;

use App\Models\Library;
use Illuminate\Database\Seeder;

class ModeOfProcurementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mode_of_procurements = [
            [
                "name" => "Agency to Agency",
                "parent" => "Negotiated Procurement",
                "title" => "53.5"

            ],
            [
                "name" => "Direct Contracting",
                "parent" => "Alternative Methods of Procurement",
                "title" => "50"

            ],
            [
                "name" => "Direct Retail Purchase of POL Products and Airline Tickets",
                "parent" => "Negotiated Procurement",
                "title" => "53.14"

            ],
            [
                "name" => "Emergency Cases",
                "parent" => "Negotiated Procurement",
                "title" => "53.2"

            ],
            [
                "name" => "Highly Technical Consultant",
                "parent" => "Negotiated Procurement",
                "title" => "53.7"

            ],
            [
                "name" => "Lease of Real Property and Venues",
                "parent" => "Negotiated Procurement",
                "title" => "53.10"

            ],
            [
                "name" => "Public Bidding",
                "parent" => "Public Bidding",
                "title" => ""

            ],
            [
                "name" => "Repeat Order",
                "parent" => "Alternative Methods of Procurement",
                "title" => "51"

            ],
            [
                "name" => "Scientific, Scholarly, or Artistic Work, Exclusive Technology and Media Services",
                "parent" => "Negotiated Procurement",
                "title" => "53.6"

            ],
            [
                "name" => "Shopping A",
                "parent" => "Alternative Methods of Procurement",
                "title" => "52.1"

            ],
            [
                "name" => "Shopping B",
                "parent" => "Alternative Methods of Procurement",
                "title" => "52.1"

            ],
            [
                "name" => "Small Value Procurement",
                "parent" => "Negotiated Procurement",
                "title" => "53.9"

            ],
            [
                "name" => "Two (2) Failed Bidding",
                "parent" => "Negotiated Procurement",
                "title" => "53.1"

            ],
            
        ];

        foreach ($mode_of_procurements as $mode_of_procurement) {

            $category = Library::where('name', $mode_of_procurement['parent'])->where('library_type','mode_of_procurement_classification')->first();
            $lib = Library::create([
                'name' => $mode_of_procurement['name'],
                'title' => $mode_of_procurement['title'],
                'library_type' => 'mode_of_procurement',
                'parent_id' => $category->id
            ]);
            echo $lib->library_type.": ".$lib->name."\n";
        }
    }
}
