<?php

namespace Tests\Feature\Front\PurchaseRequest\Divisions;

use App\Models\FormRoute;
use App\Models\Item;
use App\Models\Library;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class HrmddFormProcessApproveTest extends TestCase
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
        $user = User::with('user_offices.office')->where('username','pas')->first();
        Passport::actingAs($user);
        $office = $user->user_offices;
        $user_office = Library::with('children')->where('library_type', 'user_division')->where('title','HRMDD')->first();
        $user_office_id = $this->faker->randomElement($user_office->children()->pluck('id'));
        $response = $this->post('/api/purchase-requests',[
            'title' => $this->faker->text(200),
            'purpose' => $this->faker->text(200),
            'pr_date' => $this->faker->dateTimeThisYear(date('Y-m-d', strtotime('Dec 31'))),
            // 'end_user_id' => Library::find($office[0]['office_id'])->id,
            'end_user_id' => $user_office_id,
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
        HrmddFormProcessApproveTest::$purchase_request_id = $purchase_request['id'];
        $response->assertStatus(201);
    }

    public function test_approve_user()
    {
        $user = User::with('user_offices.office')->where('username','pas')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->where('form_routable_id',HrmddFormProcessApproveTest::$purchase_request_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/approve');
        $response->assertStatus(200);
    }

    public function test_approve_procurement()
    {
        $user = User::with('user_offices.office')->where('username','procurement')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->where('form_routable_id',HrmddFormProcessApproveTest::$purchase_request_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/approve', [
            'account_id' => $this->faker->randomElement(Library::where('library_type','account')->get()->pluck('id')),
            'account_classification' => $this->faker->randomElement(Library::where('library_type','account_classification')->get()->pluck('id')),
            'mode_of_procurement_id' => $this->faker->randomElement(Library::where('library_type','mode_of_procurement')->get()->pluck('id')),
            'updater' => 'procurement',
        ]);
        $response->assertStatus(200);
    }

    public function test_approve_hrmdd()
    {
        $user = User::with('user_offices.office')->where('username','hrmdd')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->where('form_routable_id',HrmddFormProcessApproveTest::$purchase_request_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/approve');
        $response->assertStatus(200);
    }

    public function test_approve_bacs()
    {
        $user = User::with('user_offices.office')->where('username','bacs')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->where('form_routable_id',HrmddFormProcessApproveTest::$purchase_request_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/approve');
        $response->assertStatus(200);
    }

    public function test_approve_oarda()
    {
        $user = User::with('user_offices.office')->where('username','oarda')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->where('form_routable_id',HrmddFormProcessApproveTest::$purchase_request_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/approve');
        $response->assertStatus(200);
    }

    public function test_approve_budget()
    {
        $user = User::with('user_offices.office')->where('username','budget')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->where('form_routable_id',HrmddFormProcessApproveTest::$purchase_request_id)->first();
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
        $form_route = FormRoute::where('status','pending')->where('form_routable_id',HrmddFormProcessApproveTest::$purchase_request_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/approve');
        $response->assertStatus(200);
    }
}
