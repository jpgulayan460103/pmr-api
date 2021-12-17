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
            'CAN',
            'BAR',
            'BOOK',
            'BOTTLE',
            'BOX',
            'BUNDLE',
            'CART',
            'GALLON',
            'JAR',
            'LICENSE',
            'LOT',
            'PACK',
            'PAD',
            'PAIR',
            'PIECE',
            'REAM',
            'ROLL',
            'SET',
            'TICKET',
            'UNIT',
        ];

        foreach ($unit_of_measures as $unit_of_measure) {
            $lib = Library::create(['type' => 'unit_of_measure', 'name' => $unit_of_measure]);
            echo $lib->type.": ".$lib->name."\n";
        }
    }
}
