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

Route::get( '/', function () {
	return \Illuminate\Support\Facades\Redirect::to( '/login' );
} );


Auth::routes();

Route::middleware( [ 'auth' ] )->group( function () {

	Route::get( '/home', function () {
		return \Illuminate\Support\Facades\Redirect::to( 'building/add' );
	} );

	Route::group( [ 'prefix' => 'building' ], function () {
		Route::get( '/add', 'HomeController@index' );
		Route::post( '/add', 'HomeController@save' );
		Route::get( '/view', 'HomeController@view' );
		Route::get( '/edit/{id}', 'HomeController@edit' );
		Route::get( '/delete/{id}', 'HomeController@delete' );
		Route::post( '/update/{id}', 'HomeController@update' );
	} );

	Route::group( [ 'prefix' => 'room' ], function () {
		Route::get( '/add', 'RoomController@index' );
		Route::post( '/add', 'RoomController@save' );
		Route::get( '/view', 'RoomController@view' );
		Route::get( '/edit/{id}', 'RoomController@edit' );
		Route::get( '/delete/{id}', 'RoomController@delete' );
		Route::post( '/update/{id}', 'RoomController@update' );
	} );

	Route::group( [ 'prefix' => 'tenants' ], function () {
		Route::get( '/add', 'TenantController@index' );
		Route::post( '/add', 'TenantController@save' );
		Route::get( '/view', 'TenantController@view' );
		Route::get( '/edit/{id}', 'TenantController@edit' );
		Route::get( '/delete/{id}', 'TenantController@delete' );
		Route::post( '/update/{id}', 'TenantController@update' );
		Route::get('/getroom/{id}','TenantController@getRoom');
	} );






} );

