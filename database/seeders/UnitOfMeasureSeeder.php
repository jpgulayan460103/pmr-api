<?php

namespace Database\Seeders;

use App\Models\UnitOfMeasure;
use App\Models\Library;
use Illuminate\Database\Seeder;

class UnitOfMeasureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $unit_of_measures = [
            'AMPULE',
            'BAG',
            'BAR',
            'BOOK',
            'BOTTLE',
            'BOX',
            'BUNDLE',
            'CAN',
            'CAPSULE',
            'CART',
            'CYLS',
            'DOZEN',
            'GALLON',
            'JAR',
            'KILO',
            'L',
            'LICENSE',
            'LOT',
            'METER',
            'PACK',
            'PAD',
            'PAIR',
            'PAX',
            'PIECE',
            'QUART',
            'REAM',
            'ROLL',
            'SACHET',
            'SACK',
            'SHEET',
            'SET',
            'SPOOL',
            'TABLET',
            'TICKET',
            'TIN',
            'TUBE',
            'UNIT',
            'VIAL',            
        ];

        foreach ($unit_of_measures as $unit_of_measure) {
            $lib = Library::create(['library_type' => 'unit_of_measure', 'name' => $unit_of_measure]);
            echo $lib->library_type.": ".$lib->name."\n";
        }
    }
}
