<?php

namespace Tests\Feature\Front\PurchaseRequest;

use App\Models\FormRoute;
use App\Models\Item;
use App\Models\Library;
use App\Models\PurchaseRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class FormProcessApproveTwgTest extends TestCase
{
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
            'pr_date' => Carbon::now(),
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
        FormProcessApproveTwgTest::$purchase_request_id = $purchase_request['id'];
        $response->assertStatus(201);
    }

    public function test_ict()
    {
        $user = User::with('user_offices.office')->where('username','ict')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->where('form_routable_id',FormProcessApproveTwgTest::$purchase_request_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/approve');
        $response->assertStatus(200);
    }

    public function test_procurement_to_twg()
    {
        $user = User::with('user_offices.office')->where('username','procurement')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->where('form_routable_id',FormProcessApproveTwgTest::$purchase_request_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/approve', [
            'type' => "twg",
            'id' => FormProcessApproveTwgTest::$purchase_request_id,
            'technical_working_group_id' => Library::where('library_type','technical_working_group')->where('name','Information Technology')->first()->id,
            'updater' => "procurement",
        ]);
        $response->assertStatus(200);
    }


    public function test_twg_procurement()
    {
        $user = User::with('user_offices.office')->where('username','twgict')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->where('form_routable_id',FormProcessApproveTwgTest::$purchase_request_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/approve');
        $response->assertStatus(200);
    }

    public function test_procurement()
    {
        $user = User::with('user_offices.office')->where('username','procurement')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->where('form_routable_id',FormProcessApproveTwgTest::$purchase_request_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/approve', [
            'type' => "approve",
            'account_id' => $this->faker->randomElement(Library::where('library_type','account')->get()->pluck('id')),
            'account_classification' => $this->faker->randomElement(Library::where('library_type','account_classification')->get()->pluck('id')),
            'mode_of_procurement_id' => $this->faker->randomElement(Library::where('library_type','mode_of_procurement')->get()->pluck('id')),
            'updater' => 'procurement',
            'type' => 'approve',
        ]);
        $response->assertStatus(200);
    }


    public function test_approve_ppd()
    {
        $user = User::with('user_offices.office')->where('username','ppd')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->where('form_routable_id',FormProcessApproveTwgTest::$purchase_request_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/approve');
        $response->assertStatus(200);
    }

    public function test_approve_bacs()
    {
        $user = User::with('user_offices.office')->where('username','bacs')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->where('form_routable_id',FormProcessApproveTwgTest::$purchase_request_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/approve');
        $response->assertStatus(200);
    }

    public function test_update_for_oardo()
    {
        $user = User::with('user_offices.office')->where('username','ict')->first();
        Passport::actingAs($user);
        $purchase_request = PurchaseRequest::find(FormProcessApproveTwgTest::$purchase_request_id);
        $response = $this->put('/api/purchase-requests/'.FormProcessApproveTwgTest::$purchase_request_id,[
            'requested_by_id' => Library::where('library_type','user_signatory_name')->where('title','OARDO')->first()->id,
            'id' => $purchase_request->id,
            'end_user_id' => $purchase_request->end_user_id,
            'pr_date' => $purchase_request->pr_date,
            'purpose' => $purchase_request->purpose,
            'title' => $purchase_request->title,
        ]);
        $response->assertStatus(200);
    }

    public function test_approve_oardo_for_rejected()
    {
        $user = User::with('user_offices.office')->where('username','oardo')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->where('form_routable_id',FormProcessApproveTwgTest::$purchase_request_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/approve');
        $response->assertStatus(200);
    }

    public function test_approve_budget()
    {
        $user = User::with('user_offices.office')->where('username','budget')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->where('form_routable_id',FormProcessApproveTwgTest::$purchase_request_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/approve', [
            'purchase_request_number' => "BUDRP-PR-".Carbon::now()->format('Y-m-').$this->faker->numberBetween(1,99999),
            'uacs_code_id' => $this->faker->randomElement(Library::where('library_type','uacs_code')->get()->pluck('id')),
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
        $form_route = FormRoute::where('status','pending')->where('form_routable_id',FormProcessApproveTwgTest::$purchase_request_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/approve');
        $response->assertStatus(200);
    }
}
