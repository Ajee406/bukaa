<?php

use App\Http\Controllers\addon\committee\alumni\NominationController;
use App\Http\Controllers\addon\donation\frontend\DonationController;
use App\Http\Controllers\Alumni\OrderController;
use App\Http\Controllers\addon\saas\admin\OrderController as SubscriptionOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//call back
Route::match(array('GET', 'POST'), 'verify', [OrderController::class, 'verify'])->name('payment.verify');
Route::match(array('GET', 'POST'), 'donation-verify', [DonationController::class, 'verify'])->name('donation-payment.verify');
Route::match(array('GET', 'POST'), 'nomination-application-verify', [NominationController::class, 'verify'])->name('nomination_apply.verify');
Route::match(array('GET', 'POST'), 'subscription/verify', [SubscriptionOrder::class, 'verify'])->name('subscription.payment.verify');
