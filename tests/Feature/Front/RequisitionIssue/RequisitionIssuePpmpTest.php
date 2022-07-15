<?php

namespace Tests\Feature\Front\RequisitionIssue;

use App\Models\FormRoute;
use App\Models\Item;
use App\Models\ItemSupply;
use App\Models\Library;
use App\Models\ProcurementManagement;
use App\Models\ProcurementManagementItem;
use App\Models\ProcurementPlanItem;
use App\Models\RequisitionIssue;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class RequisitionIssuePpmpTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public static $requisition_issue_id;
    public $faker;
    public function __construct() {
        parent::__construct();
        $this->faker = \Faker\Factory::create("en_PH");
    }
    public function test_create()
    {
        $user = User::with('user_offices.office', 'user_information')->where('username','ict')->first();
        Passport::actingAs($user);
        $office = $user->user_offices;
        $items = [];
        $ppmp = ProcurementManagement::with('items')->where('end_user_id', $office[0]['office_id'])->first();
        for ($i=0; $i < 5; $i++) {
            $procurement_plan_item_id = $this->faker->randomElement($ppmp->items()->pluck('procurement_plan_item_id'));
            $procurement_management_item = $ppmp->items($procurement_plan_item_id)->first();
            $procurement_plan_item = ProcurementPlanItem::find($procurement_plan_item_id);
            $items[] = [
                'procurement_plan_item_id' => $procurement_plan_item->id,
                'unit_of_measure_id' => $procurement_plan_item->unit_of_measure_id,
                'description' => $procurement_plan_item->description,
                'item_id' => $procurement_plan_item->item_id,
                'request_quantity' => $this->faker->numberBetween(0, $procurement_management_item->total_quantity),
                'max_quantity' => $procurement_management_item->total_quantity,
            ];
        }

        $ppd_office = Library::where('library_type','user_section')->where('title','PPD')->first();
        $property_office = Library::where('library_type','user_section')->where('title','PSAMS')->first();

        $requested_by = Library::where('library_type', 'user_section_signatory')->where('parent_id', $ppd_office->id)->first();
        $approved_by = Library::where('library_type', 'user_section_signatory')->where('parent_id', $property_office->id)->first();

        $request = [
            'title' => $this->faker->text(200),
            'fund_cluster' => $this->faker->text(200),
            'center_code' => $this->faker->text(200),
            'purpose' => $this->faker->text(200),
            'recommendation' => $this->faker->text(200),
            'ris_date' => Carbon::now(),
            'from_ppmp' => 1,
            'end_user_id' => $office[0]['office_id'],
            'requested_by_id' => $requested_by->id,
            'requested_by_name' => $requested_by->name,
            'requested_by_designation' => $requested_by->title,
            'approved_by_id' => $approved_by->id,
            'approved_by_name' => $approved_by->name,
            'approved_by_designation' => $approved_by->title,
            'received_by_name' => $user->user_information->fullname,
            'received_by_designation' => $this->faker->jobTitle,
            'items' => $items,
        ];
        $response = $this->post('/api/requisition-issues', $request);
        $requisition_issue = $response->decodeResponseJson();
        RequisitionIssuePpmpTest::$requisition_issue_id = $requisition_issue['id'];
        $response->assertStatus(201);
    }

    public function test_ict()
    {
        $user = User::with('user_offices.office')->where('username','ict')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->where('form_routable_id', RequisitionIssuePpmpTest::$requisition_issue_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/approve');
        $response->assertStatus(200);
    }
    public function test_ppd()
    {
        $user = User::with('user_offices.office')->where('username','ppd')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->where('form_routable_id', RequisitionIssuePpmpTest::$requisition_issue_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/approve');
        $response->assertStatus(200);
    }
    public function test_approve()
    {
        $user = User::with('user_offices.office')->where('username','property')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->where('form_routable_id', RequisitionIssuePpmpTest::$requisition_issue_id)->first();
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/approve');
        $response->assertStatus(200);
    }

    public function test_issue()
    {
        $user = User::with('user_offices.office')->where('username','property')->first();
        Passport::actingAs($user);
        $requisition_issue = RequisitionIssue::with('items')->whereId(RequisitionIssuePpmpTest::$requisition_issue_id)->first();
        $items = $requisition_issue->items->toArray();
        $form_route = FormRoute::where('status','pending')->where('form_routable_id', RequisitionIssuePpmpTest::$requisition_issue_id)->first();
        $quan = [];
        $quan[] = $this->faker->numberBetween(1, 10);
        $quan[] = $this->faker->numberBetween(1, 10);
        for ($i=0; $i < count($items); $i++) {
            if(isset($quan[$i])){
                $items[$i]['issue_quantity'] = $quan[$i];
                $items[$i]['has_issued_item'] = 1;
            }
            $items[$i]['is_pr_recommended'] = $this->faker->boolean;
            $items[$i]['has_stock'] = $this->faker->boolean;
        }
        $response = $this->post('api/forms/routes/requests/pending/'.$form_route->id.'/approve', [
            'issued_items' => [
                [
                    'quantity' => $quan[0],
                    'item_supply_id' => $this->faker->randomElement(ItemSupply::limit(50)->pluck('id')),
                ],
                [
                    'quantity' => $quan[1],
                    'item_supply_id'=> $this->faker->randomElement(ItemSupply::limit(50)->pluck('id')),
                ],
            ],
            'items' => $items,
        ]);
        $response->assertStatus(200);
    }
}
