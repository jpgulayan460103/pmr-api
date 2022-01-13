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
use App\Http\Controllers\SignatoryController;

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
Route::post('/active-directory/login', [AuthController::class, 'ad_login']);
Route::middleware(['auth:api'])->group(function () {
    Route::resources([
        'purchase-requests' => PurchaseRequestController::class,
        'purchase-orders' => PurchaseOrderController::class,
        'items' => ItemController::class,
        'users' => UserController::class,
        'signatories' => SignatoryController::class,
        // 'form-routes' => FormRouteController::class,
    ]);
});

Route::group(['prefix' => '/libraries'], function () {
    Route::get('/', [LibraryController::class, 'index']);
    Route::get('/{type}', [LibraryController::class, 'show']);
});

Route::group(['prefix' => '/pdf'], function () {
    Route::group(['prefix' => '/preview'], function () {
        Route::get('/purchase-requests', [PurchaseRequestController::class, 'generatePdfPreview']);
        Route::post('/purchase-requests', [PurchaseRequestController::class, 'validatePdfPreview']);
    });

    Route::group(['prefix' => '/purchase-requests'], function () {
        Route::get('/{id}', [PurchaseRequestController::class, 'pdf']);
    });
});


Route::group(['prefix' => '/purchase-requests'], function () {
    Route::post('/{id}/approve', [PurchaseRequestController::class, 'approve']);
});

Route::resources([
    // 'purchase-requests' => PurchaseRequestController::class,
    'purchase-orders' => PurchaseOrderController::class,
    'items' => ItemController::class,
    'users' => UserController::class,
    'signatories' => SignatoryController::class,
    // 'form-routes' => FormRouteController::class,
]);

