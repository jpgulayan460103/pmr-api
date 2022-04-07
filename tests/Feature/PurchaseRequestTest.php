<?php

namespace Tests\Feature;

use App\Models\FormRoute;
use App\Models\Item;
use App\Models\Library;
use App\Models\PurchaseRequest;
use App\Models\PurchaseRequestItem;
use App\Models\User;
use Carbon\Carbon;
use Laravel\Passport\Passport;
use Tests\TestCase;

class PurchaseRequestTest extends TestCase
{

    //php artisan migrate:refresh --seed --env=testing 
    //php artisan passport:install --env=testing
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public static $purchase_request_id;
    public $faker;
    public function __construct() {
        parent::__construct();
        $this->faker = \Faker\Factory::create("en_PH");
    }
    public function test_create()
    {
        $user = User::with('user_offices.office')->where('username','ict')->first();
        Passport::actingAs($user);
        $office = $user->user_offices;
        $response = $this->post('/api/purchase-requests',[
            'title' => $this->faker->text(200),
            'purpose' => $this->faker->text(200),
            // 'pr_date' => Carbon::now(),
            'pr_date' => $this->faker->dateTimeThisYear(date('Y-m-d', strtotime('Dec 31'))),
            'end_user_id' => Library::find($office[0]['office_id'])->id,
            'requested_by_id' => Library::where('library_type','user_signatory_name')->where('title','OARDA')->first()->id,
            'approved_by_id' => Library::where('library_type','user_signatory_name')->where('title','ORD')->first()->id,
            'items' => [
                [
                    'item_name' => $this->faker->randomElement(Item::get()->pluck('item_name')),
                    'unit_of_measure_id' => $this->faker->randomElement(Library::where('library_type','unit_of_measure')->get()->pluck('id')),
                    'quantity' => $this->faker->numberBetween(1, 100),
                    'unit_cost' => $this->faker->randomFloat(2, 0, 10000),
                    'item_id' => $this->faker->randomElement(Item::get()->pluck('id')),
                    'is_ppmp' => true,
                ],
                [
                    'item_name' => $this->faker->randomElement(Item::get()->pluck('item_name')),
                    'unit_of_measure_id' => $this->faker->randomElement(Library::where('library_type','unit_of_measure')->get()->pluck('id')),
                    'quantity' => $this->faker->numberBetween(1, 100),
                    'unit_cost' => $this->faker->randomFloat(2, 0, 10000),
                    'item_id' => null,
                    'is_ppmp' => false,
                ],
            ]
        ]);
        $purchase_request = $response->decodeResponseJson();
        PurchaseRequestTest::$purchase_request_id = $purchase_request['id'];
        $response->assertStatus(201);
    }

    public function test_update_items()
    {
        $user = User::with('user_offices.office')->where('username','ict')->first();
        Passport::actingAs($user);
        $purchase_request = PurchaseRequest::find(PurchaseRequestTest::$purchase_request_id)->toArray();
        $item_1 = PurchaseRequestItem::where('purchase_request_id', PurchaseRequestTest::$purchase_request_id)->first()->toArray();
        $item_1['quantity'] = $this->faker->numberBetween(1, 100);
        $item_1['unit_cost'] = $this->faker->randomFloat(2, 0, 10000);
        $response = $this->put('/api/purchase-requests/'.PurchaseRequestTest::$purchase_request_id,[
            'end_user_id' => $purchase_request['end_user_id'],
            'pr_date' => $purchase_request['pr_date'],
            'purpose' => $purchase_request['purpose'],
            'title' => $purchase_request['title'],
            'items' => [
                $item_1,
                [
                    'item_name' => $this->faker->randomElement(Item::get()->pluck('item_name')),
                    'unit_of_measure_id' => $this->faker->randomElement(Library::where('library_type','unit_of_measure')->get()->pluck('id')),
                    'quantity' => $this->faker->numberBetween(1, 100),
                    'unit_cost' => $this->faker->randomFloat(2, 0, 10000),
                    'item_id' => 2,
                    'is_ppmp' => true,
                ]
            ]
        ]);
        $response->assertStatus(200);
    }
}
