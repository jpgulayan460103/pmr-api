<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class QuotationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public static $quotation_id;
    public $faker;
    public function __construct() {
        parent::__construct();
        $this->faker = \Faker\Factory::create();
    }

    public function test_create_quotation()
    {
        $user = User::with('signatories.office')->where('username','ict')->first();
        Passport::actingAs($user);
        $response = $this->post('/api/quotations',[

        ]);
        $quotation = $response->decodeResponseJson();
        QuotationTest::$quotation_id = $quotation['id'];
        $response->assertStatus(201);
    }
}
