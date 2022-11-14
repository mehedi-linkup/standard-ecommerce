<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CustomerController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Route::get('/category', [ApiController::class, 'index']);

// Route::post('/category/post', [ApiController::class, 'store']);

Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return 'DONE'; //Return anything
});


Route::get('/get-minimum-offer', [ApiController::class, 'GetMinimumOffer']);


Route::get('/hotline', [ApiController::class, 'hotline']);
Route::get('/product', [ApiController::class, 'product']);

Route::get('/slider', [ApiController::class, 'banner']);
// category
Route::get('/category-with-subcategory', [ApiController::class, 'getCategory']);
Route::get('/category', [ApiController::class, 'getCategoryOnly']);
// product
Route::get('/recent-home', [ApiController::class, 'recentProduct']);
Route::get('/recent-inner', [ApiController::class, 'recentProductInner']);
// popular product
Route::get('/popular-inner', [ApiController::class, 'popularInner']);

Route::get('/newarrival', [ApiController::class, 'newArrival']);
// search
Route::get('search/{name}',[ApiController::class, 'search']);

Route::get('category-wise-product/{id}',[ApiController::class, 'categoryWiseProduct']);
Route::get('subcategory-wise-product/{id}',[ApiController::class, 'subcategoryWiseProduct']);

Route::post('customer-store', [ApiController::class, 'CustomerStore']);
Route::post('verify-otp', [ApiController::class, 'otpMatch']);



// forget password code
Route::post('password-reset', [CustomerController::class, 'forgetPasswordOtpSend']);
Route::post('check-otp-password', [CustomerController::class, 'otpMatchForgetPassword']);
Route::post('forget-password-update', [CustomerController::class, 'forgetpasswordUpdate']);




// order store
Route::get('get-thana', [ApiController::class, 'getThana']);
Route::post('get-area', [ApiController::class, 'getArea']);

Route::post('order-store', [ApiController::class, 'orderStore']);


Route::post('customer-update/{phone}', [CustomerController::class, 'customerUpdate']);
Route::post('password-update/{phone}', [CustomerController::class, 'customerPasswordUpdate']);
Route::get('customer-order/{id}', [CustomerController::class, 'orderRecord']);
Route::get('order-details/{id}', [CustomerController::class, 'orderDetails']);
Route::get('order', [CustomerController::class, 'order']);
Route::get('customer-order-cancel/{id}', [CustomerController::class, 'orderCancel']);
Route::group([

    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers\Api',
    // 'prefix' => 'auth'

], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('refresh', [AuthController::class, 'refresh']);
 
});
 
