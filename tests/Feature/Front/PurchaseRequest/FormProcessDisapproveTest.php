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

class FormProcessDisapproveTest extends TestCase
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
    public function test_create_purchase_request()
    {
        $user = User::with('user_offices.office')->where('username','ict')->first();
        Passport::actingAs($user);
        $office = $user->user_offices;
        $response = $this->post('/api/purchase-requests',[
            'purpose' => $this->faker->text(200),
            'title' => $this->faker->text(200),
            'fund_cluster' => $this->faker->numerify('fc-####-####-###'),
            'center_code' => $this->faker->numerify('cc-####-####-###'),
            'pr_date' => Carbon::now(),
            'end_user_id' => Library::find($office[0]['office_id'])->id,
            'requested_by_id' => Library::where('library_type','user_signatory_name')->where('title','OARDA')->first()->id,
            'approved_by_id' => Library::where('library_type','user_signatory_name')->where('title','ORD')->first()->id,
            'uacs_code_id' => $this->faker->randomElement(Library::where('library_type','uacs_code')->get()->pluck('id')),
            'charge_to' => $this->faker->name,
            'alloted_amount' => $this->faker->randomFloat(2, 0, 1000000),
            'sa_or' => $this->faker->numerify('sa-####-####-###'),
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
                    'item_id' => $this->faker->randomElement(Item::get()->pluck('id')),
                    'is_ppmp' => true,
                ],
            ]
        ]);
        $purchase_request = $response->decodeResponseJson();
        FormProcessDisapproveTest::$purchase_request_id = $purchase_request['id'];
        $response->assertStatus(201);
    }


    public function test_approve_user()
    {
        $user = User::with('user_offices.office')->where('username','ict')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->where('form_routable_id', FormProcessDisapproveTest::$purchase_request_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/approve');
        $response->assertStatus(200);
    }

    public function test_reject_procurement_user()
    {
        $user = User::with('user_offices.office')->where('username','procurement')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->where('form_routable_id',FormProcessDisapproveTest::$purchase_request_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/reject',[
            'remarks' => "With Issues procurement",
        ]);
        $response->assertStatus(200);
    }

    public function test_resolve_user_procurement()
    {
        $user = User::with('user_offices.office')->where('username','ict')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','with_issues')->where('form_routable_id',FormProcessDisapproveTest::$purchase_request_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/approve',[
            'remarks' => "Resolve Issues procurement",
        ]);
        $response->assertStatus(200);
    }

    

    public function test_approve_procurement()
    {
        $user = User::with('user_offices.office')->where('username','procurement')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->where('form_routable_id',FormProcessDisapproveTest::$purchase_request_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/approve');
        $response->assertStatus(200);
    }

    public function test_update_procurement()
    {
        $user = User::with('user_offices.office')->where('username','procurement')->first();
        Passport::actingAs($user);
        $response = $this->put('/api/purchase-requests/'.FormProcessDisapproveTest::$purchase_request_id,[
            'procurement_type_id' => $this->faker->randomElement(Library::where('library_type','procurement_type')->get()->pluck('id')),
            'procurement_type_category' => $this->faker->randomElement(Library::where('library_type','procurement_type_category')->get()->pluck('id')),
            'mode_of_procurement_id' => $this->faker->randomElement(Library::where('library_type','mode_of_procurement')->get()->pluck('id')),
            'updater' => 'procurement',
        ]);
        $response->assertStatus(200);
    }

    public function test_reject_ppd_user()
    {
        $user = User::with('user_offices.office')->where('username','ppd')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->where('form_routable_id',FormProcessDisapproveTest::$purchase_request_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/reject',[
            'remarks' => "With Issues ppd",
        ]);
        $response->assertStatus(200);
    }

    public function test_resolve_user_ppd()
    {
        $user = User::with('user_offices.office')->where('username','ict')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','with_issues')->where('form_routable_id',FormProcessDisapproveTest::$purchase_request_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/approve',[
            'remarks' => "Resolve Issues ppd",
        ]);
        $response->assertStatus(200);
    }

    public function test_approve_ppd()
    {
        $user = User::with('user_offices.office')->where('username','ppd')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->where('form_routable_id',FormProcessDisapproveTest::$purchase_request_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/approve');
        $response->assertStatus(200);
    }

    public function test_reject_bacs_user()
    {
        $user = User::with('user_offices.office')->where('username','bacs')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->where('form_routable_id',FormProcessDisapproveTest::$purchase_request_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/reject',[
            'remarks' => "With Issues bacs",
        ]);
        $response->assertStatus(200);
    }

    public function test_resolve_user_bacs()
    {
        $user = User::with('user_offices.office')->where('username','ict')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','with_issues')->where('form_routable_id',FormProcessDisapproveTest::$purchase_request_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/approve',[
            'remarks' => "Resolve Issues",
        ]);
        $response->assertStatus(200);
    }

    public function test_approve_bacs()
    {
        $user = User::with('user_offices.office')->where('username','bacs')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->where('form_routable_id',FormProcessDisapproveTest::$purchase_request_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/approve');
        $response->assertStatus(200);
    }

    public function test_reject_oarda_user()
    {
        $user = User::with('user_offices.office')->where('username','oarda')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->where('form_routable_id',FormProcessDisapproveTest::$purchase_request_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/reject',[
            'remarks' => "With Issues oarda",
        ]);
        $response->assertStatus(200);
    }

    public function test_resolve_user_oarda()
    {
        $user = User::with('user_offices.office')->where('username','ict')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','with_issues')->where('form_routable_id',FormProcessDisapproveTest::$purchase_request_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/approve',[
            'remarks' => "Resolve Issues oarda",
        ]);
        $response->assertStatus(200);
    }

    public function test_approve_oarda()
    {
        $user = User::with('user_offices.office')->where('username','oarda')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->where('form_routable_id',FormProcessDisapproveTest::$purchase_request_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/approve');
        $response->assertStatus(200);
    }

    public function test_reject_budget_user()
    {
        $user = User::with('user_offices.office')->where('username','budget')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->where('form_routable_id',FormProcessDisapproveTest::$purchase_request_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/reject',[
            'remarks' => "With Issues budget",
        ]);
        $response->assertStatus(200);
    }

    public function test_resolve_user_budget()
    {
        $user = User::with('user_offices.office')->where('username','ict')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','with_issues')->where('form_routable_id',FormProcessDisapproveTest::$purchase_request_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/approve',[
            'remarks' => "Resolve Issues budget",
        ]);
        $response->assertStatus(200);
    }

    public function test_approve_budget()
    {
        $user = User::with('user_offices.office')->where('username','budget')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->where('form_routable_id',FormProcessDisapproveTest::$purchase_request_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/approve');
        $response->assertStatus(200);
    }

    public function test_update_budget()
    {
        $user = User::with('user_offices.office')->where('username','budget')->first();
        Passport::actingAs($user);
        $response = $this->put('/api/purchase-requests/'.FormProcessDisapproveTest::$purchase_request_id,[
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

    public function test_reject_ord_user()
    {
        $user = User::with('user_offices.office')->where('username','ord')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->where('form_routable_id',FormProcessDisapproveTest::$purchase_request_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/reject',[
            'remarks' => "With Issues ord",
        ]);
        $response->assertStatus(200);
    }

    public function test_resolve_user_ord()
    {
        $user = User::with('user_offices.office')->where('username','ict')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','with_issues')->where('form_routable_id',FormProcessDisapproveTest::$purchase_request_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/approve',[
            'remarks' => "Resolve Issues ord",
        ]);
        $response->assertStatus(200);
    }

    public function test_approve_ord()
    {
        $user = User::with('user_offices.office')->where('username','ord')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->where('form_routable_id',FormProcessDisapproveTest::$purchase_request_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/approve');
        $response->assertStatus(200);
    }
}
