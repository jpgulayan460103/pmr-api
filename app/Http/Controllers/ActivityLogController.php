<?php

namespace App\Http\Controllers;

use App\Repositories\ActivityLogBatchRepository;
use App\Transformers\ActivityLogBatchTransformer;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index(Request $request)
    {
        return (new ActivityLogBatchRepository())->attach('logs')->getAll();
    }

    public function purchaseRequest(Request $request, $id)
    {
        $logs = (new ActivityLogBatchRepository())->getLogs($id, 'purchase_request');
        return fractal($logs, new ActivityLogBatchTransformer)->parseIncludes('causer.user_information');
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
        $logs = (new ActivityLogBatchRepository())->getLogs($id, 'procurement_plan');
        // return $logs;
        return fractal($logs, new ActivityLogBatchTransformer)->parseIncludes('causer.user_information');
    }

    public function procurementPlanItem(Request $request, $id)
    {

    }

    public function requisitionIssue(Request $request, $id)
    {
        $logs = (new ActivityLogBatchRepository())->getLogs($id, 'requisition_issue');
        // return $logs;
        return fractal($logs, new ActivityLogBatchTransformer)->parseIncludes('causer.user_information');
    }

    public function requisitionIssueItem(Request $request, $id)
    {
        
    }
}
