<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PurchaseRequestController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\UserController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);
Route::get('/login', [AuthController::class, 'login']);
Route::middleware(['auth:api'])->group(function () {
    Route::resources([
        'purchase-requests' => PurchaseRequestController::class,
        'purchase-orders' => PurchaseOrderController::class,
        'items' => ItemController::class,
        'users' => UserController::class,
    ]);
    
});


// Route::resources([
//     'purchase-requests' => PurchaseRequestController::class,
//     'purchase-orders' => PurchaseOrderController::class,
//     'items' => ItemController::class,
//     'users' => UserController::class,
// ]);

