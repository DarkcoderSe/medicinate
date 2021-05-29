<?php 

use Illuminate\Support\Facades\Route;

/**
 * Admin routes 
 * developed by pwh-dcse
 * Admin Login Routes
 */
Route::get('login', 'LoginController@show')->name('login');
Route::post('login', 'LoginController@submit')->name('login.submit');

Route::middleware('role:administrator|manager')->group(function(){

    Route::get('home', 'HomeController@index')->name('home');

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

    /**
     * Reported Issue CRUD
     */
    Route::prefix('reported-issue')->name('reported-issue.')->group(function(){
        
        Route::get('/', 'ReportedIssueController@index')->name('index');
        Route::get('ajax', 'ReportedIssueController@ajaxIndex')->name('ajax');
        Route::get('create', 'ReportedIssueController@create')->name('create');
        Route::get('edit/{id}', 'ReportedIssueController@edit')->name('edit');
        Route::get('delete/{id}', 'ReportedIssueController@delete')->name('delete');

        Route::post('submit', 'ReportedIssueController@submit')->name('submit');
        Route::post('update', 'ReportedIssueController@update')->name('update');

    });

    /**
     * Payment Method CRUD
     */
    Route::prefix('payment-method')->name('payment-method.')->group(function(){
        
        Route::get('/', 'PaymentMethodController@index')->name('index');
        Route::get('ajax', 'PaymentMethodController@ajaxIndex')->name('ajax');
        Route::get('create', 'PaymentMethodController@create')->name('create');
        Route::get('edit/{id}', 'PaymentMethodController@edit')->name('edit');
        Route::get('delete/{id}', 'PaymentMethodController@delete')->name('delete');

        Route::post('submit', 'PaymentMethodController@submit')->name('submit');
        Route::post('update', 'PaymentMethodController@update')->name('update');

        Route::prefix('detail')->name('detail.')->group(function(){
            Route::post('submit', 'PaymentMethodController@detailSubmit')->name('submit');
            Route::get('delete/{id}', 'PaymentMethodController@detailDelete')->name('delete');

        });
    });

    /**
     * Category CRUD
     */
    Route::prefix('category')->name('category.')->group(function(){
        
        Route::get('/', 'CategoryController@index')->name('index');
        Route::get('create/{id?}', 'CategoryController@create')->name('create');
        Route::get('edit/{id}', 'CategoryController@edit')->name('edit');
        Route::get('delete/{id}', 'CategoryController@delete')->name('delete');

        Route::post('submit', 'CategoryController@submit')->name('submit');
        Route::post('update', 'CategoryController@update')->name('update');

    });

    /**
     * Test CRUD
     */
    Route::prefix('test')->name('test.')->group(function(){
        
        Route::get('/', 'TestController@index')->name('index');
        Route::get('create/{id?}', 'TestController@create')->name('create');
        Route::get('edit/{id}', 'TestController@edit')->name('edit');
        Route::get('delete/{id}', 'TestController@delete')->name('delete');

        Route::post('submit', 'TestController@submit')->name('submit');
        Route::post('update', 'TestController@update')->name('update');

        Route::prefix('question')->name('question.')->group(function() {
            Route::get('view/{testId}', 'TestController@getQuestions');
            Route::post('submit', 'TestController@questionSubmit')->name('submit');
            Route::get('delete/{id}', 'TestController@deleteTestSubjectRule')->name('delete');
        });

    });


    /**
     * Subject CRUD
     */
    Route::prefix('subject')->name('subject.')->group(function(){
        
        Route::get('/', 'SubjectController@index')->name('index');
        Route::get('ajax', 'SubjectController@ajaxIndex')->name('ajax');
        Route::get('create', 'SubjectController@create')->name('create');
        Route::get('edit/{id}', 'SubjectController@edit')->name('edit');
        Route::get('delete/{id}', 'SubjectController@delete')->name('delete');

        Route::post('submit', 'SubjectController@submit')->name('submit');
        Route::post('update', 'SubjectController@update')->name('update');

    });

    Route::prefix('chapter')->name('chapter.')->group(function(){
        
        Route::get('edit/{id}', 'ChapterController@edit')->name('edit');
        Route::get('delete/{id}', 'ChapterController@delete')->name('delete');

        Route::post('submit', 'ChapterController@submit')->name('submit');
        Route::post('update', 'ChapterController@update')->name('update');
 
    });

    Route::prefix('question')->name('question.')->group(function(){
        
        Route::get('/', 'QuestionController@index')->name('index');
        Route::get('ajax', 'QuestionController@ajaxIndex')->name('ajax');
        Route::get('create', 'QuestionController@create')->name('create');
        Route::get('edit/{id}', 'QuestionController@edit')->name('edit');
        Route::get('delete/{id}', 'QuestionController@delete')->name('delete');

        Route::post('submit', 'QuestionController@submit')->name('submit');
        Route::post('update', 'QuestionController@update')->name('update');

        Route::prefix('option')->name('option.')->group(function(){
        
            Route::get('edit/{id}', 'QuestionController@optionEdit')->name('edit');
            Route::get('delete/{id}', 'QuestionController@optionDelete')->name('delete');
    
            Route::post('submit', 'QuestionController@optionSubmit')->name('submit');
            Route::post('update', 'QuestionController@optionUpdate')->name('update');
            Route::post('correct', 'QuestionController@updateCorrectOption')->name('correct');
    
        });

    });

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
     * Coupon CRUD
     */
    Route::prefix('coupon')->name('coupon.')->group(function(){
        
        Route::get('/', 'CouponController@index')->name('index');
        Route::get('create', 'CouponController@create')->name('create');
        Route::get('edit/{id}', 'CouponController@edit')->name('edit');
        Route::get('delete/{id}', 'CouponController@delete')->name('delete');

        Route::post('submit', 'CouponController@submit')->name('submit');
        Route::post('update', 'CouponController@update')->name('update');

    });


    /**
     * Reward CRUD
     */
    Route::prefix('reward')->name('reward.')->group(function(){
        
        Route::get('/', 'RewardController@index')->name('index');
        Route::get('create', 'RewardController@create')->name('create');
        Route::get('edit/{id}', 'RewardController@edit')->name('edit');
        Route::get('delete/{id}', 'RewardController@delete')->name('delete');

        Route::post('submit', 'RewardController@submit')->name('submit');
        Route::post('update', 'RewardController@update')->name('update');

    });

    /**
     * Redeem CRUD
     */
    Route::prefix('redeem')->name('redeem.')->group(function(){
        Route::get('/{id?}', 'RedeemController@index')->name('index');
    });

    /**
     * Referral CRUD
     */
    Route::prefix('referral')->name('referral.')->group(function(){
        Route::get('/{id?}', 'ReferralRegistrationController@index')->name('index');
    });

    /**
     * Result CRUD
     */
    Route::prefix('result')->name('result.')->group(function(){
        Route::get('/{id?}', 'ResultController@index')->name('index');
    });


    Route::get('get-equation', 'HomeController@getEquation');

    /**
     * Coin CRUD
     */
    Route::prefix('coin')->name('coin.')->group(function(){
        
        // should last route of prefix
        Route::get('/{id?}', 'CoinController@index')->name('index');
    });

        /**
     * Result CRUD
     */
    Route::prefix('contact')->name('contact.')->group(function(){
        Route::get('ajax/{id?}/{userId?}', 'ContactController@ajaxIndex')->name('ajax');
        Route::get('view/{id}', 'ContactController@view')->name('view');
        Route::get('delete/{id}', 'ContactController@delete')->name('delete');
        Route::post('update', 'ContactController@update')->name('update');

        Route::get('/{id?}/{userId?}', 'ContactController@index')->name('index');

    });


});