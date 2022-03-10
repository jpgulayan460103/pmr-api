<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityLog;
use App\Models\FormUpload;
use App\Transformers\PurchaseRequestLogTransformer;
use App\Repositories\PurchaseRequestRepository;
use App\Transformers\PurchaseRequestItemLogTransformer;
use App\Transformers\AuditTrailTransformer;
use App\Transformers\BacTaskLogTransformer;
use App\Transformers\FormUploadLogTransformer;
use Illuminate\Support\Facades\DB;

class AuditTrailController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('role_or_permission:super-admin|admin|purchase.requests.create|purchase.requests.all', ['only' => ['store']]);
        $this->middleware('role_or_permission:super-admin|admin|purchase.requests.update|purchase.requests.all',   ['only' => ['update']]);
        $this->middleware('role_or_permission:super-admin|admin|activitylogs.view|activitylogs.all',   ['only' => ['show', 'index']]);
    }
    public function index(Request $request)
    {
        DB::enableQueryLog();
        $logs = ActivityLog::with(
            [
                'user.user_information',
                'subject' => function($query) {
                    $query->withTrashed();
                },
            ]
        )->orderBy('id','desc')->paginate(20);
        // return DB::getQueryLog();
        // return $logs;
        return fractal($logs, new AuditTrailTransformer)->parseIncludes('subject.parent,user.user_information');
    }

    public function purchaseRequest(Request $request, $id)
    {
        $purchase_request = (new PurchaseRequestRepository())->attach('bac_task')->getById($id);
        $model = (get_class($purchase_request));
        $purchase_request_log = ActivityLog::with(
                [
                    'user.user_information',
                    'subject' => function($query) {
                        $query->withTrashed();
                    },
                ]
            )
            ->where('subject_type','App\\Models\\PurchaseRequest')
            ->where('subject_id',$id)
            ->get();
        $purchase_request_log = fractal($purchase_request_log, new PurchaseRequestLogTransformer)->parseIncludes('user.user_information,subject')->toArray();

        //items
        $items_logs = $this->purchaseRequestItem($request, $id);

        $merged = array_merge($items_logs['data'], $purchase_request_log['data']);
        usort($merged, function($a, $b) {
            return ($b['id'] - $a['id']);
        });

        $purchase_request_log = [
            'data' => $merged
        ];
        //end items


        //bac
        // if($request->type && $request->type == "procurement"){
            if($purchase_request->bac_task){
                $bac_log = $this->bacTask($request, $purchase_request);
                $merged = array_merge($bac_log['data'], $purchase_request_log['data']);
                usort($merged, function($a, $b) {
                    return ($b['id'] - $a['id']);
                });

                $purchase_request_log = [
                    'data' => $merged
                ];
            }
        // }
        //end bac

        //uploads
        // $uploads = $this->formUploads($request, 'purchase_request' , $id);

        // $merged = array_merge($uploads['data'], $purchase_request_log['data']);
        // usort($merged, function($a, $b) {
        //     return ($b['id'] - $a['id']);
        // });

        // $purchase_request_log = [
        //     'data' => $merged
        // ];
        //end uploads
        return $purchase_request_log;
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

    public function bacTask(Request $request, $purchase_request)
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

    public function formUploads(Request $request, $type, $id)
    {
        $form_uploads = FormUpload::where('upload_type', $type)->where('form_uploadable_id', $id)->withTrashed()->select('id')->pluck('id');
        $log = ActivityLog::with(
            [
                'user.user_information',
                'subject' => function($query) {
                    $query->withTrashed();
                },
            ]
        )
        ->whereIn('subject_id',$form_uploads)
        ->where('subject_type','App\Models\FormUpload')
        ->get();
        // return $log;
        return fractal($log, new FormUploadLogTransformer)->parseIncludes('user.user_information,subject.parent')->toArray();
        return $form_uploads;
    }
}
