<?php

namespace App\Http\Controllers;

use App\Repositories\ActivityLogBatchRepository;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth:api');
        // $this->middleware('role_or_permission:super-admin|admin|purchase.requests.create|purchase.requests.all', ['only' => ['store']]);
        // $this->middleware('role_or_permission:super-admin|admin|purchase.requests.update|purchase.requests.all',   ['only' => ['update']]);
        // $this->middleware('role_or_permission:super-admin|admin|activitylogs.view|activitylogs.all',   ['only' => ['show', 'index']]);
    }
    public function index(Request $request)
    {
        return (new ActivityLogBatchRepository())->attach('logs')->getAll();
    }

    public function purchaseRequest(Request $request, $id)
    {

    }

    public function purchaseRequestItem(Request $request, $id)
    {

    }

    public function bacTask(Request $request, $purchase_request)
    {

    }

    public function formUploads(Request $request, $type, $id)
    {

    }

    public function procurementPlan(Request $request, $id)
    {

    }

    public function procurementPlanItem(Request $request, $id)
    {

    }

    public function requisitionIssue(Request $request, $id)
    {
        return (new ActivityLogBatchRepository())->attach('subject, logs')->getLogs($id);
    }

    public function requisitionIssueItem(Request $request, $id)
    {
        
    }
}
