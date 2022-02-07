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

        $user->user_information()->create([
            'firstname' => 'ict_f',
            'middlename' => 'ict_m',
            'lastname' => 'ict_l',
            'user_dn' => '',
            'cellphone_number' => '',
            'email_address' => '',
        ]);


        $office = Library::where('library_type','user_section')->whereTitle('PS')->first();
        $user = User::create([
            "username" => "procurement",
            "password" => config('services.ad.default_password'),
            "account_type" => "app_account",
        ]);
        Signatory::create([
            "office_id" => $office->id,
            "user_id" => $user->id,
            "designation" => "Test Account",
            "signatory_type" => "Personnel",
        ]);

        $user->user_information()->create([
            'firstname' => 'proc_f',
            'middlename' => 'proc_m',
            'lastname' => 'proc_l',
            'user_dn' => '',
            'cellphone_number' => '',
            'email_address' => '',
        ]);


        $office = Library::where('library_type','user_section')->whereTitle('PPD')->first();
        $user = User::create([
            "username" => "ppd",
            "password" => config('services.ad.default_password'),
            "account_type" => "app_account",
        ]);

        $user->user_information()->create([
            'firstname' => 'ppd_f',
            'middlename' => 'ppd_m',
            'lastname' => 'ppd_l',
            'user_dn' => '',
            'cellphone_number' => '',
            'email_address' => '',
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

        $user->user_information()->create([
            'firstname' => 'oarda_f',
            'middlename' => 'oarda_m',
            'lastname' => 'oarda_l',
            'user_dn' => '',
            'cellphone_number' => '',
            'email_address' => '',
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

        $user->user_information()->create([
            'firstname' => 'bacs_f',
            'middlename' => 'bacs_m',
            'lastname' => 'bacs_l',
            'user_dn' => '',
            'cellphone_number' => '',
            'email_address' => '',
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
        $user->user_information()->create([
            'firstname' => 'budget_f',
            'middlename' => 'budget_m',
            'lastname' => 'budget_l',
            'user_dn' => '',
            'cellphone_number' => '',
            'email_address' => '',
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
        $user->user_information()->create([
            'firstname' => 'ord_f',
            'middlename' => 'ord_m',
            'lastname' => 'ord_l',
            'user_dn' => '',
            'cellphone_number' => '',
            'email_address' => '',
        ]);
        Signatory::create([
            "office_id" => $office->id,
            "user_id" => $user->id,
            "designation" => "Test Account",
            "signatory_type" => "Personnel",
        ]);
    }
}
