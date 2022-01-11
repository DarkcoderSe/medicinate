<?php 

use Illuminate\Support\Facades\Route;

/**
 * Admin routes 
 * developed by pwh-dcse
 * Admin Login Routes
 */
Route::get('login', 'LoginController@show')->name('login');
Route::post('login', 'LoginController@submit')->name('login.submit');

Route::middleware('role:administrator')->group(function() {

    /**
     * Student CRUD
     */
    Route::prefix('user')->name('user.')->group(function(){
        
        Route::get('/', 'UserController@index')->name('index');
        Route::get('ajax', 'UserController@ajaxIndex')->name('ajax');
        Route::get('create', 'UserController@create')->name('create');

        Route::get('edit/{id}', 'UserController@edit')->name('edit');
        Route::get('delete/{id}', 'UserController@delete')->name('delete');
        Route::get('view/{id}', 'UserController@view')->name('view');

        Route::post('submit', 'UserController@submit')->name('submit');
        Route::post('update', 'UserController@update')->name('update');

        Route::get('is-valid/{username}', 'UserController@isAvailable')->name('is-available');
        Route::post('change-password', 'UserController@updatePassword')->name('change-password');

    });


    /**
     * Roles CRUD
     */
    Route::prefix('role')->name('role.')->group(function(){
        
        Route::get('/', 'RoleController@index')->name('index');
        Route::get('ajax', 'RoleController@ajaxIndex')->name('ajax');
        Route::get('create', 'RoleController@create')->name('create');
        Route::get('edit/{id}', 'RoleController@edit')->name('edit');
        Route::get('delete/{id}', 'RoleController@delete')->name('delete');

        Route::post('submit', 'RoleController@submit')->name('submit');
        Route::post('update', 'RoleController@update')->name('update');

        
    });

    /**
     * Permissions CRUD
     */
    Route::prefix('permission')->name('permission.')->group(function(){
        
        Route::get('/', 'PermissionController@index')->name('index');
        Route::get('ajax', 'PermissionController@ajaxIndex')->name('ajax');
        Route::get('create', 'PermissionController@create')->name('create');
        Route::get('edit/{id}', 'PermissionController@edit')->name('edit');
        Route::get('delete/{id}', 'PermissionController@delete')->name('delete');

        Route::post('submit', 'PermissionController@submit')->name('submit');
        Route::post('update', 'PermissionController@update')->name('update');

    });

    /**
     * Preferences CRUD
     */
    Route::prefix('preference')->name('preference.')->group(function(){
        
        Route::get('/', 'PreferenceController@index')->name('index');
        Route::get('ajax', 'PreferenceController@ajaxIndex')->name('ajax');
        Route::get('create', 'PreferenceController@create')->name('create');
        Route::get('edit/{id}', 'PreferenceController@edit')->name('edit');
        Route::get('delete/{id}', 'PreferenceController@delete')->name('delete');

        Route::post('submit', 'PreferenceController@submit')->name('submit');
        Route::post('update', 'PreferenceController@update')->name('update');

    });


});

Route::middleware('role:administrator|manager|expert')->group(function(){

    Route::get('home', 'HomeController@index')->name('home');

    /**
     * Badges CRUD
     */
    Route::prefix('badge')->name('badge.')->group(function(){
        
        Route::get('/', 'BadgeController@index')->name('index');
        Route::get('create', 'BadgeController@create')->name('create');
        Route::get('edit/{id}', 'BadgeController@edit')->name('edit');
        Route::get('delete/{id}', 'BadgeController@delete')->name('delete');

        Route::post('submit', 'BadgeController@submit')->name('submit');
        Route::post('update', 'BadgeController@update')->name('update');

    });

    /**
     * Manufacturer CRUD
     */
    Route::prefix('manufacturer')->name('manufacturer.')->group(function(){
        
        Route::get('/', 'ManufacturerController@index')->name('index');
        Route::get('create', 'ManufacturerController@create')->name('create');
        Route::get('edit/{id}', 'ManufacturerController@edit')->name('edit');
        Route::get('delete/{id}', 'ManufacturerController@delete')->name('delete');

        Route::post('submit', 'ManufacturerController@submit')->name('submit');
        Route::post('update', 'ManufacturerController@update')->name('update');

    });

    /**
     * Badges CRUD
     */
    Route::prefix('ngo')->name('ngo.')->group(function(){
        
        Route::get('/', 'NgoController@index')->name('index');
        Route::get('create', 'NgoController@create')->name('create');
        Route::get('edit/{id}', 'NgoController@edit')->name('edit');
        Route::get('delete/{id}', 'NgoController@delete')->name('delete');

        Route::post('submit', 'NgoController@submit')->name('submit');
        Route::post('update', 'NgoController@update')->name('update');

    });


    /**
     * fedeback CRUD
     */
    Route::prefix('contact')->name('contact.')->group(function(){
        Route::get('ajax/{id?}/{userId?}', 'ContactController@ajaxIndex')->name('ajax');
        Route::get('view/{id}', 'ContactController@view')->name('view');
        Route::get('delete/{id}', 'ContactController@delete')->name('delete');
        Route::post('update', 'ContactController@update')->name('update');

        Route::get('/{id?}/{userId?}', 'ContactController@index')->name('index');

    });

    /**
     * donations CRUD
     */
    Route::prefix('donation')->name('donation.')->group(function(){

        Route::get('/', 'DonationController@index')->name('index');
        Route::get('status/{s}/{d}', 'DonationController@changeStatus');
        Route::get('delete/{id}', 'DonationController@delete');
    });


});