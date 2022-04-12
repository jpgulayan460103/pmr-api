<?php

namespace Tests\Feature;

use App\Models\SupplierContact;
use App\Models\User;
use App\Models\Library;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class SupplierTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public static $supplier_id;
    public $faker;
    public function __construct() {
        parent::__construct();
        $this->faker = \Faker\Factory::create("en_PH");
    }
    public function test_create_supplier()
    {
        $user = User::with('user_offices.office')->where('username','ict')->first();
        Passport::actingAs($user);
        $response = $this->post('/api/suppliers',[
            'name' => $this->faker->company." ".$this->faker->companySuffix,
            'address' => $this->faker->address,
            'categories' => $this->faker->randomElements(Library::where('library_type','procurement_type')->get()->pluck('id'),2),
            'contacts' => [
                [
                    'name' => $this->faker->address,
                    'address' => $this->faker->name,
                    'contact_number' => $this->faker->phoneNumber,
                    'email_address' => $this->faker->email(),
                ],
                [
                    'name' => $this->faker->address,
                    'address' => $this->faker->name,
                    'contact_number' => $this->faker->phoneNumber,
                    'email_address' => $this->faker->email(),
                ],
                [
                    'name' => $this->faker->address,
                    'address' => $this->faker->name,
                    'contact_number' => $this->faker->phoneNumber,
                    'email_address' => $this->faker->email(),
                ]
            ]
        ]);
        $supplier = $response->decodeResponseJson();
        SupplierTest::$supplier_id = $supplier['id'];
        $response->assertStatus(201);
    }

    public function test_update_supplier()
    {
        $user = User::with('user_offices.office')->where('username','ict')->first();
        Passport::actingAs($user);
        $contact_1 = SupplierContact::where('supplier_id', SupplierTest::$supplier_id)->first()->toArray();
        $contact_1['name'] = $this->faker->name;
        $contact_1['address'] = $this->faker->address;
        $contact_1['email_address'] = $this->faker->email();
        $response = $this->put('/api/suppliers/'.SupplierTest::$supplier_id,[
            'name' => $this->faker->company." ".$this->faker->companySuffix,
            'address' => $this->faker->address,
            'categories' => $this->faker->randomElements(Library::where('library_type','procurement_type')->get()->pluck('id'),2),
            'contacts' => [
                $contact_1,
                [
                    'name' => $this->faker->name,
                    'address' => $this->faker->address,
                    'contact_number' => $this->faker->phoneNumber,
                    'email_address' => $this->faker->email(),
                ],
                [
                    'name' => $this->faker->name,
                    'address' => $this->faker->address,
                    'contact_number' => $this->faker->phoneNumber,
                    'email_address' => $this->faker->email(),
                ],
                [
                    'name' => $this->faker->name,
                    'address' => $this->faker->address,
                    'contact_number' => $this->faker->phoneNumber,
                    'email_address' => $this->faker->email(),
                ]
            ]
        ]);
        $supplier = $response->decodeResponseJson();
        SupplierTest::$supplier_id = $supplier['id'];
        $response->assertStatus(200);
    }
}
