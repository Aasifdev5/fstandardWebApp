<?php

use App\Http\Controllers\Admin\Admin;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController;

use App\Http\Controllers\Admin\QuotationController;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BackgroundCertificateApi;

use App\Http\Controllers\Api\BalanceController;
use App\Http\Controllers\Api\ChambeadorProfileApi;
use App\Http\Controllers\Api\ChatController;
use App\Http\Controllers\Api\ContractController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\IdentityCardApi;
use App\Http\Controllers\Api\ProposalController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\ServiceRequestController;
use App\Http\Controllers\Api\UserProfileApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('categories', [CategoryController::class, 'categories']);
Route::get('/category-name/{id}', [CategoryController::class, 'getNameCategoryById']);


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/google-register', [AuthController::class, 'googleRegister']);
Route::post('/google-login', [AuthController::class, 'googleLogin']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user/profile', [AuthController::class, 'getProfile']);
    Route::post('/user/profile', [AuthController::class, 'updateProfile']);

    Route::get('/addresses', [AddressController::class, 'index']);
    Route::post('/addresses', [AddressController::class, 'store']);
    Route::get('/addresses/{id}', [AddressController::class, 'show']);
    Route::put('/addresses/{id}', [AddressController::class, 'update']);
    Route::delete('/addresses/{id}', [AddressController::class, 'destroy']);
});



Route::get('/test-token', [AuthController::class, 'testToken']);
Route::get('/sliders', [BannerController::class, 'getSliders']);
