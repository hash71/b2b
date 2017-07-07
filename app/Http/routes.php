<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('test', function () {
    return $path = url('/').'/images/featured_images/'; //relative path, not absolute;
});

/***************************** Public Routes ***********************************/
Route::get('/', 'PublicViewController@getHome');
Route::get('company-profile/{id?}', 'PublicViewController@getCompanyProfile');

Route::get('post-list/{type?}', 'PublicViewController@getPostList');
Route::get('post-show/{id?}', 'PublicViewController@getPostShow');

Route::get('/sourcing-request', 'FeedbackController@getSourcingRequest');
Route::post('/sourcing-request', 'FeedbackController@postSourcingRequest');

Route::controller('reqs', 'RequestingController');
Route::controller('search', 'SearchController');
Route::get('single-product/{id?}','PublicViewController@getSingleProduct');
Route::get('single-buying-request/{id?}','PublicViewController@getSingleBuyingRequest');
Route::post('user-inquiry','PublicViewController@postUserInquiry');

Route::controller('buying-request','BuyingOffersController');

Route::get('/product-details', function () {
    return view('publicview.product-details');
});

Route::get('404-error',function(){
    return view('errors.404');
});

Route::get('chat', function () {
    return time();

});

Route::controller('auth', 'Auth\AuthController');
// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');


/******************** Authenticated Routes *************************************/
Route::group(['middleware' => 'auth'], function () {

    Route::get('showmyprofile', function () {
        return view('userview.profile.show-profile');
    });

    Route::get('/dashboard', function () {
        return view('userview.dashboard');
    });

    Route::controller('profile', 'ProfileController');

    Route::controller('products', 'ProductsController');

    Route::controller('message', 'MessageController');

    Route::controller('feedback', 'FeedbackController');

    Route::group(['middleware' => 'admin'], function () {
        Route::controller('approve', 'ApproveController');
        Route::controller('post', 'PostsController');
        Route::controller('settings', 'SettingsController');
        Route::controller('category', 'CategoriesController');
        Route::controller('member', 'MemberController');
    });
});
