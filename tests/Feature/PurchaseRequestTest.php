<?php

namespace Tests\Feature;

use App\Models\FormRoute;
use App\Models\Library;
use App\Models\PurchaseRequest;
use App\Models\PurchaseRequestItem;
use App\Models\Signatory;
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
        $this->faker = \Faker\Factory::create();
    }
    public function test_create_purchase_request()
    {
        $user = User::with('signatories.office')->where('username','ict')->first();
        Passport::actingAs($user);
        $office = $user->signatories;
        $response = $this->post('/api/purchase-requests',[
            'purchase_request_number' => Carbon::now()->format('Y')."-".$this->faker->numberBetween(1,1000),
            'purpose' => $this->faker->text(200),
            'fund_cluster' => $this->faker->numerify('fc-####-####-###'),
            'center_code' => $this->faker->numerify('cc-####-####-###'),
            'purchase_request_type_id' => $this->faker->randomElement(Library::where('library_type','procurement_type')->get()->pluck('id')),
            'mode_of_procurement_id' => $this->faker->randomElement(Library::where('library_type','mode_of_procurement')->get()->pluck('id')),
            'pr_date' => Carbon::now(),
            'end_user_id' => Library::find($office[0]['office_id'])->id,
            'requested_by_id' => Signatory::where('signatory_type','OARDA')->first()->id,
            'approved_by_id' => Signatory::where('signatory_type','ORD')->first()->id,
            'items' => [
                [
                    'item_name' => "Item Test 1",
                    'unit_of_measure_id' => $this->faker->randomElement(Library::where('library_type','unit_of_measure')->get()->pluck('id')),
                    'quantity' => $this->faker->numberBetween(1, 100),
                    'unit_cost' => $this->faker->randomFloat(2, 0, 10000),
                    'item_id' => 1,
                ],
                [
                    'item_name' => "Item Test 2",
                    'unit_of_measure_id' => $this->faker->randomElement(Library::where('library_type','unit_of_measure')->get()->pluck('id')),
                    'quantity' => $this->faker->numberBetween(1, 100),
                    'unit_cost' => $this->faker->randomFloat(2, 0, 10000),
                    'item_id' => 2,
                ],
            ]
        ]);
        $purchase_request = $response->decodeResponseJson();
        PurchaseRequestTest::$purchase_request_id = $purchase_request['id'];
        $response->assertStatus(201);
    }

    public function test_update_purchase_request()
    {
        $user = User::with('signatories.office')->where('username','ict')->first();
        Passport::actingAs($user);
        $response = $this->put('/api/purchase-requests/'.PurchaseRequestTest::$purchase_request_id,[
            'uacs_code' => $this->faker->numerify('uacs-####-####-###'),
            'charge_to' => $this->faker->name,
            'alloted_amount' => $this->faker->randomFloat(2, 0, 10000),
            'sa_or' => $this->faker->numerify('sa-####-####-###'),
        ]);
        $response->assertStatus(200);
    }

    public function test_update_purchase_request_items()
    {
        $user = User::with('signatories.office')->where('username','ict')->first();
        Passport::actingAs($user);
        $item_1 = PurchaseRequestItem::where('purchase_request_id', PurchaseRequestTest::$purchase_request_id)->first()->toArray();
        $item_1['quantity'] = $this->faker->numberBetween(1, 100);
        $item_1['unit_cost'] = $this->faker->randomFloat(2, 0, 10000);
        $response = $this->put('/api/purchase-requests/'.PurchaseRequestTest::$purchase_request_id,[
            'items' => [
                $item_1,
                [
                    'item_name' => "New Item Test 1",
                    'unit_of_measure_id' => $this->faker->randomElement(Library::where('library_type','unit_of_measure')->get()->pluck('id')),
                    'quantity' => $this->faker->numberBetween(1, 100),
                    'unit_cost' => $this->faker->randomFloat(2, 0, 10000),
                    'item_id' => 2,
                ]
            ]
        ]);
        $response->assertStatus(200);
    }

    public function test_approve_purchase_request_ict()
    {
        $user = User::with('signatories.office')->where('username','ict')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->first();
        $response = $this->post('api/form/routes/requests/pending/'.$form_route->id.'/approve',[
            'remarks' => "Test Approve ICT",
        ]);
        $response->assertStatus(200);
    }

    public function test_approve_purchase_request_ppd()
    {
        $user = User::with('signatories.office')->where('username','ppd')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->first();
        $response = $this->post('api/form/routes/requests/pending/'.$form_route->id.'/approve',[
            'remarks' => "Test Approve PPD",
        ]);
        $response->assertStatus(200);
    }

    public function test_approve_purchase_request_bacs()
    {
        $user = User::with('signatories.office')->where('username','bacs')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->first();
        $response = $this->post('api/form/routes/requests/pending/'.$form_route->id.'/approve',[
            'remarks' => "Test Approve BACS",
        ]);
        $response->assertStatus(200);
    }

    public function test_approve_purchase_request_oarda()
    {
        $user = User::with('signatories.office')->where('username','oarda')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->first();
        $response = $this->post('api/form/routes/requests/pending/'.$form_route->id.'/approve',[
            'remarks' => "Test Approve ORDA",
        ]);
        $response->assertStatus(200);
    }

    public function test_approve_purchase_request_budget()
    {
        $user = User::with('signatories.office')->where('username','budget')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->first();
        $response = $this->post('api/form/routes/requests/pending/'.$form_route->id.'/approve',[
            'remarks' => "Test Approve BUDGET",
        ]);
        $response->assertStatus(200);
    }

    public function test_approve_purchase_request_ord()
    {
        $user = User::with('signatories.office')->where('username','ord')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->first();
        $response = $this->post('api/form/routes/requests/pending/'.$form_route->id.'/approve',[
            'remarks' => "Test Approve ORD",
        ]);
        $response->assertStatus(200);
    }

    public function test_new_create_purchase_request()
    {
        $user = User::with('signatories.office')->where('username','ict')->first();
        Passport::actingAs($user);
        $office = $user->signatories;
        $response = $this->post('/api/purchase-requests',[
            'purchase_request_number' => Carbon::now()->format('Y')."-".$this->faker->numberBetween(1,1000),
            'purpose' => $this->faker->text(200),
            'fund_cluster' => $this->faker->numerify('fc-####-####-###'),
            'center_code' => $this->faker->numerify('cc-####-####-###'),
            'purchase_request_type_id' => $this->faker->randomElement(Library::where('library_type','procurement_type')->get()->pluck('id')),
            'mode_of_procurement_id' => $this->faker->randomElement(Library::where('library_type','mode_of_procurement')->get()->pluck('id')),
            'pr_date' => Carbon::now(),
            'end_user_id' => Library::find($office[0]['office_id'])->id,
            'requested_by_id' => Signatory::where('signatory_type','OARDA')->first()->id,
            'approved_by_id' => Signatory::where('signatory_type','ORD')->first()->id,
            'uacs_code' => $this->faker->numerify('uacs-####-####-###'),
            'charge_to' => $this->faker->name,
            'alloted_amount' => $this->faker->randomFloat(2, 0, 1000000),
            'sa_or' => $this->faker->numerify('sa-####-####-###'),
            'items' => [
                [
                    'item_name' => "Item Test 1",
                    'unit_of_measure_id' => $this->faker->randomElement(Library::where('library_type','unit_of_measure')->get()->pluck('id')),
                    'quantity' => $this->faker->numberBetween(1, 100),
                    'unit_cost' => $this->faker->randomFloat(2, 0, 10000),
                    'item_id' => 1,
                ],
                [
                    'item_name' => "Item Test 2",
                    'unit_of_measure_id' => $this->faker->randomElement(Library::where('library_type','unit_of_measure')->get()->pluck('id')),
                    'quantity' => $this->faker->numberBetween(1, 100),
                    'unit_cost' => $this->faker->randomFloat(2, 0, 10000),
                    'item_id' => 2,
                ],
            ]
        ]);
        $purchase_request = $response->decodeResponseJson();
        PurchaseRequestTest::$purchase_request_id = $purchase_request['id'];
        $response->assertStatus(201);
    }


    public function test_new_approve_purchase_request_ict()
    {
        $user = User::with('signatories.office')->where('username','ict')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->first();
        $response = $this->post('api/form/routes/requests/pending/'.$form_route->id.'/approve',[
            'remarks' => "NEW Test Approve ICT",
        ]);
        $response->assertStatus(200);
    }

    public function test_disapprove_purchase_request_ppd()
    {
        $user = User::with('signatories.office')->where('username','ppd')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->first();
        $response = $this->post('api/form/routes/requests/pending/'.$form_route->id.'/reject',[
            'remarks' => "With Issues",
        ]);
        $response->assertStatus(200);
    }

    public function test_resolve_purchase_request_ict()
    {
        $user = User::with('signatories.office')->where('username','ict')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','with_issues')->first();
        $response = $this->post('api/form/routes/requests/pending/'.$form_route->id.'/approve',[
            'remarks' => "Resolve Issues",
        ]);
        $response->assertStatus(200);
    }

    public function test_new_approve_purchase_request_ppd()
    {
        $user = User::with('signatories.office')->where('username','ppd')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->first();
        $response = $this->post('api/form/routes/requests/pending/'.$form_route->id.'/approve',[
            'remarks' => "NEW Test Approve PPD",
        ]);
        $response->assertStatus(200);
    }

    public function test_new_approve_purchase_request_bacs()
    {
        $user = User::with('signatories.office')->where('username','bacs')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->first();
        $response = $this->post('api/form/routes/requests/pending/'.$form_route->id.'/approve',[
            'remarks' => "NEW Test Approve BACS",
        ]);
        $response->assertStatus(200);
    }

    public function test_new_approve_purchase_request_oarda()
    {
        $user = User::with('signatories.office')->where('username','oarda')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->first();
        $response = $this->post('api/form/routes/requests/pending/'.$form_route->id.'/approve',[
            'remarks' => "NEW Test Approve OARDA",
        ]);
        $response->assertStatus(200);
    }

    public function test_new_approve_purchase_request_budget()
    {
        $user = User::with('signatories.office')->where('username','budget')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->first();
        $response = $this->post('api/form/routes/requests/pending/'.$form_route->id.'/approve',[
            'remarks' => "NEW Test Approve BUDGET",
        ]);
        $response->assertStatus(200);
    }

    public function test_new_approve_purchase_request_ord()
    {
        $user = User::with('signatories.office')->where('username','ord')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->first();
        $response = $this->post('api/form/routes/requests/pending/'.$form_route->id.'/approve',[
            'remarks' => "NEW Test Approve ORD",
        ]);
        $response->assertStatus(200);
    }


}
