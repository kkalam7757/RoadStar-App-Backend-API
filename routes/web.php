<?php

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

Route::group(['middleware' => 'admin_auth_check'], function(){

Route::get('/', 'AdminController\LoginController@index');
Route::post('login', 'AdminController\LoginController@login');

});

Route::group(['middleware' => 'admin'], function(){

Route::get('home', 'AdminController\HomeController@index');

# provider section
Route::get('company', 'AdminController\ProviderController@company');
Route::get('driver', 'AdminController\ProviderController@driver');
Route::get('individual', 'AdminController\ProviderController@individual');
Route::get('provider-status/{id?}', 'AdminController\ProviderController@status');
Route::delete('delete-provider/{id}', 'AdminController\ProviderController@delete');
Route::get('view-provider-history/{id}', 'AdminController\ProviderController@view');

# approve document
Route::get('approve/{id}', 'AdminController\ProviderController@approvePage');
Route::get('reject/{id}', 'AdminController\ProviderController@rejectPage');
Route::get('post-status/{id}/{status}', 'AdminController\ProviderController@postStatus');

Route::get('logout', 'AdminController\LoginController@logout');
});




  //Clear Route cache:
Route::get('/clear', function() {
     Artisan::call('config:clear');
     Artisan::call('cache:clear');
     Artisan::call('view:clear');
     Artisan::call('route:clear');
    return '<h1>All Cleared</h1>';
});