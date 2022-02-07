<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityLog;
use App\Transformers\PurchaseRequestLogTransformer;
use App\Repositories\PurchaseRequestRepository;

class AuditTrailController extends Controller
{
    public function purchase_request(Request $request, $id)
    {
        $log = ActivityLog::with('user.user_information')->where('subject_type','App\\Models\\PurchaseRequest')->where('subject_id',$id)->get();
        // $purchaseRequest = new PurchaseRequestRepository;
        // $items = $purchaseRequest->getById(2)->items()->pluck('id');
        // $log = ActivityLog::with('user.user_information')->whereIn('subject_id',$items)->where('subject_type','App\Models\PurchaseRequestItem')->get();
        // return $log;
        return fractal($log, new PurchaseRequestLogTransformer)->parseIncludes('user.user_information');
    }
}
