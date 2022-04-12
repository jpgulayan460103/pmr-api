<?php

namespace Tests\Feature;

use App\Models\Library;
use App\Models\PurchaseRequest;
use App\Models\Quotation;
use App\Models\QuotationItem;
use App\Models\Supplier;
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
    public static $purchase_request_id;
    public $faker;
    public function __construct() {
        parent::__construct();
        $this->faker = \Faker\Factory::create("en_PH");
    }

    public function test_create_quotation()
    {
        $purchase_request = PurchaseRequest::with('items')->where('process_complete_status', 1)->first();
        $supplier = Supplier::with('contacts')->first();
        $user = User::with('user_offices.office')->where('username','ict')->first();
        Passport::actingAs($user);
        $items = array_map(function($item)
            {
                $item['suppliers_specifications'] = $item['item_name']." SUPPLIER SPECS";
                $item['purchase_request_item_id'] = $item['id'];
                return $item;
            },
            $purchase_request->items->toArray()
        );
        $response = $this->post('/api/quotations',[
            'rfq_number' => $this->faker->numerify('rfq-####-####-###'),
            'rfq_date' => $this->faker->date('Y-m-d','now'),
            'purchase_request_id' => $purchase_request->id,
            'supplier_id' => $supplier->id,
            'supplier_contact_id' => $this->faker->randomElement($supplier->contacts()->pluck('id')),
            'prepared_by_id' => $user->id,
            'total_amount' => $this->faker->randomFloat(2, 0, 10000),
            'items' => $items
        ]);
        $quotation = $response->decodeResponseJson();
        QuotationTest::$quotation_id = $quotation['id'];
        $response->assertStatus(201);
    }


    public function test_update_quotation()
    {
        $user = User::with('user_offices.office')->where('username','ict')->first();
        Passport::actingAs($user);
        $response = $this->put('/api/quotations/'.QuotationTest::$quotation_id,[
            'uacs_code_id' => $this->faker->randomElement(Library::where('library_type','uacs_code')->get()->pluck('id')),
            'charge_to' => $this->faker->name,
            'alloted_amount' => $this->faker->randomFloat(2, 0, 10000),
            'sa_or' => $this->faker->numerify('sa-####-####-###'),
        ]);
        $response->assertStatus(200);
    }

    public function test_update_quotation_items()
    {
        $user = User::with('user_offices.office')->where('username','ict')->first();
        Passport::actingAs($user);
        $quotation = Quotation::with('items')->find(QuotationTest::$quotation_id);
        $items = array_map(function($item)
            {
                $item['suppliers_specifications'] = "UPDATED ".$item['suppliers_specifications']." SUPPLIER SPECS";
                $item['quantity'] = $this->faker->numberBetween(1, $item['quantity']);
                $item['max_quantity'] = $item['quantity'];
                $item['unit_cost'] = $this->faker->randomFloat(2, 0, $item['unit_cost']);
                return $item;
            },
            $quotation->items->toArray()
        );
        $response = $this->put('/api/quotations/'.QuotationTest::$quotation_id,[
            'items' => $items
        ]);
        $response->assertStatus(200);
    }

}
