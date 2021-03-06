<?php

namespace Database\Seeders;

use App\Models\ItemSupply;
use App\Models\Library;
use Illuminate\Database\Seeder;
use League\Csv\Reader;

class ItemRpciSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nonCse = Library::where('library_type','item_type')->where('name', ppmpNonCse())->first();
        $json = $this->json();
        $json = json_decode($this->json(), true);
        $i = 0;

        foreach ($json as $key => $res) {
            $data = [];
            if($i == 0){
                // var_dump($psgc_data);
                $i++;
                continue;
            }
            $item = [];
            $item['item_name'] = isset($res[2]) ? $res[2] : "";
            $item['unit_of_measure_id'] = isset($res[5]) ? $res[5] : "";
            $item['item_category_id'] = isset($res[7]) ? $res[7] : "";
            
            $item_category_library = Library::where('name',$item['item_category_id'])->where('library_type', 'item_category')->first();
            $unit_of_measure_library = Library::where('name',$item['unit_of_measure_id'])->where('library_type', 'unit_of_measure')->first();
            $item['item_category_id'] = $item_category_library ? $item_category_library->id : null;
            $item['unit_of_measure_id'] = $unit_of_measure_library ? $unit_of_measure_library->id : null;
            $createdItem = ItemSupply::create($item);
            echo "item name: ".$createdItem->item_name." item code: ".$createdItem->item_code."\n";
        }
    }



    public function json()
    {
        $reader = Reader::createFromPath(public_path('/files/item-rpci.csv'), 'r');
        $results = $reader->fetchAll();
        $data = array();
       
        foreach ($results as $key => $row) {
            $data[] = $row;
        }

        return $this->safe_json_encode($data);
    }

    private function safe_json_encode($value, $options = 0, $depth = 512){
		$encoded = json_encode($value, $options, $depth);
		switch (json_last_error()) {
			case JSON_ERROR_NONE:
				return $encoded;
			case JSON_ERROR_DEPTH:
				return 'Maximum stack depth exceeded'; // or trigger_error() or throw new Exception()
			case JSON_ERROR_STATE_MISMATCH:
				return 'Underflow or the modes mismatch'; // or trigger_error() or throw new Exception()
			case JSON_ERROR_CTRL_CHAR:
				return 'Unexpected control character found';
			case JSON_ERROR_SYNTAX:
				return 'Syntax error, malformed JSON'; // or trigger_error() or throw new Exception()
			case JSON_ERROR_UTF8:
				$clean = $this->utf8ize($value);
				return $this->safe_json_encode($clean, $options, $depth);
			default:
				return 'Unknown error'; // or trigger_error() or throw new Exception()

		}
    }
    
    private function utf8ize($d) {
		if (is_array($d)) {
			foreach ($d as $k => $v) {
				$d[$k] = $this->utf8ize($v);
			}
		} else if (is_string ($d)) {
			return utf8_encode($d);
		}
		return $d;
	}
}
