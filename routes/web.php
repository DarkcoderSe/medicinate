<?php

use Illuminate\Support\Facades\Route;

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

Route::prefix('donation')->name('donation')->middleware('auth')->group(function() {
    Route::get('/', 'DonationController@index')->name('index');
    Route::post('submit', 'DonationController@submit')->name('submit');
    Route::get('history', 'DonationController@history')->name('history');
});
