<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StripController;

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

    Route::prefix('feedback')
        ->name('feedback.')
        ->group(function() {
        Route::get('/', 'FeedbackController@index')->name('index');
        Route::post('submit', 'FeedbackController@submit')->name('submit');
    });
});

//Route::post('products/{id}/purchase', 'ProductController@purchase')->name('products.purchase');
//Route::get('show',[\App\Http\Controllers\Product\ProductController::class,'show']);

Route::get('payments', [StripController\StripController::class ,'purchasForm']);
Route::post('payments', [StripController\StripController::class,'purchas'])->name('payment.post');
