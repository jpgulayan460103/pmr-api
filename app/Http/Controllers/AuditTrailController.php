<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityLog;
use App\Transformers\PurchaseRequestLogTransformer;
use App\Repositories\PurchaseRequestRepository;
use App\Transformers\PurchaseRequestItemLogTransformer;
use App\Transformers\BacTaskLogTransformer;
use Illuminate\Support\Facades\DB;

class AuditTrailController extends Controller
{
    public function purchaseRequest(Request $request, $id)
    {
        $purchase_request = (new PurchaseRequestRepository())->attach('bac_task')->getById($id);
        $model = (get_class($purchase_request));
        $purchase_request_log = ActivityLog::with(
                [
                    'user.user_information',
                    'subject'
                ]
            )
            ->where('subject_type','App\\Models\\PurchaseRequest')
            ->where('subject_id',$id)
            ->get();
        // if($request->type && $request->type == "procurement"){
            if($purchase_request->bac_task){
                $bac_log = $this->bacTask($purchase_request);
                // return $bac_log;
                $purchase_request_log = fractal($purchase_request_log, new PurchaseRequestLogTransformer)->parseIncludes('user.user_information,subject')->toArray();
                $merged = array_merge($bac_log['data'], $purchase_request_log['data']);

                usort($merged, function($a, $b) {
                    return ($a['id'] - $b['id']);
                });

                return [
                    'data' => $merged
                ];

            }
        // }
        return fractal($purchase_request_log, new PurchaseRequestLogTransformer)->parseIncludes('user.user_information,subject')->toArray();
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
        return fractal($log, new PurchaseRequestItemLogTransformer)->parseIncludes('user.user_information,subject')->toArray();
    }

    public function bacTask($purchase_request)
    {
        $model = (get_class($purchase_request->bac_task));
        $log = ActivityLog::with(
            [
                'user.user_information',
                'subject.purchase_request',
            ]
        )
            ->where('subject_type', $model)
            ->where('subject_id', $purchase_request->bac_task->id)
            ->get();
        // return $log;
        return fractal($log, new BacTaskLogTransformer)->parseIncludes('user.user_information,subject.purchase_request')->toArray();
    }
}
