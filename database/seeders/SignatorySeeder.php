<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Signatory;
use App\Models\Library;
use App\Models\User;

class SignatorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ord = Library::where('library_type',"user_division")->where('title',"ord")->first();
        $oarda = Library::where('library_type',"user_division")->where('title',"oarda")->first();
        $oardo = Library::where('library_type',"user_division")->where('title',"oardo")->first();
        $ppd = Library::where('library_type',"user_division")->where('title',"ppd")->first();
        $ictms = Library::where('library_type',"user_section")->where('title',"ictms")->first();

        $ord_head = User::where('username',"rrrcui")->first();
        $oarda_head = User::where('username',"maparagamac")->first();
        $oardo_head = User::where('username',"etdegorio")->first();
        $ppd_head = User::where('username',"dspadillo")->first();
        $ictms_head = User::where('username',"rbgravador")->first();
        Signatory::create([
            "office_id" => $ord->id,
            "user_id" => $ord_head->id,
            "designation" => "Regional Director",
            "title" => "OIC -",
            "signatory_type" => "ORD",
        ]);


        Signatory::create([
            "office_id" => $oarda->id,
            "user_id" => $oarda_head->id,
            "designation" => "Assistant Regional Director for Administrator",
            "title" => "OIC -",
            "signatory_type" => "OARDA",
        ]);

        Signatory::create([
            "office_id" => $oardo->id,
            "user_id" => $oardo_head->id,
            "designation" => "Assistant Regional Director for Operations",
            "title" => "OIC -",
            "signatory_type" => "OARDO",
        ]);

        Signatory::create([
            "office_id" => $ppd->id,
            "user_id" => $ppd_head->id,
            "designation" => "PPD Chief",
            "title" => "",
            "signatory_type" => "DC",
        ]);

        Signatory::create([
            "office_id" => $ictms->id,
            "user_id" => $ictms_head->id,
            "designation" => "ICT Section Head",
            "title" => "",
            "signatory_type" => "SH",
        ]);
    }
}
