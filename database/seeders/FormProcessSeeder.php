<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FormProcess;
use App\Models\Library;

class FormProcessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $office = Library::where('library_type','user_section')->where('title','ICTMS')->first();
        $bac = Library::where('library_type','user_section')->where('title','BACS')->first();
        $bs = Library::where('library_type','user_section')->where('title','BS')->first();
        $rd = Library::where('library_type','user_section')->where('title','ORD')->first();
        $data = [
            'process_description' => '',
            'form_routes' => json_encode([
                '1' => $office->parent->id,
                '3' => $bac->id,
                '4' => $bs->id,
                '5' => $rd->id,
            ]),
            'form_type' => 'purchase_request',
            'office_id' => $office->id,
        ];
        FormProcess::create($data);
    }
}
