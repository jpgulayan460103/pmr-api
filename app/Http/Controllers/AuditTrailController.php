<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityLog;
use App\Transformers\PurchaseRequestLogTransformer;
use App\Repositories\PurchaseRequestRepository;
use App\Transformers\PurchaseRequestItemLogTransformer;
use Illuminate\Support\Facades\DB;

class AuditTrailController extends Controller
{
    public function purchaseRequest(Request $request, $id)
    {
        $log = ActivityLog::with(
                [
                    'user.user_information',
                    'subject'
                ]
            )
            ->where('subject_type','App\\Models\\PurchaseRequest')
            ->where('subject_id',$id)
            ->get();
        return fractal($log, new PurchaseRequestLogTransformer)->parseIncludes('user.user_information,subject');
    }

    public function purchaseRequestItem(Request $request, $id)
    {
        $purchaseRequest = new PurchaseRequestRepository;
        $items = $purchaseRequest->getById($id)->items()->withTrashed()->pluck('id');
        $log = ActivityLog::with(
                [
                    'user.user_information',
                    'subject' => function($query) {
                        $query->withTrashed();
                    },
                ]
            )
            ->whereIn('subject_id',$items)
            ->where('subject_type','App\Models\PurchaseRequestItem')
            ->get();
        return fractal($log, new PurchaseRequestItemLogTransformer)->parseIncludes('user.user_information,subject');
    }
}
