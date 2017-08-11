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

Route::get('/', function () {
    return redirect('login');
});

Route::get('/member', function () {
    return view('auth.member_login');
});

Auth::routes();

Route::group(['prefix'=>'dashboard'],function(){
	Route::get('/', 'HomeController@index')->name('home');
	Route::group(['prefix'=>'sites'],function(){
		Route::get('/','SiteController@index');
		Route::get('/step_one/{id?}','SiteController@getSiteImform');
		Route::post('/step_one/{id?}','SiteController@postSiteImform');
		Route::get('/step_two/{id?}','SiteController@getSiteField');
		Route::post('/step_two/{id?}','SiteController@postSiteField');
		Route::get('/step_three/{id?}','SiteController@getSitePhoto');
		Route::post('/step_three/{id?}','SiteController@postSitePhoto');
		Route::get('/step_four/{id?}','SiteController@showPreview');
		Route::post('/action/{step}/{id?}','SiteController@store');
		Route::get('/remove/{id?}','SiteController@remove');
	});
	Route::group(['prefix'=>'clients'],function(){
		Route::get('/','ClientController@index');
		Route::get('/create','ClientController@create');
		Route::get('/edit/{id?}','ClientController@edit');
		Route::post('/create/{id?}','ClientController@store');
		Route::get('/remove/{id?}','ClientController@remove');
	});
	Route::group(['prefix'=>'settings'],function(){
		Route::get('/images','SettingController@indexImg');
		Route::post('images/create/{id?}','SettingController@storeImg');
		Route::get('images/remove/{id?}','SettingController@removeImg');
	});
});
