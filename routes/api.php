<?php

use App\Http\Controllers\ActivityLogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FormRouteController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PurchaseRequestController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\UserOfficeController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\AuditTrailController;
use App\Http\Controllers\FirebaseTokenController;
use App\Http\Controllers\FormProcessController;
use App\Http\Controllers\FormUploadController;
use App\Http\Controllers\ItemSupplyController;
use App\Http\Controllers\ItemSupplyHistoryController;
use App\Http\Controllers\NoStockCertificateController;
use App\Http\Controllers\ProcurementManagementController;
use App\Http\Controllers\RequisitionIssueController;
use App\Http\Controllers\ProcurementPlanController;
use App\Http\Controllers\ReportController;
use App\Models\PurchaseOrder;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', [UserController::class, 'auth']);

Route::post('/login', [AuthController::class, 'login']);
Route::post('/auth/refresh', [AuthController::class, 'refreshToken']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
Route::post('/active-directory/login', [AuthController::class, 'adLogin']);
Route::post('/register', [UserController::class, 'register']);


Route::resources([
    'purchase-requests' => PurchaseRequestController::class,
    'purchase-orders' => PurchaseOrderController::class,
    'procurement-plans' => ProcurementPlanController::class,
    'requisition-issues' => RequisitionIssueController::class,
    'items' => ItemController::class,
    'users' => UserController::class,
    'user_offices' => UserOfficeController::class,
    'form-routes' => FormRouteController::class,
    'suppliers' => SupplierController::class,
    'quotations' => QuotationController::class,
    'procurement-managements' => ProcurementManagementController::class,
    'item-supplies' => ItemSupplyController::class,
    'nas-certificates' => NoStockCertificateController::class,
]);

Route::post('/procurement-plans/{id}/archive', [ProcurementPlanController::class, 'archive']);
Route::post('/requisition-issues/{id}/archive', [RequisitionIssueController::class, 'archive']);
Route::post('/purchase-requests/{id}/archive', [PurchaseRequestController::class, 'archive']);

Route::group(['prefix' => '/libraries'], function () {
    Route::get('/', [LibraryController::class, 'index']);
    Route::get('/{type}', [LibraryController::class, 'show']);
    Route::put('/{type}/{id}', [LibraryController::class, 'update']);
    Route::post('/{type}', [LibraryController::class, 'store']);
});

Route::group(['prefix' => '/pdf'], function () {
    Route::get('/purchase-request/{id}', [PurchaseRequestController::class, 'pdf'])->name('api.purchase-requests.pdf');
    Route::get('/procurement-plan/{id}', [ProcurementPlanController::class, 'pdf'])->name('api.procurement-plans.pdf');
    Route::get('/quotations/{id}', [QuotationController::class, 'pdf'])->name('api.quotation.pdf');
    Route::get('/purchase-order/{id}', [PurchaseOrderController::class, 'pdf'])->name('api.purchase-order.pdf');
    Route::get('/stock-card/{id}', [ItemSupplyHistoryController::class, 'pdf'])->name('api.stock-card.pdf');
    Route::get('/requisition-and-issue-slip/{id}', [RequisitionIssueController::class, 'pdf'])->name('api.ris.pdf');
    Route::get('/nas-certificate/{id}', [NoStockCertificateController::class, 'pdf'])->name('api.no-stock-certificate.pdf');
});


Route::group(['prefix' => '/forms'], function () {
    Route::put('/process/{id}', [FormProcessController::class, 'update']);
    Route::get('/routes/{id}', [FormRouteController::class, 'show']);

    Route::get('/rejected', [FormRouteController::class, 'getRejected']);
    Route::get('/approved', [FormRouteController::class, 'getApproved']);

    Route::get('/purchase-requests', [PurchaseRequestController::class, 'getForms']);
    Route::get('/procurement-plans', [ProcurementPlanController::class, 'getForms']);
    Route::get('/requisition-issues', [RequisitionIssueController::class, 'getForms']);
    
    Route::group(['prefix' => '/uploads'], function () {
        Route::post('/{type}/{id}', [FormUploadController::class, 'store']);
        Route::delete('/{type}/{id}', [FormUploadController::class, 'destroy']);
    });

    Route::group(['prefix' => '/routes'], function () {
        Route::get('/requests/pending', [FormRouteController::class, 'getPending']);
        Route::post('/requests/pending/{id}/approve', [FormRouteController::class, 'approve']);
        Route::post('/requests/pending/{id}/reject', [FormRouteController::class, 'reject']);
    }); 
});

Route::group(['prefix' => '/next-numbers'], function () {
    Route::get('/purchase-request', [PurchaseRequestController::class, 'getNextNumber']);
});

Route::group(['prefix' => '/users'], function () {
    Route::post('/{id}/permissions', [UserController::class, 'updatePermission']);
    Route::get('/{id}/permissions', [UserController::class, 'updatePermission']);
});

Route::group(['prefix' => '/logger'], function () {
    Route::get('/purchase-request/{id}', [ActivityLogController::class, 'purchaseRequest']);
    Route::get('/purchase-request/{id}/items', [ActivityLogController::class, 'purchaseRequestItem']);
    Route::get('/all', [ActivityLogController::class, 'index']);
    Route::get('/form-uploads/{type}/{id}', [ActivityLogController::class, 'formUploads']);
    Route::get('/procurement-plan/{id}', [ActivityLogController::class, 'procurementPlan']);
    Route::get('/requisition-issue/{id}', [ActivityLogController::class, 'requisitionIssue']);
    Route::get('/item-supply/{id}', [ActivityLogController::class, 'itemSupply']);
    Route::get('/user-activities', [ActivityLogController::class, 'userActivities']);
});

Route::group(['prefix' => '/reports'], function () {
    Route::get('/purchase-request', [ReportController::class, 'purchaseRequest']);
});


Route::group(['prefix' => '/summaries'], function () {
    Route::get('/procurement-management', [ProcurementManagementController::class, 'summary'])->middleware('auth:api');
});
Route::group(['prefix' => '/downloads'], function () { 
    Route::get('/form-uploads/{id}', [FormUploadController::class, 'download'])->name('api.downloads.form-uploads');;
});

Route::post('/tokens/firebase', [FirebaseTokenController::class, 'store']);
Route::get('/tokens/firebase', [FirebaseTokenController::class, 'test']);


