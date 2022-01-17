<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Signatory;
use App\Models\User;
use App\Models\Library;

class SignatorySampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $office = Library::where('library_type','user_section')->whereTitle('ICTMS')->first();
        $user = User::create([
            "username" => "ict",
            "password" => config('services.ad.default_password'),
            "account_type" => "app_account",
        ]);
        Signatory::create([
            "office_id" => $office->id,
            "user_id" => $user->id,
            "designation" => "Test Account",
            "signatory_type" => "Personnel",
        ]);

        $office = Library::where('library_type','user_section')->whereTitle('PPD')->first();
        $user = User::create([
            "username" => "ppd",
            "password" => config('services.ad.default_password'),
            "account_type" => "app_account",
        ]);
        Signatory::create([
            "office_id" => $office->id,
            "user_id" => $user->id,
            "designation" => "Test Account",
            "signatory_type" => "Personnel",
        ]);

        $office = Library::where('library_type','user_section')->whereTitle('OARDA')->first();
        $user = User::create([
            "username" => "oarda",
            "password" => config('services.ad.default_password'),
            "account_type" => "app_account",
        ]);
        Signatory::create([
            "office_id" => $office->id,
            "user_id" => $user->id,
            "designation" => "Test Account",
            "signatory_type" => "Personnel",
        ]);

        $office = Library::where('library_type','user_section')->whereTitle('BACS')->first();
        $user = User::create([
            "username" => "bacs",
            "password" => config('services.ad.default_password'),
            "account_type" => "app_account",
        ]);
        Signatory::create([
            "office_id" => $office->id,
            "user_id" => $user->id,
            "designation" => "Test Account",
            "signatory_type" => "Personnel",
        ]);

        $office = Library::where('library_type','user_section')->whereTitle('BS')->first();
        $user = User::create([
            "username" => "budget",
            "password" => config('services.ad.default_password'),
            "account_type" => "app_account",
        ]);
        Signatory::create([
            "office_id" => $office->id,
            "user_id" => $user->id,
            "designation" => "Test Account",
            "signatory_type" => "Personnel",
        ]);

        $office = Library::where('library_type','user_section')->whereTitle('ORD')->first();
        $user = User::create([
            "username" => "ord",
            "password" => config('services.ad.default_password'),
            "account_type" => "app_account",
        ]);
        Signatory::create([
            "office_id" => $office->id,
            "user_id" => $user->id,
            "designation" => "Test Account",
            "signatory_type" => "Personnel",
        ]);
    }
}
