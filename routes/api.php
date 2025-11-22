<?php

use App\Http\Controllers\Admin\Admin;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\QuotationController;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BackgroundCertificateApi;
use App\Http\Controllers\Api\CartController;
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
Route::get('/products/{category}', [ProductController::class, 'index']);
Route::get('/products', [ProductController::class, 'getProducts']);
Route::get('subcategories/{category}', [CategoryController::class, 'subcategories']);
Route::post('quotations', [QuotationController::class, 'store']);
Route::get('/opening-hours/{restaurant_id}', [RestaurantController::class, 'getOpeningHours']);
Route::get('/restaurants/{id}/coordinates', [RestaurantController::class, 'getCoordinates']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/google-register', [AuthController::class, 'googleRegister']);
Route::post('/google-login', [AuthController::class, 'googleLogin']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user/profile', [AuthController::class, 'getProfile']);
    Route::post('/user/profile', [AuthController::class, 'updateProfile']);
    Route::get('/favorites', [FavoriteController::class, 'index']);
    Route::post('/favorites/add', [FavoriteController::class, 'add']);
    Route::delete('/favorites/remove/{productId}', [FavoriteController::class, 'remove']);
    Route::get('/addresses', [AddressController::class, 'index']);
    Route::post('/addresses', [AddressController::class, 'store']);
    Route::get('/addresses/{id}', [AddressController::class, 'show']);
    Route::put('/addresses/{id}', [AddressController::class, 'update']);
    Route::delete('/addresses/{id}', [AddressController::class, 'destroy']);
});

Route::middleware('auth.firebase')->group(function () {
    Route::post('/chambeador/check-balance', [ChambeadorProfileApi::class, 'checkBalance'])->name('chambeador.check-balance');
    Route::get('/profile', [UserProfileApi::class, 'getProfile']);
    Route::post('/profile', [UserProfileApi::class, 'updateProfile']);
    Route::post('/update-fcm-token', [UserProfileApi::class, 'updateFcmToken']);
    Route::get('/account-type/{uid}', [UserProfileApi::class, 'getAccountType']);
    Route::post('/profile/upload-image', [UserProfileApi::class, 'uploadProfileImage']);
    Route::get('/users/{id}', [UserProfileApi::class, 'show']);
    Route::get('/profile-photo/{uuid}', [ChambeadorProfileApi::class, 'getChambeadorProfilePhotoByUuid']);
    Route::get('/client-profile-photo/{uuid}', [UserProfileApi::class, 'getClientProfilePhotoByUuid']);
    Route::get('/users/map-id-to-uid/{workerId}', [UserProfileApi::class, 'mapIdToUid']);
    Route::post('/reviews', [ReviewController::class, 'store']);
    Route::get('/reviews/worker/{workerId}', [ReviewController::class, 'getByWorker']);
    Route::get('/reviews/worker/{workerUid}/reviews-only', [ReviewController::class, 'getWorkerReviews']);
    Route::get('/balance', [BalanceController::class, 'getBalance']);
    Route::get('/recharge-info', [BalanceController::class, 'getRechargeInfo']);
    Route::get('/clients', [UserProfileApi::class, 'getClients']);
    Route::get('/chambeadores/nearby', [ChambeadorProfileApi::class, 'getNearbyChambeadores']);
    Route::get('/chambeadores/ratings', [ChambeadorProfileApi::class, 'getChambeadoresWithRatings']);
    Route::get('/chats', [ChatController::class, 'getChats']);
    Route::post('/chats/initialize', [ChatController::class, 'initializeChat']);
    Route::post('/chats/send', [ChatController::class, 'sendMessage']);
    Route::get('/chats/{chat_id}/messages', [ChatController::class, 'getMessages']);
    Route::post('/chats/mark-read', [ChatController::class, 'markMessageAsRead']);
    Route::prefix('service-requests')->group(function () {
        Route::get('/', [ServiceRequestController::class, 'index']);
        Route::get('jobs', [ServiceRequestController::class, 'jobs']);
        Route::get('job/{id}', [ServiceRequestController::class, 'jobDetail']);
        Route::post('/', [ServiceRequestController::class, 'store']);
        Route::get('/{id}', [ServiceRequestController::class, 'show']);
        Route::get('/{id}/proposals', [ProposalController::class, 'index']);
        Route::post('/proposals', [ProposalController::class, 'store']);
        Route::post('/{serviceRequestId}/hire', [ContractController::class, 'hire']);
        Route::post('/{id}/accept', [ContractController::class, 'accept']);
        Route::post('/{id}/start', [ServiceRequestController::class, 'start']);
        Route::post('/{id}/complete', [ServiceRequestController::class, 'complete']);
        Route::get('/worker-jobs/{uid}', [ServiceRequestController::class, 'workerJobs']);
    });
    Route::post('/contracts/rehire/{serviceRequestId}', [ContractController::class, 'rehire']);
    Route::post('/contracts/cancel/{serviceRequestId}', [ContractController::class, 'cancel']);
    Route::get('/contracts/offer/{serviceRequestId?}', [ContractController::class, 'getContractOffer']);
    Route::get('/contracts/status/{serviceRequestId}', [ContractController::class, 'checkContractStatus']);
    Route::prefix('chambeador')->group(function () {
        Route::get('/profile', [ChambeadorProfileApi::class, 'getProfile']);
        Route::post('/profile', [ChambeadorProfileApi::class, 'updateProfile']);
        Route::post('/profile/upload-image', [ChambeadorProfileApi::class, 'uploadProfileImage']);
        Route::post('/subcategory', [ChambeadorProfileApi::class, 'addSubcategory']);
    });
    Route::get('/worker/contracts/summary', [ContractController::class, 'contractSummary']);
    Route::prefix('background-certificate')->group(function () {
        Route::post('/upload', [BackgroundCertificateApi::class, 'uploadCertificate']);
        Route::get('/', [BackgroundCertificateApi::class, 'getCertificate']);
    });
    Route::prefix('identity-card')->group(function () {
        Route::post('/update', [IdentityCardApi::class, 'updateIdentityCard']);
        Route::get('/', [IdentityCardApi::class, 'getIdentityCard']);
    });
    // Add verify-profile-completion route
    Route::get('/verify-profile-completion', [ChambeadorProfileApi::class, 'verifyProfileCompletion']);
});

Route::get('/test-token', [AuthController::class, 'testToken']);
Route::get('/sliders', [BannerController::class, 'getSliders']);
