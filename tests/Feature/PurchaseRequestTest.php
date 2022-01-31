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
    
    public function test_create_purchase_request()
    {
        $user = User::with('signatories.office')->where('username','ict')->first();
        Passport::actingAs($user);
        $office = $user->signatories;
        $response = $this->post('/api/purchase-requests',[
            'pr_date' => Carbon::now(),
            'end_user_id' => Library::find($office[0]['office_id'])->id,
            'purpose' => "test",
            'requested_by_id' => Signatory::where('signatory_type','OARDA')->first()->id,
            'approved_by_id' => Signatory::where('signatory_type','ORD')->first()->id,
            'items' => [
                [
                    'item_name' => "Item Test 1",
                    'unit_of_measure_id' => 1,
                    'quantity' => 1,
                    'unit_cost' => 1,
                    'item_id' => 1,
                ],
                [
                    'item_name' => "Item Test 2",
                    'unit_of_measure_id' => 1,
                    'quantity' => 1,
                    'unit_cost' => 1,
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
            'purchase_request_number' => "11223344",
        ]);
        $response->assertStatus(200);
    }

    public function test_update_purchase_request_items()
    {
        $user = User::with('signatories.office')->where('username','ict')->first();
        Passport::actingAs($user);
        $item_1 = PurchaseRequestItem::where('purchase_request_id', PurchaseRequestTest::$purchase_request_id)->first()->toArray();
        $item_1['quantity'] = 2;
        $item_1['unit_cost'] = 2;
        $response = $this->put('/api/purchase-requests/'.PurchaseRequestTest::$purchase_request_id,[
            'items' => [
                $item_1,
                [
                    'item_name' => "New Item Test 1",
                    'unit_of_measure_id' => 1,
                    'quantity' => 3,
                    'unit_cost' => 3,
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
            'remarks' => "Test Approve",
        ]);
        $response->assertStatus(200);
    }

    public function test_approve_purchase_request_ppd()
    {
        $user = User::with('signatories.office')->where('username','ppd')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->first();
        $response = $this->post('api/form/routes/requests/pending/'.$form_route->id.'/approve',[
            'remarks' => "Test Approve",
        ]);
        $response->assertStatus(200);
    }

    public function test_approve_purchase_request_bacs()
    {
        $user = User::with('signatories.office')->where('username','bacs')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->first();
        $response = $this->post('api/form/routes/requests/pending/'.$form_route->id.'/approve',[
            'remarks' => "Test Approve",
        ]);
        $response->assertStatus(200);
    }

    public function test_approve_purchase_request_oarda()
    {
        $user = User::with('signatories.office')->where('username','oarda')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->first();
        $response = $this->post('api/form/routes/requests/pending/'.$form_route->id.'/approve',[
            'remarks' => "Test Approve",
        ]);
        $response->assertStatus(200);
    }

    public function test_approve_purchase_request_budget()
    {
        $user = User::with('signatories.office')->where('username','budget')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->first();
        $response = $this->post('api/form/routes/requests/pending/'.$form_route->id.'/approve',[
            'remarks' => "Test Approve",
        ]);
        $response->assertStatus(200);
    }

    public function test_approve_purchase_request_ord()
    {
        $user = User::with('signatories.office')->where('username','ord')->first();
        Passport::actingAs($user);
        $form_route = FormRoute::where('status','pending')->first();
        $response = $this->post('api/form/routes/requests/pending/'.$form_route->id.'/approve',[
            'remarks' => "Test Approve",
        ]);
        $response->assertStatus(200);
    }


}
