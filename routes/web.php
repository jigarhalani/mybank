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

	Route::get( '/home',  'AccountController@index' );

	Route::group( [ 'prefix' => 'account' ], function () {

		Route::get( '/deposit', 'AccountController@deposit' );
		Route::post( '/deposit', 'AccountController@saveDeposit' );

		Route::get( '/withdraw', 'AccountController@withdraw' );
		Route::post( '/withdraw', 'AccountController@saveWithdraw' );

		Route::get( '/transfer', 'AccountController@transfer' );
		Route::post( '/transfer', 'AccountController@savetransfer' );

		Route::get( '/statement', 'AccountController@statement' );
	} );

} );

