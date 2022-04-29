<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\users\gatewayPaymentController;
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


Route::group(['prefix'=> 'courses', 'as' =>'courses.'] , function() {


   


    Route::POST('/payment',[gatewayPaymentController::class,'infoPayment'])->name('payment');
    Route::POST('/callback',[gatewayPaymentController::class,'callbackPayment'])->name('callback');
    Route::POST('/fails-payment',[gatewayPaymentController::class,'callbackPaymentError'])->name('error');
     
}); #-- end course group


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
