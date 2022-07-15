<?php

namespace Tests\Feature;

use App\Models\FormRoute;
use App\Models\Item;
use App\Models\Library;
use App\Models\PurchaseRequest;
use App\Models\PurchaseRequestItem;
use App\Models\RequisitionIssue;
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
        $requested_office = Library::where('library_type','user_section')->where('title','OARDA')->first();
        $requested_by = Library::where('library_type','user_section_signatory')->where('parent_id', $requested_office->id)->first();
        $approved_office = Library::where('library_type','user_section')->where('title','ORD')->first();
        $approved_by = Library::where('library_type','user_section_signatory')->where('parent_id', $approved_office->id)->first();


        $requisition_issue = RequisitionIssue::with('items')->where('status', 'issued')->first();

        $requisition_issue_items = $requisition_issue->items()->where('is_pr_recommended', 0)->get();

        $items = [];
        foreach ($requisition_issue_items as $key => $requisition_issue_item) {
            $items[$key]['item_name'] = $requisition_issue_item->description;
            $items[$key]['unit_of_measure_id'] = $requisition_issue_item->unit_of_measure_id;
            $items[$key]['quantity'] = $this->faker->numberBetween(1, 100);
            $items[$key]['unit_cost'] = $this->faker->randomFloat(2, 0, 10000);
            $items[$key]['item_id'] = $requisition_issue_item->item_id;
            $items[$key]['requisition_issue_item_id'] = $requisition_issue_item->id;
        }

        // dd($items);


        $user = User::with('user_offices.office')->where('username','ict')->first();
        Passport::actingAs($user);
        $office = $user->user_offices;
        $response = $this->post('/api/purchase-requests',[
            'title' => $this->faker->text(200),
            'purpose' => $this->faker->text(200),
            'requisition_issue_id' => $requisition_issue->id,
            'requisition_issue_file' => $requisition_issue->uuid,
            // 'pr_date' => Carbon::now(),
            'pr_date' => $this->faker->dateTimeThisYear(date('Y-m-d', strtotime('Dec 31'))),
            'end_user_id' => $office[0]['office_id'],
            'requested_by_id' => $requested_by->id,
            'requested_by_name' => $requested_by->name,
            'requested_by_designation' => $requested_by->title,
            'approved_by_id' => $approved_by->id,
            'approved_by_name' => $approved_by->name,
            'approved_by_designation' => $approved_by->title,
            'items' => $items
        ]);
        $purchase_request = $response->decodeResponseJson();
        PurchaseRequestTest::$purchase_request_id = $purchase_request['id'];
        $response->assertStatus(201);
    }

    public function test_update_items()
    {   
        $requested_office = Library::where('library_type','user_section')->where('title','OARDA')->first();
        $requested_by = Library::where('library_type','user_section_signatory')->where('parent_id', $requested_office->id)->first();
        $approved_office = Library::where('library_type','user_section')->where('title','ORD')->first();
        $approved_by = Library::where('library_type','user_section_signatory')->where('parent_id', $approved_office->id)->first();

        $user = User::with('user_offices.office')->where('username','ict')->first();
        Passport::actingAs($user);
        $purchase_request = PurchaseRequest::find(PurchaseRequestTest::$purchase_request_id)->toArray();

        $requisition_issue = RequisitionIssue::with('items')->where('id', $purchase_request['requisition_issue_id'])->first();
        $requisition_issue_items = $requisition_issue->items()->where('is_pr_recommended', 1)->get();

        $items = [];
        foreach ($requisition_issue_items as $key => $requisition_issue_item) {
            $items[$key]['item_name'] = $requisition_issue_item->description;
            $items[$key]['unit_of_measure_id'] = $requisition_issue_item->unit_of_measure_id;
            $items[$key]['quantity'] = $requisition_issue_item->request_quantity - $requisition_issue_item->issue_quantity;
            $items[$key]['unit_cost'] = $this->faker->randomFloat(2, 0, 10000);
            $items[$key]['item_id'] = $requisition_issue_item->item_id;
            $items[$key]['requisition_issue_item_id'] = $requisition_issue_item->id;
        }


        $response = $this->put('/api/purchase-requests/'.PurchaseRequestTest::$purchase_request_id,[
            'end_user_id' => $purchase_request['end_user_id'],
            'pr_date' => $purchase_request['pr_date'],
            'purpose' => $purchase_request['purpose'],
            'title' => $purchase_request['title'],
            'id' => $purchase_request['id'],
            'requested_by_id' => $requested_by->id,
            'requested_by_name' => $requested_by->name,
            'requested_by_designation' => $requested_by->title,
            'approved_by_id' => $approved_by->id,
            'approved_by_name' => $approved_by->name,
            'approved_by_designation' => $approved_by->title,
            'items' => $items
        ]);
        $response->assertStatus(200);
    }
}
