<?php

namespace Tests\Feature\Front\ProcurementPlan;

use App\Models\FormRoute;
use App\Models\Item;
use App\Models\Library;
use App\Models\ProcurementPlan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class ProcurementPlanTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public static $procurement_plan_id;
    public $faker;
    public function __construct() {
        parent::__construct();
        $this->faker = \Faker\Factory::create("en_PH");
    }
    public function test_create()
    {
        $cse = Library::where('library_type','item_type')->where('name', ppmpCse())->first();
        $nonCse = Library::where('library_type','item_type')->where('name', ppmpNonCse())->first();
        $user_id = $this->faker->randomElement(User::get()->pluck('id'));
        $user = User::with('user_offices.office')->where('id',$user_id)->first();
        $user = User::with('user_offices.office')->where('username','ict')->first();
        Passport::actingAs($user);
        $office = $user->user_offices;
        $ppmp_count = ProcurementPlan::where('end_user_id', $office[0]['office_id'])->count();
        if($ppmp_count == 0){
            $procurement_plan_type = Library::where('library_type','procurement_plan_type')->where('name', ppmpValue())->first();
        }else{
            $procurement_plan_type = Library::where('library_type','procurement_plan_type')->where('name', supplementalPpmpValue())->first();
        }
        $request = [
            'end_user_id' => Library::find($office[0]['office_id'])->id,
            'item_type_id' => $cse->id,
            'procurement_plan_type_id' => $procurement_plan_type->id,
            'prepared_by_name' => $this->faker->name,
            'prepared_by_position' => $this->faker->jobTitle,
            'certified_by_name' => $this->faker->name,
            'certified_by_position' => $this->faker->jobTitle,
            'approved_by_name' => $this->faker->name,
            'approved_by_position' => $this->faker->jobTitle,
            'ppmp_date' => Carbon::now(),
            'calendar_year' => Carbon::now()->format("Y"),
            'title' => $this->faker->text(200),
            'approvedBy' => "OARDA",
            'itemsA' => [
                [
                    'mon1' => $this->faker->numberBetween(0, 100),
                    'mon2' => $this->faker->numberBetween(0, 100),
                    'mon3' => $this->faker->numberBetween(0, 100),
                    'mon4' => $this->faker->numberBetween(0, 100),
                    'mon5' => $this->faker->numberBetween(0, 100),
                    'mon6' => $this->faker->numberBetween(0, 100),
                    'mon7' => $this->faker->numberBetween(0, 100),
                    'mon8' => $this->faker->numberBetween(0, 100),
                    'mon9' => $this->faker->numberBetween(0, 100),
                    'mon10' => $this->faker->numberBetween(0, 100),
                    'mon11' => $this->faker->numberBetween(0, 100),
                    'mon12' => $this->faker->numberBetween(0, 100),
                    'item_id' => $this->faker->randomElement(Item::where('item_type_id', $cse->id)->pluck('id')),
                    'total_quantity' => $this->faker->numberBetween(0, 100),
                    'price' => $this->faker->randomFloat(2, 0, 10000),
                ],
                [
                    'mon1' => $this->faker->numberBetween(0, 100),
                    'mon2' => $this->faker->numberBetween(0, 100),
                    'mon3' => $this->faker->numberBetween(0, 100),
                    'mon4' => $this->faker->numberBetween(0, 100),
                    'mon5' => $this->faker->numberBetween(0, 100),
                    'mon6' => $this->faker->numberBetween(0, 100),
                    'mon7' => $this->faker->numberBetween(0, 100),
                    'mon8' => $this->faker->numberBetween(0, 100),
                    'mon9' => $this->faker->numberBetween(0, 100),
                    'mon10' => $this->faker->numberBetween(0, 100),
                    'mon11' => $this->faker->numberBetween(0, 100),
                    'mon12' => $this->faker->numberBetween(0, 100),
                    'item_id' => $this->faker->randomElement(Item::where('item_type_id', $cse->id)->pluck('id')),
                    'total_quantity' => $this->faker->numberBetween(0, 100),
                    'price' => $this->faker->randomFloat(2, 0, 10000),
                ],
                [
                    'mon1' => $this->faker->numberBetween(0, 100),
                    'mon2' => $this->faker->numberBetween(0, 100),
                    'mon3' => $this->faker->numberBetween(0, 100),
                    'mon4' => $this->faker->numberBetween(0, 100),
                    'mon5' => $this->faker->numberBetween(0, 100),
                    'mon6' => $this->faker->numberBetween(0, 100),
                    'mon7' => $this->faker->numberBetween(0, 100),
                    'mon8' => $this->faker->numberBetween(0, 100),
                    'mon9' => $this->faker->numberBetween(0, 100),
                    'mon10' => $this->faker->numberBetween(0, 100),
                    'mon11' => $this->faker->numberBetween(0, 100),
                    'mon12' => $this->faker->numberBetween(0, 100),
                    'item_id' => $this->faker->randomElement(Item::where('item_type_id', $cse->id)->pluck('id')),
                    'total_quantity' => $this->faker->numberBetween(0, 100),
                    'price' => $this->faker->randomFloat(2, 0, 10000),
                ],
            ],
            'itemsB' => [
                [
                    'mon1' => $this->faker->numberBetween(0, 100),
                    'mon2' => $this->faker->numberBetween(0, 100),
                    'mon3' => $this->faker->numberBetween(0, 100),
                    'mon4' => $this->faker->numberBetween(0, 100),
                    'mon5' => $this->faker->numberBetween(0, 100),
                    'mon6' => $this->faker->numberBetween(0, 100),
                    'mon7' => $this->faker->numberBetween(0, 100),
                    'mon8' => $this->faker->numberBetween(0, 100),
                    'mon9' => $this->faker->numberBetween(0, 100),
                    'mon10' => $this->faker->numberBetween(0, 100),
                    'mon11' => $this->faker->numberBetween(0, 100),
                    'mon12' => $this->faker->numberBetween(0, 100),
                    'item_id' => $this->faker->randomElement(Item::where('item_type_id', $nonCse->id)->pluck('id')),
                    'total_quantity' => $this->faker->numberBetween(0, 100),
                    'price' => $this->faker->randomFloat(2, 0, 10000),
                ],
            ],
            'itemsB' => [
                [
                    'mon1' => $this->faker->numberBetween(0, 100),
                    'mon2' => $this->faker->numberBetween(0, 100),
                    'mon3' => $this->faker->numberBetween(0, 100),
                    'mon4' => $this->faker->numberBetween(0, 100),
                    'mon5' => $this->faker->numberBetween(0, 100),
                    'mon6' => $this->faker->numberBetween(0, 100),
                    'mon7' => $this->faker->numberBetween(0, 100),
                    'mon8' => $this->faker->numberBetween(0, 100),
                    'mon9' => $this->faker->numberBetween(0, 100),
                    'mon10' => $this->faker->numberBetween(0, 100),
                    'mon11' => $this->faker->numberBetween(0, 100),
                    'mon12' => $this->faker->numberBetween(0, 100),
                    'item_id' => $this->faker->randomElement(Item::where('item_type_id', $nonCse->id)->pluck('id')),
                    'total_quantity' => $this->faker->numberBetween(0, 100),
                    'price' => $this->faker->randomFloat(2, 0, 10000),
                ],
            ],
        ];
        $response = $this->post('/api/procurement-plans', $request);
        $procurement_plan = $response->decodeResponseJson();
        ProcurementPlanTest::$procurement_plan_id = $procurement_plan['id'];
        $response->assertStatus(201);
    }

    public function test_ict()
    {
        $user = User::with('user_offices.office')->where('username','ict')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->where('form_routable_id',ProcurementPlanTest::$procurement_plan_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/approve');
        $response->assertStatus(200);
    }
    public function test_budget()
    {
        $user = User::with('user_offices.office')->where('username','ict')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->where('form_routable_id',ProcurementPlanTest::$procurement_plan_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/approve');
        $response->assertStatus(200);
    }
    // public function test_oard()
    // {
    //     $user = User::with('user_offices.office')->where('username','ict')->first();
    //     Passport::actingAs($user);
    //     $form_route = FormRoute::where('status','pending')->where('form_routable_id',ProcurementPlanTest::$procurement_plan_id)->first();
    //     $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/approve');
    //     $response->assertStatus(200);
    // }
}
