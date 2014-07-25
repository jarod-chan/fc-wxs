<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('wxuser/register','WxUserController@register');

Route::post('wxuser/register','WxUserController@registerPost');

Route::post('wxuser/update','WxUserController@updatePost');


Route::get('complaint','ComplaintController@complaint');

Route::post('complaint','ComplaintController@complaintPost');



Route::get('complaint/list','ComplaintController@index');

Route::get('complaint/deal/{id}','ComplaintController@deal')
	->where('id', '[0-9]+');

Route::post('complaint/deal/{id}','ComplaintController@dealPost')
	->where('id', '[0-9]+');
	
Route::get('accept/list','AcceptController@index');

Route::get('accept/deal/{id}','AcceptController@deal')
	->where('id', '[0-9]+');

Route::post('accept/deal/{id}','AcceptController@dealPost')
	->where('id', '[0-9]+');

Route::get('events/list','EventsController@index');

Route::get('events/deal/{id}','EventsController@deal')
	->where('id', '[0-9]+');

Route::post('events/deal/{id}','EventsController@dealPost')
	->where('id', '[0-9]+');






