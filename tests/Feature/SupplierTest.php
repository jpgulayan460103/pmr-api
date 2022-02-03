<?php

namespace Tests\Feature;

use App\Models\SupplierContact;
use App\Models\User;
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
        $this->faker = \Faker\Factory::create();
    }
    public function test_create_supplier()
    {
        $user = User::with('signatories.office')->where('username','ict')->first();
        Passport::actingAs($user);
        $response = $this->post('/api/suppliers',[
            'name' => $this->faker->name,
            'address' => $this->faker->address,
            'contacts' => [
                [
                    'name' => $this->faker->address,
                    'address' => $this->faker->name,
                    'email_address' => $this->faker->email(),
                ],
                [
                    'name' => $this->faker->address,
                    'address' => $this->faker->name,
                    'email_address' => $this->faker->email(),
                ],
                [
                    'name' => $this->faker->address,
                    'address' => $this->faker->name,
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
        $user = User::with('signatories.office')->where('username','ict')->first();
        Passport::actingAs($user);
        $contact_1 = SupplierContact::where('supplier_id', SupplierTest::$supplier_id)->first()->toArray();
        $contact_1['name'] = "UPDATED ".$this->faker->address;
        $contact_1['address'] = "UPDATED ".$this->faker->name;
        $contact_1['email_address'] = $this->faker->email();
        $response = $this->put('/api/suppliers/'.SupplierTest::$supplier_id,[
            'name' => "UPDATED ".$this->faker->name,
            'address' => $this->faker->address,
            'contacts' => [
                $contact_1,
                [
                    'name' => $this->faker->address,
                    'address' => $this->faker->name,
                    'email_address' => $this->faker->email(),
                ],
                [
                    'name' => $this->faker->address,
                    'address' => $this->faker->name,
                    'email_address' => $this->faker->email(),
                ],
                [
                    'name' => $this->faker->address,
                    'address' => $this->faker->name,
                    'email_address' => $this->faker->email(),
                ]
            ]
        ]);
        $supplier = $response->decodeResponseJson();
        SupplierTest::$supplier_id = $supplier['id'];
        $response->assertStatus(200);
    }
}
