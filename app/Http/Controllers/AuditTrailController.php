<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityLog;
use App\Models\FormUpload;
use App\Repositories\ProcurementPlanRepository;
use App\Repositories\PurchaseRequestRepository;
use App\Transformers\AuditTrailTransformer;
use App\Transformers\Logs\BacTaskLogTransformer;
use App\Transformers\Logs\FormUploadLogTransformer;
use App\Transformers\Logs\ProcurementPlanItemLogTransformer;
use App\Transformers\Logs\ProcurementPlanLogTransformer;
use App\Transformers\Logs\PurchaseRequestItemLogTransformer;
use App\Transformers\Logs\PurchaseRequestLogTransformer;
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
        $logs = ActivityLog::with(
            [
                'user.user_information',
                'subject' => function($query) {
                    $query->withTrashed();
                },
            ]
        );
        if(request()->has('causer_id') && request('causer_id') != []){
            $logs->whereIn('causer_id', request('causer_id'));
        }
        if(request()->has('log_type') && request('log_type') != []){
            $log_types = request('log_type');
            $logs->where(function ($query) use ($log_types) {
                foreach ($log_types as $log_type) {
                    switch ($log_type) {
                        case 'bac_task':
                            $query->orWhere('subject_type', '');
                            break;
                        case 'form_routing':
                            $query->orWhere('subject_type', 'App\Models\FormRoute');
                            break;
                        case 'form_upload':
                            $query->orWhere('subject_type', 'App\Models\FormUpload');
                            break;
                        case 'purchase_request':
                            $query->orWhere('subject_type', 'App\Models\PurchaseRequest');
                            break;
                        case 'purchase_request_item':
                            $query->orWhere('subject_type', 'App\Models\PurchaseRequestItem');
                            break;
                        case 'supplier':
                            $query->orWhere('subject_type', 'App\Models\Supplier');
                            break;
                        case 'supplier_contact_person':
                            $query->orWhere('subject_type', 'App\Models\SupplierContact');
                            break;
                        case 'user_login':
                            $query->orWhere('log_name', $log_type);
                            break;
                        case 'user_logout':
                            $query->orWhere('log_name', $log_type);
                            break;
                        
                        default:
                            # code...
                            break;
                    }
                }
            });
        }
        $logs->orderBy('id','desc');
        $logs = $logs->paginate(100);
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
        $form_uploads = FormUpload::where('form_type', $type)->where('form_uploadable_id', $id)->withTrashed()->select('id')->pluck('id');
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

    public function procurementPlan(Request $request, $id)
    {
        // return $this->procurementPlanItem($request, $id);
        $procurement_plan = (new ProcurementPlanRepository())->getById($id);
        $model = (get_class($procurement_plan));
        $procurement_plan_log = ActivityLog::with(
                [
                    'user.user_information',
                    'subject' => function($query) {
                        $query->withTrashed();
                    },
                ]
            )
            ->where('subject_type',$model)
            ->where('subject_id',$id)
            ->get();
        // return $procurement_plan_log;
        $procurement_plan_log = fractal($procurement_plan_log, new ProcurementPlanLogTransformer)->parseIncludes('user.user_information,subject')->toArray();

        //items
        $items_logs = $this->procurementPlanItem($request, $id);

        $merged = array_merge($items_logs['data'], $procurement_plan_log['data']);
        usort($merged, function($a, $b) {
            return ($b['id'] - $a['id']);
        });

        $procurement_plan_log = [
            'data' => $merged
        ];
        return $procurement_plan_log;
    }

    public function procurementPlanItem(Request $request, $id)
    {
        $procurementPlan = new ProcurementPlanRepository;
        $items = $procurementPlan->getById($id)->items()->withTrashed()->pluck('id');
        $log = ActivityLog::with(
                [
                    'user.user_information',
                    'subject.item' => function($query) {
                        $query->withTrashed();
                    },
                ]
            )
            ->whereIn('subject_id',$items)
            ->where('subject_type','App\Models\ProcurementPlanItem')
            ->get();
        return fractal($log, new ProcurementPlanItemLogTransformer)->parseIncludes('user.user_information,subject')->toArray();
    }
}
