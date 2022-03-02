<?php

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
use App\Http\Controllers\FormProcessController;
use App\Http\Controllers\FormUploadController;

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

Route::middleware('auth:api')->get('/user', [UserController::class, 'auth']);

Route::post('/login', [AuthController::class, 'login']);
Route::get('/login', [AuthController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/active-directory/login', [AuthController::class, 'adLogin']);
Route::get('/logger/purchase-request/{id}', [AuditTrailController::class, 'purchaseRequest']);
Route::get('/logger/purchase-request/{id}/items', [AuditTrailController::class, 'purchaseRequestItem']);
Route::middleware(['auth:api'])->group(function () {
    Route::resources([
        'purchase-requests' => PurchaseRequestController::class,
        'purchase-orders' => PurchaseOrderController::class,
        'items' => ItemController::class,
        'users' => UserController::class,
        'user_offices' => UserOfficeController::class,
        'form-routes' => FormRouteController::class,
        'suppliers' => SupplierController::class,
        'quotations' => QuotationController::class,
    ]);
});

Route::group(['prefix' => '/libraries'], function () {
    Route::get('/', [LibraryController::class, 'index']);
    Route::get('/{type}', [LibraryController::class, 'show']);
});

Route::group(['prefix' => '/pdf'], function () {
    Route::group(['prefix' => '/preview'], function () {
        Route::get('/purchase-requests', [PurchaseRequestController::class, 'generatePdfPreview'])->name('api.purchase-requests.pdf.preview');
        Route::post('/purchase-requests', [PurchaseRequestController::class, 'validatePdfPreview'])->name('api.purchase-requests.pdf.validate');
    });
    
    Route::get('/purchase-requests/{id}', [PurchaseRequestController::class, 'pdf'])->name('api.purchase-requests.pdf');
    Route::get('/quotations/{id}', [QuotationController::class, 'pdf'])->name('api.quotation.pdf');
});


Route::group(['prefix' => '/purchase-requests', 'middleware' => 'auth:api'], function () {
    Route::post('/{id}/bac-tasks', [PurchaseRequestController::class, 'updateBacTasks']);
});

Route::group(['prefix' => '/forms', 'middleware' => 'auth:api'], function () {
    Route::put('/process/{id}', [FormProcessController::class, 'update']);
    Route::get('/routes/{id}', [FormRouteController::class, 'show']);
    Route::group(['prefix' => '/routes'], function () {
        Route::get('/requests/pending', [FormRouteController::class, 'getPending']);
        Route::post('/requests/pending/{id}/approve', [FormRouteController::class, 'approve']);
        Route::post('/requests/pending/{id}/reject', [FormRouteController::class, 'reject']);
    }); 
    Route::get('/rejected', [FormRouteController::class, 'rejected']);
    Route::get('/approved', [FormRouteController::class, 'approved']);

    Route::group(['prefix' => '/uploads'], function () {
        Route::post('/purchase-request', [FormUploadController::class, 'store']);
    });
});

Route::group(['prefix' => '/next-numbers'], function () {
    Route::get('/purchase-request', [PurchaseRequestController::class, 'getNextNumber']);
});

Route::resources([
    // 'purchase-requests' => PurchaseRequestController::class,
    'purchase-orders' => PurchaseOrderController::class,
    'items' => ItemController::class,
    'users' => UserController::class,
    'user_offices' => UserOfficeController::class,
    // 'form-routes' => FormRouteController::class,
]);

