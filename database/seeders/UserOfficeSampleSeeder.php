<?php

namespace Database\Seeders;

use App\Models\Library;
use App\Models\User;
use App\Models\UserOffice;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class UserOfficeSampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            "username" => "admin",
            "password" => config('services.ad.default_password'),
            "account_type" => "app_account",
        ]);
        
        $user->user_information()->create([
            'firstname' => 'admin_f',
            'middlename' => 'admin_m',
            'lastname' => 'admin_l',
            'user_dn' => '',
            'cellphone_number' => '',
            'email_address' => '',
        ]);
        $user->givePermissionTo(Permission::all()->pluck('name'));
        $user->assignRole('super-admin');


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
            'position_id' => Library::where('library_type','user_position')->first()->id,
        ]);
        $user->givePermissionTo(Permission::all()->pluck('name'));
        $user->assignRole('admin');


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
            'position_id' => Library::where('library_type','user_position')->first()->id,
        ]);
        $user->givePermissionTo(Permission::all()->pluck('name'));
        $user->assignRole('admin');


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
            'position_id' => Library::where('library_type','user_position')->first()->id,
        ]);
        UserOffice::create([
            "office_id" => $office->id,
            "user_id" => $user->id,
            "designation" => "Test Account",
        ]);

        $user->givePermissionTo(Permission::all()->pluck('name'));
        $user->assignRole('admin');
        
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
            'position_id' => Library::where('library_type','user_position')->first()->id,
        ]);
        UserOffice::create([
            "office_id" => $office->id,
            "user_id" => $user->id,
            "designation" => "Test Account",
        ]);
        $user->givePermissionTo(Permission::all()->pluck('name'));
        $user->assignRole('admin');
        

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
            'position_id' => Library::where('library_type','user_position')->first()->id,
        ]);
        UserOffice::create([
            "office_id" => $office->id,
            "user_id" => $user->id,
            "designation" => "Test Account",
        ]);
        $user->givePermissionTo(Permission::all()->pluck('name'));
        $user->assignRole('admin');
        
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
            'position_id' => Library::where('library_type','user_position')->first()->id,
        ]);
        UserOffice::create([
            "office_id" => $office->id,
            "user_id" => $user->id,
            "designation" => "Test Account",
        ]);
        $user->givePermissionTo(Permission::all()->pluck('name'));
        $user->assignRole('admin');
        
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
            'position_id' => Library::where('library_type','user_position')->first()->id,
        ]);
        UserOffice::create([
            "office_id" => $office->id,
            "user_id" => $user->id,
            "designation" => "Test Account",
        ]);
        $user->givePermissionTo(Permission::all()->pluck('name'));
        $user->assignRole('admin');
        
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
            'position_id' => Library::where('library_type','user_position')->first()->id,
        ]);
        UserOffice::create([
            "office_id" => $office->id,
            "user_id" => $user->id,
            "designation" => "Test Account",
        ]);
        $user->givePermissionTo(Permission::all()->pluck('name'));
        $user->assignRole('admin');
        
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
            'position_id' => Library::where('library_type','user_position')->first()->id,
        ]);
        UserOffice::create([
            "office_id" => $office->id,
            "user_id" => $user->id,
            "designation" => "Test Account",
        ]);
        $user->givePermissionTo(Permission::all()->pluck('name'));
        $user->assignRole('admin');

        //extensions


        $office = Library::where('library_type','user_section')->whereTitle('AD')->first();
        $user = User::create([
            "username" => "ad",
            "password" => config('services.ad.default_password'),
            "account_type" => "app_account",
        ]);
        $user->user_information()->create([
            'firstname' => 'ad_f',
            'middlename' => 'ad_m',
            'lastname' => 'ad_l',
            'user_dn' => '',
            'cellphone_number' => '',
            'email_address' => '',
            'position_id' => Library::where('library_type','user_position')->first()->id,
        ]);
        UserOffice::create([
            "office_id" => $office->id,
            "user_id" => $user->id,
            "designation" => "Test Account",
        ]);
        $user->givePermissionTo(Permission::all()->pluck('name'));
        $user->assignRole('admin');



        $office = Library::where('library_type','user_section')->whereTitle('HRMDD')->first();
        $user = User::create([
            "username" => "hrmdd",
            "password" => config('services.ad.default_password'),
            "account_type" => "app_account",
        ]);
        $user->user_information()->create([
            'firstname' => 'hrmdd_f',
            'middlename' => 'hrmdd_m',
            'lastname' => 'hrmdd_l',
            'user_dn' => '',
            'cellphone_number' => '',
            'email_address' => '',
            'position_id' => Library::where('library_type','user_position')->first()->id,
        ]);
        UserOffice::create([
            "office_id" => $office->id,
            "user_id" => $user->id,
            "designation" => "Test Account",
        ]);
        $user->givePermissionTo(Permission::all()->pluck('name'));
        $user->assignRole('admin');


        $office = Library::where('library_type','user_section')->whereTitle('PAS')->first();
        $user = User::create([
            "username" => "pas",
            "password" => config('services.ad.default_password'),
            "account_type" => "app_account",
        ]);
        $user->user_information()->create([
            'firstname' => 'pas_f',
            'middlename' => 'pas_m',
            'lastname' => 'pas_l',
            'user_dn' => '',
            'cellphone_number' => '',
            'email_address' => '',
            'position_id' => Library::where('library_type','user_position')->first()->id,
        ]);
        UserOffice::create([
            "office_id" => $office->id,
            "user_id" => $user->id,
            "designation" => "Test Account",
        ]);
        $user->givePermissionTo(Permission::all()->pluck('name'));
        $user->assignRole('admin');


        $office = Library::where('library_type','user_section')->whereTitle('FMD')->first();
        $user = User::create([
            "username" => "fmd",
            "password" => config('services.ad.default_password'),
            "account_type" => "app_account",
        ]);
        $user->user_information()->create([
            'firstname' => 'fmd_f',
            'middlename' => 'fmd_m',
            'lastname' => 'fmd_l',
            'user_dn' => '',
            'cellphone_number' => '',
            'email_address' => '',
            'position_id' => Library::where('library_type','user_position')->first()->id,
        ]);
        UserOffice::create([
            "office_id" => $office->id,
            "user_id" => $user->id,
            "designation" => "Test Account",
        ]);
        $user->givePermissionTo(Permission::all()->pluck('name'));
        $user->assignRole('admin');


        $office = Library::where('library_type','user_section')->whereTitle('PPPPMD')->first();
        $user = User::create([
            "username" => "ppppmd",
            "password" => config('services.ad.default_password'),
            "account_type" => "app_account",
        ]);
        $user->user_information()->create([
            'firstname' => 'ppppmd_f',
            'middlename' => 'ppppmd_m',
            'lastname' => 'ppppmd_l',
            'user_dn' => '',
            'cellphone_number' => '',
            'email_address' => '',
            'position_id' => Library::where('library_type','user_position')->first()->id,
        ]);
        UserOffice::create([
            "office_id" => $office->id,
            "user_id" => $user->id,
            "designation" => "Test Account",
        ]);
        $user->givePermissionTo(Permission::all()->pluck('name'));
        $user->assignRole('admin');


        $office = Library::where('library_type','user_section')->whereTitle('PPPPMD - davao city')->first();
        $user = User::create([
            "username" => "ppppmd - davao city",
            "password" => config('services.ad.default_password'),
            "account_type" => "app_account",
        ]);
        $user->user_information()->create([
            'firstname' => 'ppppmd - davao city_f',
            'middlename' => 'ppppmd - davao city_m',
            'lastname' => 'ppppmd - davao city_l',
            'user_dn' => '',
            'cellphone_number' => '',
            'email_address' => '',
            'position_id' => Library::where('library_type','user_position')->first()->id,
        ]);
        UserOffice::create([
            "office_id" => $office->id,
            "user_id" => $user->id,
            "designation" => "Test Account",
        ]);
        $user->givePermissionTo(Permission::all()->pluck('name'));
        $user->assignRole('admin');


        $office = Library::where('library_type','user_section')->whereTitle('Protective')->first();
        $user = User::create([
            "username" => "protective",
            "password" => config('services.ad.default_password'),
            "account_type" => "app_account",
        ]);
        $user->user_information()->create([
            'firstname' => 'protective_f',
            'middlename' => 'protective_m',
            'lastname' => 'protective_l',
            'user_dn' => '',
            'cellphone_number' => '',
            'email_address' => '',
            'position_id' => Library::where('library_type','user_position')->first()->id,
        ]);
        UserOffice::create([
            "office_id" => $office->id,
            "user_id" => $user->id,
            "designation" => "Test Account",
        ]);
        $user->givePermissionTo(Permission::all()->pluck('name'));
        $user->assignRole('admin');


        $office = Library::where('library_type','user_section')->whereTitle('CIS')->first();
        $user = User::create([
            "username" => "cis",
            "password" => config('services.ad.default_password'),
            "account_type" => "app_account",
        ]);
        $user->user_information()->create([
            'firstname' => 'cis_f',
            'middlename' => 'cis_m',
            'lastname' => 'cis_l',
            'user_dn' => '',
            'cellphone_number' => '',
            'email_address' => '',
            'position_id' => Library::where('library_type','user_position')->first()->id,
        ]);
        UserOffice::create([
            "office_id" => $office->id,
            "user_id" => $user->id,
            "designation" => "Test Account",
        ]);
        $user->givePermissionTo(Permission::all()->pluck('name'));
        $user->assignRole('admin');


        $office = Library::where('library_type','user_section')->whereTitle('DRMD')->first();
        $user = User::create([
            "username" => "drmd",
            "password" => config('services.ad.default_password'),
            "account_type" => "app_account",
        ]);
        $user->user_information()->create([
            'firstname' => 'drmd_f',
            'middlename' => 'drmd_m',
            'lastname' => 'drmd_l',
            'user_dn' => '',
            'cellphone_number' => '',
            'email_address' => '',
            'position_id' => Library::where('library_type','user_position')->first()->id,
        ]);
        UserOffice::create([
            "office_id" => $office->id,
            "user_id" => $user->id,
            "designation" => "Test Account",
        ]);
        $user->givePermissionTo(Permission::all()->pluck('name'));
        $user->assignRole('admin');


        $office = Library::where('library_type','user_section')->whereTitle('DRIMS')->first();
        $user = User::create([
            "username" => "drims",
            "password" => config('services.ad.default_password'),
            "account_type" => "app_account",
        ]);
        $user->user_information()->create([
            'firstname' => 'drims_f',
            'middlename' => 'drims_m',
            'lastname' => 'drims_l',
            'user_dn' => '',
            'cellphone_number' => '',
            'email_address' => '',
            'position_id' => Library::where('library_type','user_position')->first()->id,
        ]);
        UserOffice::create([
            "office_id" => $office->id,
            "user_id" => $user->id,
            "designation" => "Test Account",
        ]);
        $user->givePermissionTo(Permission::all()->pluck('name'));
        $user->assignRole('admin');


        $office = Library::where('library_type','user_section')->whereTitle('Promotive')->first();
        $user = User::create([
            "username" => "promotive",
            "password" => config('services.ad.default_password'),
            "account_type" => "app_account",
        ]);
        $user->user_information()->create([
            'firstname' => 'promotive_f',
            'middlename' => 'promotive_m',
            'lastname' => 'promotive_l',
            'user_dn' => '',
            'cellphone_number' => '',
            'email_address' => '',
            'position_id' => Library::where('library_type','user_position')->first()->id,
        ]);
        UserOffice::create([
            "office_id" => $office->id,
            "user_id" => $user->id,
            "designation" => "Test Account",
        ]);
        $user->givePermissionTo(Permission::all()->pluck('name'));
        $user->assignRole('admin');


        $office = Library::where('library_type','user_section')->whereTitle('SLPMO')->first();
        $user = User::create([
            "username" => "slpmo",
            "password" => config('services.ad.default_password'),
            "account_type" => "app_account",
        ]);
        $user->user_information()->create([
            'firstname' => 'slpmo_f',
            'middlename' => 'slpmo_m',
            'lastname' => 'slpmo_l',
            'user_dn' => '',
            'cellphone_number' => '',
            'email_address' => '',
            'position_id' => Library::where('library_type','user_position')->first()->id,
        ]);
        UserOffice::create([
            "office_id" => $office->id,
            "user_id" => $user->id,
            "designation" => "Test Account",
        ]);
        $user->givePermissionTo(Permission::all()->pluck('name'));
        $user->assignRole('admin');


        $office = Library::where('library_type','user_section')->whereTitle('GSS')->first();
        $user = User::create([
            "username" => "gss",
            "password" => config('services.ad.default_password'),
            "account_type" => "app_account",
        ]);
        $user->user_information()->create([
            'firstname' => 'gss_f',
            'middlename' => 'gss_m',
            'lastname' => 'gss_l',
            'user_dn' => '',
            'cellphone_number' => '',
            'email_address' => '',
            'position_id' => Library::where('library_type','user_position')->first()->id,
        ]);
        UserOffice::create([
            "office_id" => $office->id,
            "user_id" => $user->id,
            "designation" => "Test Account",
        ]);
        $user->givePermissionTo(Permission::all()->pluck('name'));
        $user->assignRole('admin');


        $office = Library::where('library_type','user_section')->whereTitle('PSWDO - Davao City')->first();
        $user = User::create([
            "username" => "pswdo - davao city",
            "password" => config('services.ad.default_password'),
            "account_type" => "app_account",
        ]);
        $user->user_information()->create([
            'firstname' => 'pswdo - davao city_f',
            'middlename' => 'pswdo - davao city_m',
            'lastname' => 'pswdo - davao city_l',
            'user_dn' => '',
            'cellphone_number' => '',
            'email_address' => '',
            'position_id' => Library::where('library_type','user_position')->first()->id,
        ]);
        UserOffice::create([
            "office_id" => $office->id,
            "user_id" => $user->id,
            "designation" => "Test Account",
        ]);
        $user->givePermissionTo(Permission::all()->pluck('name'));
        $user->assignRole('admin');


        $office = Library::where('library_type','user_section')->whereTitle('PSWDO - De Oro')->first();
        $user = User::create([
            "username" => "pswdo - de oro",
            "password" => config('services.ad.default_password'),
            "account_type" => "app_account",
        ]);
        $user->user_information()->create([
            'firstname' => 'pswdo - de oro_f',
            'middlename' => 'pswdo - de oro_m',
            'lastname' => 'pswdo - de oro_l',
            'user_dn' => '',
            'cellphone_number' => '',
            'email_address' => '',
            'position_id' => Library::where('library_type','user_position')->first()->id,
        ]);
        UserOffice::create([
            "office_id" => $office->id,
            "user_id" => $user->id,
            "designation" => "Test Account",
        ]);
        $user->givePermissionTo(Permission::all()->pluck('name'));
        $user->assignRole('admin');


        $office = Library::where('library_type','user_section')->whereTitle('PSWDO - Del Norte')->first();
        $user = User::create([
            "username" => "pswdo - del norte",
            "password" => config('services.ad.default_password'),
            "account_type" => "app_account",
        ]);
        $user->user_information()->create([
            'firstname' => 'pswdo - del norte_f',
            'middlename' => 'pswdo - del norte_m',
            'lastname' => 'pswdo - del norte_l',
            'user_dn' => '',
            'cellphone_number' => '',
            'email_address' => '',
            'position_id' => Library::where('library_type','user_position')->first()->id,
        ]);
        UserOffice::create([
            "office_id" => $office->id,
            "user_id" => $user->id,
            "designation" => "Test Account",
        ]);
        $user->givePermissionTo(Permission::all()->pluck('name'));
        $user->assignRole('admin');


        $office = Library::where('library_type','user_section')->whereTitle('PSWDO - Del Sur')->first();
        $user = User::create([
            "username" => "pswdo - del sur",
            "password" => config('services.ad.default_password'),
            "account_type" => "app_account",
        ]);
        $user->user_information()->create([
            'firstname' => 'pswdo - del sur_f',
            'middlename' => 'pswdo - del sur_m',
            'lastname' => 'pswdo - del sur_l',
            'user_dn' => '',
            'cellphone_number' => '',
            'email_address' => '',
            'position_id' => Library::where('library_type','user_position')->first()->id,
        ]);
        UserOffice::create([
            "office_id" => $office->id,
            "user_id" => $user->id,
            "designation" => "Test Account",
        ]);
        $user->givePermissionTo(Permission::all()->pluck('name'));
        $user->assignRole('admin');


        $office = Library::where('library_type','user_section')->whereTitle('pswdo - occidental')->first();
        $user = User::create([
            "username" => "pswdo - occidental",
            "password" => config('services.ad.default_password'),
            "account_type" => "app_account",
        ]);
        $user->user_information()->create([
            'firstname' => 'pswdo - occidental_f',
            'middlename' => 'pswdo - occidental_m',
            'lastname' => 'pswdo - occidental_l',
            'user_dn' => '',
            'cellphone_number' => '',
            'email_address' => '',
            'position_id' => Library::where('library_type','user_position')->first()->id,
        ]);
        UserOffice::create([
            "office_id" => $office->id,
            "user_id" => $user->id,
            "designation" => "Test Account",
        ]);
        $user->givePermissionTo(Permission::all()->pluck('name'));
        $user->assignRole('admin');


        $office = Library::where('library_type','user_section')->whereTitle('pswdo - oriental')->first();
        $user = User::create([
            "username" => "pswdo - oriental",
            "password" => config('services.ad.default_password'),
            "account_type" => "app_account",
        ]);
        $user->user_information()->create([
            'firstname' => 'pswdo - oriental_f',
            'middlename' => 'pswdo - oriental_m',
            'lastname' => 'pswdo - oriental_l',
            'user_dn' => '',
            'cellphone_number' => '',
            'email_address' => '',
            'position_id' => Library::where('library_type','user_position')->first()->id,
        ]);
        UserOffice::create([
            "office_id" => $office->id,
            "user_id" => $user->id,
            "designation" => "Test Account",
        ]);
        $user->givePermissionTo(Permission::all()->pluck('name'));
        $user->assignRole('admin');



    }
}
