<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Library;
use League\Csv\Reader;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::create([
        //     'account_type' => 'app_account',
        //     'username' => 'jpgulayan',
        //     'password' => 'admin123',
        // ]);


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
            
            $user = User::whereUsername($res[0])->first();
            if(!$user){
                $data['account_type'] = "app_account";
                $data['password'] = config('services.ad.default_password');
                $data['username'] = isset($res[0]) ? $res[0] : "";
                $user = User::create($data);
                $data = [];
                $data['email_address'] = isset($res[1]) ? $res[1] : "";
                $data['firstname'] = isset($res[2]) ? $res[2] : "";
                $data['middlename'] = isset($res[3]) ? $res[3] : "";
                $data['lastname'] = isset($res[4]) ? $res[4] : "";
                $office_title = isset($res[5]) ? $res[5] : "";

                // $office = Library::
            }
            $user_information = $user->user_information()->create($data);
            echo "hhid: $user->username count: ".$i.config('services.ad.default_password')."\n";
            $i++;
        }
    }

    public function json()
    {
        $reader = Reader::createFromPath(public_path('/files/users.csv'), 'r');
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
