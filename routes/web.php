<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Blade (front-end) Routes
|--------------------------------------------------------------------------
|
| Here is we write all routes which are related to web pages
| like UserManagement interfaces, Diagrams and others
|
*/

// Default laravel auth routes
Auth::routes();

Route::get('/test/env', function () {
    dd(env('DB_PASSWORD')); // Dump 'db' variable value one by one
});

//Welcome page
Route::get('/', function () {
    return view('welcome');
});

//Route::get('/','CategoryController@index')->name('categoryIndex');

// Change language session condition
Route::get('/language/{lang}',function ($lang){
    $lang = strtolower($lang);
    if ($lang == 'ru' || $lang == 'uz')
    {
        session([
            'locale' => $lang
        ]);
    }
    return redirect()->back();
});

Route::resource('card','Admin\CardController',['except' => []]);

// Web pages
Route::group(['namespace'=>'Blade','middleware' => 'auth'],function (){

    // there should be graphics, diograms about total conditions
    Route::get('/home', 'HomeController@index')->name('home');

    // Users
    Route::get('/users','UserController@index')->name('userIndex');
    Route::get('/user/add','UserController@add')->name('userAdd');
    Route::post('/user/create','UserController@create')->name('userCreate');
    Route::get('/user/{id}/edit','UserController@edit')->name('userEdit');
    Route::post('/user/update/{id}','UserController@update')->name('userUpdate');
    Route::delete('/user/delete/{id}','UserController@destroy')->name('userDestroy');

    // Permissions
    Route::get('/permissions','PermissionController@index')->name('permissionIndex');
    Route::get('/permission/add','PermissionController@add')->name('permissionAdd');
    Route::post('/permission/create','PermissionController@create')->name('permissionCreate');
    Route::get('/permission/{id}/edit','PermissionController@edit')->name('permissionEdit');
    Route::post('/permission/update/{id}','PermissionController@update')->name('permissionUpdate');
    Route::delete('/permission/delete/{id}','PermissionController@destroy')->name('permissionDestroy');

    // Roles
    Route::get('/roles','RoleController@index')->name('roleIndex');
    Route::get('/role/add','RoleController@add')->name('roleAdd');
    Route::post('/role/create','RoleController@create')->name('roleCreate');
    Route::get('/role/{role_id}/edit','RoleController@edit')->name('roleEdit');
    Route::post('/role/update/{role_id}','RoleController@update')->name('roleUpdate');
    Route::delete('/role/delete/{id}','RoleController@destroy')->name('roleDestroy');

    //Category
    Route::get('/category','CategoryController@index')->name('categoryIndex');
    Route::get('/category/add','CategoryController@add')->name('categoryAdd');
    Route::post('/category/create','CategoryController@create')->name('categoryCreate');
    Route::get('/category/{category_id}/edit','CategoryController@edit')->name('categoryEdit');
    Route::post('/category/update/{category_id}','CategoryController@update')->name('categoryUpdate');
    Route::delete('/category/delete/{id}','CategoryController@destroy')->name('categoryDestroy');

    //Product
    Route::get('/product','ProductController@index')->name('productIndex');
    Route::get('/product/add','ProductController@add')->name('productAdd');
    Route::post('/product/create','ProductController@create')->name('productCreate');
    Route::get('/product/{product_id}/edit','ProductController@edit')->name('productEdit');
    Route::post('/product/update/{product_id}','ProductController@update')->name('productUpdate');
    Route::delete('/product/delete/{id}','ProductController@destroy')->name('productDestroy');

    //Oredrs
    Route::get('/order','OrderController@index')->name('orderIndex');
    Route::post('/order/status','OrderController@status')->name('orderStatus');

    //Botusers
    Route::get('/botusers','BotuserController@index')->name('botuserIndex');
    Route::get('/botusers/{botuser_id}/edit','BotuserController@edit')->name('botuserEdit');
    Route::post('/botusers/update/{botuser_id}','BotuserController@update')->name('botuserUpdate');
    Route::get('/botusers/{botuser_id}/show','BotuserController@show')->name('botuserShow');

    Route::get('/botusers/{botuser_id}/editaddress','BotuserController@editaddress')->name('botuserEditaddress');
    Route::post('/botusers/updateaddress/{botuser_id}','BotuserController@updateaddress')->name('botuserUpdateaddress');


    //Complaint
    Route::get('/complaint','ComplaintController@index')->name('complaintIndex');

    //Mailings
    Route::get('/mailing','MailingController@index')->name('mailingIndex');
    Route::get('/mailing/add','MailingController@add')->name('mailingAdd');
    Route::post('/mailing/create','MailingController@create')->name('mailingCreate');
    Route::get('/mailing/{mailing_id}/edit','MailingController@edit')->name('mailingEdit');
    Route::post('/mailing/update/{mailing_id}','MailingController@update')->name('mailingUpdate');
    Route::delete('/mailing/delete/{id}','MailingController@destroy')->name('mailingDestroy');
    Route::post('/mailing/status','MailingController@status')->name('mailingStatus');

    //get jowi products
    Route::get('/jowiproducts','CategoryController@jowiproducts')->name('jowiProducts');

    //settings
    Route::get('/settings', 'SettingsController@index')->name('settingsMain');
    Route::get('/settings/edit','SettingsController@edit')->name('settingsEdit');
    Route::post('/settings/update','SettingsController@update')->name('settingsUpdate');
});

/*
|--------------------------------------------------------------------------
| This is the end of Blade (front-end) Routes
|-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\
*/
