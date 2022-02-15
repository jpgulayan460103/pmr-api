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
        $this->faker = \Faker\Factory::create();
    }
    public function test_create()
    {
        $user = User::with('user_offices.office')->where('username','ict')->first();
        Passport::actingAs($user);
        $office = $user->user_offices;
        $response = $this->post('/api/purchase-requests',[
            'purpose' => $this->faker->text(200),
            'pr_date' => Carbon::now(),
            'end_user_id' => Library::find($office[0]['office_id'])->id,
            'requested_by_id' => Library::where('library_type','user_signatory_name')->where('title','OARDA')->first()->id,
            'approved_by_id' => Library::where('library_type','user_signatory_name')->where('title','ORD')->first()->id,
            'items' => [
                [
                    'item_name' => "Item Test 1",
                    'unit_of_measure_id' => $this->faker->randomElement(Library::where('library_type','unit_of_measure')->get()->pluck('id')),
                    'quantity' => $this->faker->numberBetween(1, 100),
                    'unit_cost' => $this->faker->randomFloat(2, 0, 10000),
                    'item_id' => $this->faker->randomElement(Item::get()->pluck('id')),
                    'is_ppmp' => true,
                ],
                [
                    'item_name' => "Item Test 2",
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
            'items' => [
                $item_1,
                [
                    'item_name' => "New Item Test 1",
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

    public function test_approve_ict()
    {
        $user = User::with('user_offices.office')->where('username','ict')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->where('form_routable_id',PurchaseRequestTest::$purchase_request_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/approve');
        $response->assertStatus(200);
    }

    public function test_approve_procurement()
    {
        $user = User::with('user_offices.office')->where('username','procurement')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->where('form_routable_id',PurchaseRequestTest::$purchase_request_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/approve');
        $response->assertStatus(200);
    }

    public function test_update_procurement()
    {
        $user = User::with('user_offices.office')->where('username','procurement')->first();
        Passport::actingAs($user);
        $response = $this->put('/api/purchase-requests/'.PurchaseRequestTest::$purchase_request_id,[
            'purchase_request_type_id' => $this->faker->randomElement(Library::where('library_type','procurement_type')->get()->pluck('id')),
            'mode_of_procurement_id' => $this->faker->randomElement(Library::where('library_type','mode_of_procurement')->get()->pluck('id')),
            'updater' => 'procurement',
        ]);
        $response->assertStatus(200);
    }

    public function test_approve_ppd()
    {
        $user = User::with('user_offices.office')->where('username','ppd')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->where('form_routable_id',PurchaseRequestTest::$purchase_request_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/approve');
        $response->assertStatus(200);
    }

    public function test_approve_bacs()
    {
        $user = User::with('user_offices.office')->where('username','bacs')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->where('form_routable_id',PurchaseRequestTest::$purchase_request_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/approve');
        $response->assertStatus(200);
    }

    public function test_approve_oarda()
    {
        $user = User::with('user_offices.office')->where('username','oarda')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->where('form_routable_id',PurchaseRequestTest::$purchase_request_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/approve');
        $response->assertStatus(200);
    }

    public function test_approve_budget()
    {
        $user = User::with('user_offices.office')->where('username','budget')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->where('form_routable_id',PurchaseRequestTest::$purchase_request_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/approve');
        $response->assertStatus(200);
    }
    public function test_update_budget()
    {
        $user = User::with('user_offices.office')->where('username','budget')->first();
        Passport::actingAs($user);
        $response = $this->put('/api/purchase-requests/'.PurchaseRequestTest::$purchase_request_id,[
            'purchase_request_number' => "BUDRP-PR-".Carbon::now()->format('Y-m-').$this->faker->numberBetween(1,99999),
            'uacs_code' => $this->faker->numerify('uacs-####-####-###'),
            'charge_to' => $this->faker->name,
            'alloted_amount' => $this->faker->randomFloat(2, 0, 10000),
            'sa_or' => $this->faker->numerify('sa-####-####-###'),
            'updater' => 'budget',
            'fund_cluster' => $this->faker->numerify('fc-####-####-###'),
            'center_code' => $this->faker->numerify('rcc-####-####-###'),
            'purchase_request_number_last' => str_pad($this->faker->numberBetween(1,99999),5,"0",STR_PAD_LEFT),
        ]);
        $response->assertStatus(200);
    }

    public function test_approve_ord()
    {
        $user = User::with('user_offices.office')->where('username','ord')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->where('form_routable_id',PurchaseRequestTest::$purchase_request_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/approve');
        $response->assertStatus(200);
    }

    public function test_new_for_rejection()
    {
        $user = User::with('user_offices.office')->where('username','ict')->first();
        Passport::actingAs($user);
        $office = $user->user_offices;
        $response = $this->post('/api/purchase-requests',[
            'purpose' => $this->faker->text(200),
            'fund_cluster' => $this->faker->numerify('fc-####-####-###'),
            'center_code' => $this->faker->numerify('cc-####-####-###'),
            'pr_date' => Carbon::now(),
            'end_user_id' => Library::find($office[0]['office_id'])->id,
            'requested_by_id' => Library::where('library_type','user_signatory_name')->where('title','OARDA')->first()->id,
            'approved_by_id' => Library::where('library_type','user_signatory_name')->where('title','ORD')->first()->id,
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
                    'item_id' => $this->faker->randomElement(Item::get()->pluck('id')),
                    'is_ppmp' => true,
                ],
                [
                    'item_name' => "Item Test 2",
                    'unit_of_measure_id' => $this->faker->randomElement(Library::where('library_type','unit_of_measure')->get()->pluck('id')),
                    'quantity' => $this->faker->numberBetween(1, 100),
                    'unit_cost' => $this->faker->randomFloat(2, 0, 10000),
                    'item_id' => $this->faker->randomElement(Item::get()->pluck('id')),
                    'is_ppmp' => true,
                ],
            ]
        ]);
        $purchase_request = $response->decodeResponseJson();
        PurchaseRequestTest::$purchase_request_id = $purchase_request['id'];
        $response->assertStatus(201);
    }


    public function test_approve_ict_for_rejection()
    {
        $user = User::with('user_offices.office')->where('username','ict')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->where('form_routable_id',PurchaseRequestTest::$purchase_request_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/approve');
        $response->assertStatus(200);
    }

    public function test_reject_procurement()
    {
        $user = User::with('user_offices.office')->where('username','procurement')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->where('form_routable_id',PurchaseRequestTest::$purchase_request_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/reject',[
            'remarks' => "With Issues",
        ]);
        $response->assertStatus(200);
    }

    public function test_resolve_from_procurement()
    {
        $user = User::with('user_offices.office')->where('username','ict')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','with_issues')->where('form_routable_id',PurchaseRequestTest::$purchase_request_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/approve',[
            'remarks' => "Resolve Issues",
        ]);
        $response->assertStatus(200);
    }

    //insert twg

    public function test_update_for_twg()
    {
        $user = User::with('user_offices.office')->where('username','procurement')->first();
        Passport::actingAs($user);
        $response = $this->put('api/forms/process/'.PurchaseRequestTest::$purchase_request_id,[
            'action_type' => "twg",
            'id' => PurchaseRequestTest::$purchase_request_id,
            'technical_working_group_id' => Library::where('library_type','technical_working_group')->where('name','Information Technology')->first()->id,
            'type' => "twg",
            'updater' => "procurement",
        ]);
        $response->assertStatus(200);
    }

    public function test_approve_rejected_procurement()
    {
        $user = User::with('user_offices.office')->where('username','procurement')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->where('form_routable_id',PurchaseRequestTest::$purchase_request_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/approve');
        $response->assertStatus(200);
    }

    public function test_approve_from_procurement()
    {
        $user = User::with('user_offices.office')->where('username','twgict')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->where('form_routable_id',PurchaseRequestTest::$purchase_request_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/approve');
        $response->assertStatus(200);
    }

    public function test_update_from_procurement()
    {
        $user = User::with('user_offices.office')->where('username','procurement')->first();
        Passport::actingAs($user);
        $response = $this->put('/api/purchase-requests/'.PurchaseRequestTest::$purchase_request_id,[
            'purchase_request_type_id' => $this->faker->randomElement(Library::where('library_type','procurement_type')->get()->pluck('id')),
            'mode_of_procurement_id' => $this->faker->randomElement(Library::where('library_type','mode_of_procurement')->get()->pluck('id')),
            'updater' => 'procurement',
        ]);
        $response->assertStatus(200);
    }

    public function test_approve_from_twg()
    {
        $user = User::with('user_offices.office')->where('username','procurement')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->where('form_routable_id',PurchaseRequestTest::$purchase_request_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/approve');
        $response->assertStatus(200);
    }


    public function test_update_for_rejected()
    {
        $user = User::with('user_offices.office')->where('username','procurement')->first();
        Passport::actingAs($user);
        $response = $this->put('/api/purchase-requests/'.PurchaseRequestTest::$purchase_request_id,[
            'purchase_request_type_id' => $this->faker->randomElement(Library::where('library_type','procurement_type')->get()->pluck('id')),
            'mode_of_procurement_id' => $this->faker->randomElement(Library::where('library_type','mode_of_procurement')->get()->pluck('id')),
            'updater' => 'procurement',
        ]);
        $response->assertStatus(200);
    }

    public function test_approve_ppd_for_rejected()
    {
        $user = User::with('user_offices.office')->where('username','ppd')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->where('form_routable_id',PurchaseRequestTest::$purchase_request_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/approve');
        $response->assertStatus(200);
    }

    public function test_approve_bacs_for_rejected()
    {
        $user = User::with('user_offices.office')->where('username','bacs')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->where('form_routable_id',PurchaseRequestTest::$purchase_request_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/approve');
        $response->assertStatus(200);
    }


    public function test_update_for_oardo()
    {
        $user = User::with('user_offices.office')->where('username','ict')->first();
        Passport::actingAs($user);
        $purchase_request = PurchaseRequest::find(PurchaseRequestTest::$purchase_request_id);
        $response = $this->put('/api/purchase-requests/'.PurchaseRequestTest::$purchase_request_id,[
            'requested_by_id' => Library::where('library_type','user_signatory_name')->where('title','OARDO')->first()->id,
            'id' => $purchase_request->id,
            'end_user_id' => $purchase_request->end_user_id,
            'pr_date' => $purchase_request->pr_date,
            'purpose' => $purchase_request->purpose,
        ]);
        $response->assertStatus(200);
    }

    public function test_approve_oardo_for_rejected()
    {
        $user = User::with('user_offices.office')->where('username','oardo')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->where('form_routable_id',PurchaseRequestTest::$purchase_request_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/approve');
        $response->assertStatus(200);
    }

    public function test_approve_budget_for_rejected()
    {
        $user = User::with('user_offices.office')->where('username','budget')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->where('form_routable_id',PurchaseRequestTest::$purchase_request_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/approve');
        $response->assertStatus(200);
    }
    public function test_update_budget_for_rejected()
    {
        $user = User::with('user_offices.office')->where('username','budget')->first();
        Passport::actingAs($user);
        $response = $this->put('/api/purchase-requests/'.PurchaseRequestTest::$purchase_request_id,[
            'purchase_request_number' => "BUDRP-PR-".Carbon::now()->format('Y-m-').$this->faker->numberBetween(1,99999),
            'uacs_code' => $this->faker->numerify('uacs-####-####-###'),
            'charge_to' => $this->faker->name,
            'alloted_amount' => $this->faker->randomFloat(2, 0, 10000),
            'sa_or' => $this->faker->numerify('sa-####-####-###'),
            'updater' => 'budget',
            'fund_cluster' => $this->faker->numerify('fc-####-####-###'),
            'center_code' => $this->faker->numerify('rcc-####-####-###'),
            'purchase_request_number_last' => str_pad($this->faker->numberBetween(1,99999),5,"0",STR_PAD_LEFT),
        ]);
        $response->assertStatus(200);
    }

    public function test_approve_ord_for_rejected()
    {
        $user = User::with('user_offices.office')->where('username','ord')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->where('form_routable_id',PurchaseRequestTest::$purchase_request_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/approve');
        $response->assertStatus(200);
    }


}
