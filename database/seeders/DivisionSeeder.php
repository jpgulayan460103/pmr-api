<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Library;
use League\Csv\Reader;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
            $category = [];
            $category['name'] = isset($res[0]) ? $res[0] : "";
            $category['title'] = isset($res[1]) ? $res[1] : "";
            $category['division'] = isset($res[2]) ? $res[2] : "";
            
            $parent_lib = Library::where('library_type','user_division')->where('name', $category['division'])->first();
            $parent_id = null;
            if($parent_lib){
                $parent_id = $parent_lib->id;
            }
            
            $lib = Library::create(['name' => $category['name'], 'title' => $category['title'], 'library_type' => 'user_division', 'parent_id' => $parent_id]);
            echo $lib->library_type.": ".$lib->name." ".$lib->title."\n";
        }
    }



    public function json()
    {
        $reader = Reader::createFromPath(public_path('/files/divisions.csv'), 'r');
        // $results = $reader->fetchAll();
        $results = $reader->getRecords();
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
