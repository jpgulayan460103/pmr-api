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
        $purchase_request = PurchaseRequest::where('status', 'pending')->first();
        FormProcessApproveTwgTest::$purchase_request_id = $purchase_request->id;
        // $response->assertStatus(201);
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

        $requested_office = Library::where('library_type','user_section')->where('title','OARDO')->first();
        $requested_by = Library::where('library_type','user_section_signatory')->where('parent_id', $requested_office->id)->first();
        $approved_office = Library::where('library_type','user_section')->where('title','ORD')->first();
        $approved_by = Library::where('library_type','user_section_signatory')->where('parent_id', $approved_office->id)->first();


        $user = User::with('user_offices.office')->where('username','ict')->first();
        Passport::actingAs($user);
        $purchase_request = PurchaseRequest::find(FormProcessApproveTwgTest::$purchase_request_id);
        $response = $this->put('/api/purchase-requests/'.FormProcessApproveTwgTest::$purchase_request_id,[
            'requested_by_id' => $requested_by->id,
            'requested_by_name' => $requested_by->name,
            'requested_by_designation' => $requested_by->title,
            'approved_by_id' => $approved_by->id,
            'approved_by_name' => $approved_by->name,
            'approved_by_designation' => $approved_by->title,
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
            'pr_number' => "BUDRP-PR-".Carbon::now()->format('Y-m-').$this->faker->numberBetween(1,99999),
            'uacs_code_id' => $this->faker->randomElement(Library::where('library_type','uacs_code')->get()->pluck('id')),
            'charge_to' => $this->faker->name,
            'alloted_amount' => $this->faker->randomFloat(2, 0, 10000),
            'sa_or' => $this->faker->numerify('sa-####-####-###'),
            'updater' => 'budget',
            'fund_cluster' => $this->faker->numerify('fc-####-####-###'),
            'center_code' => $this->faker->numerify('rcc-####-####-###'),
            'pr_number_last' => str_pad($this->faker->numberBetween(1,99999),5,"0",STR_PAD_LEFT),
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
