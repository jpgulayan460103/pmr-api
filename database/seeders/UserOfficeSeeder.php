<?php

namespace Database\Seeders;

use App\Models\Library;
use Illuminate\Database\Seeder;

class UserOfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ord = Library::where('library_type',"user_section")->where('title',"ord")->first();
        $oarda = Library::where('library_type',"user_section")->where('title',"oarda")->first();
        $oardo = Library::where('library_type',"user_section")->where('title',"oardo")->first();

        $ord_designation = Library::create([
            'library_type' => 'user_signatory_designation',
            'name' => 'Regional Director',
            'title' => 'ORD',
            'parent_id' => $ord->id,
        ]);

        Library::create([
            'library_type' => 'user_signatory_designation',
            'name' => 'OIC Regional Director',
            'title' => 'ORD',
            'parent_id' => $ord->id,
        ]);

        $ord_name = Library::create([
            'library_type' => 'user_signatory_name',
            'name' => 'ATTY. VANESSA B. GOC-ONG',
            'title' => 'ORD',
            'parent_id' => $ord_designation->id,
        ]);

        $oarda_designation = Library::create([
            'library_type' => 'user_signatory_designation',
            'name' => 'OIC Assistant Regional Director for Administration',
            'title' => 'OARDA',
            'parent_id' => $oarda->id,
        ]);

        Library::create([
            'library_type' => 'user_signatory_designation',
            'name' => 'Assistant Regional Director for Administration',
            'title' => 'OARDA',
            'parent_id' => $oarda->id,
        ]);

        $oarda_name = Library::create([
            'library_type' => 'user_signatory_name',
            'name' => 'MERLINDA A. PARAGAMAC',
            'title' => 'OARDA',
            'parent_id' => $oarda_designation->id,
        ]);


        $oardo_designation = Library::create([
            'library_type' => 'user_signatory_designation',
            'name' => 'Assistant Regional Director for Operations',
            'title' => 'OARDO',
            'parent_id' => $oardo->id,
        ]);

        Library::create([
            'library_type' => 'user_signatory_designation',
            'name' => 'OIC Assistant Regional Director for Operations',
            'title' => 'OARDO',
            'parent_id' => $oardo->id,
        ]);

        $oardo_name = Library::create([
            'library_type' => 'user_signatory_name',
            'name' => 'RONALD RYAN R. CUI',
            'title' => 'OARDO',
            'parent_id' => $oardo_designation->id,
        ]);
    }
}
