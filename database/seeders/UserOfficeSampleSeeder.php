<?php

namespace Database\Seeders;

use App\Models\Library;
use App\Models\User;
use App\Models\UserOffice;
use Illuminate\Database\Seeder;

class UserOfficeSampleSeeder extends Seeder
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
        UserOffice::create([
            "office_id" => $office->id,
            "user_id" => $user->id,
            "designation" => "Test Account",
        ]);
        
        $user->user_information()->create([
            'firstname' => 'ict_f',
            'middlename' => 'ict_m',
            'lastname' => 'ict_l',
            'user_dn' => '',
            'cellphone_number' => '',
            'email_address' => '',
            'position_id' => 170,
        ]);


        $office = Library::where('library_type','user_section')->whereTitle('PS')->first();
        $user = User::create([
            "username" => "procurement",
            "password" => config('services.ad.default_password'),
            "account_type" => "app_account",
        ]);
        UserOffice::create([
            "office_id" => $office->id,
            "user_id" => $user->id,
            "designation" => "Test Account",
        ]);
        
        $user->user_information()->create([
            'firstname' => 'proc_f',
            'middlename' => 'proc_m',
            'lastname' => 'proc_l',
            'user_dn' => '',
            'cellphone_number' => '',
            'email_address' => '',
            'position_id' => 170,
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
            'position_id' => 170,
        ]);
        UserOffice::create([
            "office_id" => $office->id,
            "user_id" => $user->id,
            "designation" => "Test Account",
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
            'position_id' => 170,
        ]);
        UserOffice::create([
            "office_id" => $office->id,
            "user_id" => $user->id,
            "designation" => "Test Account",
        ]);
        

        $office = Library::where('library_type','user_section')->whereTitle('OARDO')->first();
        $user = User::create([
            "username" => "oardo",
            "password" => config('services.ad.default_password'),
            "account_type" => "app_account",
        ]);
        
        $user->user_information()->create([
            'firstname' => 'oardo_f',
            'middlename' => 'oardo_m',
            'lastname' => 'oardo_l',
            'user_dn' => '',
            'cellphone_number' => '',
            'email_address' => '',
            'position_id' => 170,
        ]);
        UserOffice::create([
            "office_id" => $office->id,
            "user_id" => $user->id,
            "designation" => "Test Account",
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
            'position_id' => 170,
        ]);
        UserOffice::create([
            "office_id" => $office->id,
            "user_id" => $user->id,
            "designation" => "Test Account",
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
            'position_id' => 170,
        ]);
        UserOffice::create([
            "office_id" => $office->id,
            "user_id" => $user->id,
            "designation" => "Test Account",
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
            'position_id' => 170,
        ]);
        UserOffice::create([
            "office_id" => $office->id,
            "user_id" => $user->id,
            "designation" => "Test Account",
        ]);
        
        $office = Library::where('library_type','user_section')->whereTitle('ICTMS')->first();
        $user = User::create([
            "username" => "twgict",
            "password" => config('services.ad.default_password'),
            "account_type" => "app_account",
        ]);
        $twg = Library::where('library_type','technical_working_group')->whereName('Information Technology')->first();
        $user->user_groups()->create([
            'group_id' => $twg->id
        ]);
        $user->user_information()->create([
            'firstname' => 'twgict_f',
            'middlename' => 'twgict_m',
            'lastname' => 'twgict_l',
            'user_dn' => '',
            'cellphone_number' => '',
            'email_address' => '',
            'position_id' => 170,
        ]);
        UserOffice::create([
            "office_id" => $office->id,
            "user_id" => $user->id,
            "designation" => "Test Account",
        ]);
    }
}
