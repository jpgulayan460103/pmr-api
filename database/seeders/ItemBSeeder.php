<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\Library;

class ItemBSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cse = Library::where('library_type','item_type')->where('name', ppmpNonCse())->first();
        $items = [
            [
                'item_category_id' => "Printer or Facsimile or Photocopier Supplies",
                'unit_of_measure_id' => "PIECE",
                'item_code' => "",
                'item_name' => 'Printer Ink, HP Laserjet P1102',
                'item_type_id' => $cse->id,
                'price' => 0,
            ],
            [
                'item_category_id' => "Printer or Facsimile or Photocopier Supplies",
                'unit_of_measure_id' => "PIECE",
                'item_code' => "",
                'item_name' => 'Toner, OKI 363, Photocopy/Printer, Black',
                'item_type_id' => $cse->id,
                'price' => 0,
            ],
            [
                'item_category_id' => "Printer or Facsimile or Photocopier Supplies",
                'unit_of_measure_id' => "PIECE",
                'item_code' => "",
                'item_name' => 'Toner, OKI 363, Photocopy/Printer, Cyan',
                'item_type_id' => $cse->id,
                'price' => 0,
            ],
            [
                'item_category_id' => "Printer or Facsimile or Photocopier Supplies",
                'unit_of_measure_id' => "PIECE",
                'item_code' => "",
                'item_name' => 'Toner, OKI 363, Photocopy/Printer, Yellow',
                'item_type_id' => $cse->id,
                'price' => 0,
            ],
            [
                'item_category_id' => "Printer or Facsimile or Photocopier Supplies",
                'unit_of_measure_id' => "PIECE",
                'item_code' => "",
                'item_name' => 'Toner, OKI 363, Photocopy/Printer, Magenta',
                'item_type_id' => $cse->id,
                'price' => 0,
            ],
            [
                'item_category_id' => "Printer or Facsimile or Photocopier Supplies",
                'unit_of_measure_id' => "PIECE",
                'item_code' => "",
                'item_name' => 'Toner, Fuji M225, Black',
                'item_type_id' => $cse->id,
                'price' => 0,
            ],
            [
                'item_category_id' => "Printer or Facsimile or Photocopier Supplies",
                'unit_of_measure_id' => "PIECE",
                'item_code' => "",
                'item_name' => 'Cleaning blade',
                'item_type_id' => $cse->id,
                'price' => 0,
            ],

        ];

        foreach ($items as $item) {
            $item_category_library = Library::where('name',$item['item_category_id'])->where('library_type', 'item_category')->first();
            $unit_of_measure_library = Library::where('name',$item['unit_of_measure_id'])->where('library_type', 'unit_of_measure')->first();
            $item['item_category_id'] = $item_category_library ? $item_category_library->id : null;
            $item['unit_of_measure_id'] = $unit_of_measure_library ? $unit_of_measure_library->id : null;
            $createdItem = Item::create($item);
            echo "item name: ".$createdItem->item_name." item code: ".$createdItem->item_code."\n";
        }
    }
}
