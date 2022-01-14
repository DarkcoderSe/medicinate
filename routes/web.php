<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StripeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::namespace('App\\Http\\Controllers')
    ->group(function() {

    Route::get('ngo', 'DonationController@ngo');

    Route::prefix('donation')
            ->name('donation.')
            ->middleware('auth')
            ->group(function() {

        Route::get('/', 'DonationController@index')->name('index');
        Route::post('submit', 'DonationController@submit')->name('submit');
        Route::get('history', 'DonationController@history')->name('history');
    });

// Route::prefix('stripe-payment')
//         ->name('stripe-payment')
//         ->middleware('auth')
//         ->group(function() {

    // Route::get('payment', 'PaymentController@cashier');
    // // Route::post('submit', 'PaymentController@cashier');
   Route::post('/show', 'ProductController@purchase')->name('show');
   Route::get('/show','ProductController@show')->middleware(['auth']);;

   
  Route::get('/stripe-payment', [StripeController::class, 'handleGet'])->middleware(['auth']);
  Route::post('/stripe-payment', [StripeController::class, 'handlePost'])->name('stripe.payment');







    // });

    Route::prefix('feedback')
        ->name('feedback.')
        ->group(function() {
        Route::get('/', 'FeedbackController@index')->name('index');
        Route::post('submit', 'FeedbackController@submit')->name('submit');
    });
});
