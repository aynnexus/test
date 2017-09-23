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

Route::group(['prefix'=>'guest'],function(){
	Route::get('s/{site?}','GuestController@index');
	Route::post('/login','GuestController@loginUser');
	Route::get('feedback/{id?}','GuestController@getFeedback');
	Route::post('feedback/{id?}','GuestController@postFeedback');
	Route::get('login/{provider}', 'GuestController@redirectToProvider');
	Route::get('login/{provider}/callback', 'GuestController@handleProviderCallback');
	Route::get('/feedback/guest_age/{field?}','GuestController@socialUserAge');
});

Route::get('/member','MemberController@getlogin');
Route::post('/member','MemberController@postlogin');
Route::get('500',function(){
	return view('frontend.block');
});

Auth::routes();

Route::group(['prefix'=>'dashboard'],function(){
	Route::get('/', 'HomeController@index')->name('home');
	Route::get('/data/{search?}','HomeController@searchData');
	Route::get('/json_index', 'HomeController@jsonIndex');
	Route::group(['middleware'=>'admin','prefix'=>'sites'],function(){
		Route::get('/{search?}','SiteController@index');		
		Route::post('/store/{id?}','SiteController@storeSite');
		Route::get('/remove/{id?}','SiteController@remove');
		Route::get('/status/{status?}/{id?}','SiteController@changeStatusSite');
	});
	Route::group(['prefix'=>'template'],function(){
		Route::get('/','SiteController@indexTemplate');
		Route::get('/step_one/{id?}','SiteController@getSiteImform');
		Route::post('/step_one/{id?}','SiteController@postSiteImform');
		Route::get('/step_two/{id?}','SiteController@getSiteField');
		Route::post('/step_two/{id?}','SiteController@postSiteField');
		Route::get('/step_three/{id?}','SiteController@getSitePhoto');
		Route::post('/step_three/{id?}','SiteController@postSitePhoto');
		Route::get('/step_four/{id?}','SiteController@getFeedback');
		Route::post('/step_four/{id?}','SiteController@postFeedback');
		Route::get('/step_five/{id?}','SiteController@getAds');
		Route::post('/step_five/{id?}','SiteController@postAds');
		Route::get('/step_five/remove/{id?}','SiteController@removeAds');
		Route::get('/preview/{id?}','SiteController@showPreview');
		Route::post('/action/{step}/{id?}','SiteController@store');
		Route::get('/remove/{id?}','SiteController@removeTemplate');
		Route::get('/status/{status?}/{id?}','SiteController@changeStatusTemplate');
	});
	Route::group(['middleware'=>'admin','prefix'=>'clients'],function(){
		Route::get('/','ClientController@index');
		Route::get('/search/{data?}','ClientController@searchData');
		Route::get('/create','ClientController@create');
		Route::get('/edit/{id?}','ClientController@edit');
		Route::post('/create/{id?}','ClientController@store');
		Route::post('/update/{id?}','ClientController@update');
		Route::get('/remove/{id?}','ClientController@remove');
	});
	Route::group(['middleware'=>'admin','prefix'=>'settings'],function(){
		Route::get('/images','SettingController@indexImg');
		Route::post('images/create/{id?}','SettingController@storeImg');
		Route::get('images/remove/{id?}','SettingController@removeImg');
		Route::get('/lookup','SettingController@indexLookup');
		Route::post('/lookup/{id?}','SettingController@storeLookup');
		Route::get('lookup/remove/{id?}','SettingController@removeLookup');
		Route::get('/lookup/{status?}/{id?}','SettingController@changeStatusLookup');
		Route::get('/serveys/{type?}','SettingController@getServey');
		Route::post('/serveys/{type?}/{id?}','SettingController@postServey');
		Route::get('/mail','SettingController@emailTest');
		Route::get('/mailtest','SettingController@emailTesting');
	});

	Route::group(['prefix'=>'guests'],function(){
		Route::get('/{type?}','GuestController@indexLists');
		Route::get('/{id?}','GuestController@getSiteInGuest');
		Route::get('/remove/{id?}','GuestController@removeGuest');
		Route::get('/detail/{id?}','GuestController@detail');
		Route::get('data/{search?}','GuestController@searchData');
		Route::post('/guest_info','GuestController@postExport');
		Route::get('single_detail/{id?}','GuestController@singleDetail');
	});
	Route::group(['middleware'=>'admin','prefix'=>'admin'],function(){
		Route::get('/','AdminController@index');
		Route::get('/remove/{id?}','AdminController@remove');
		Route::post('/update/{id?}','AdminController@update');
		Route::post('/{id}','AdminController@updateSelf');
	});

	Route::post('rate/store/{id?}','SiteController@storeRate');
	Route::post('rate/add/{id?}','SiteController@addRate');
	Route::post('survey/store/{id?}','SiteController@storeSurvey');
	Route::post('survey/add/{id?}','SiteController@addSurvey');	
});
