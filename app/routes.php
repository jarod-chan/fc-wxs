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
Route::get('','SyUserController@login');

Route::get('login','SyUserController@login');

Route::post('login','SyUserController@loginPost');



Route::get('state/list','StateController@index');

Route::get('state/add','StateController@add');

Route::get('state/edit/{id}','StateController@edit')
	->where('id', '[0-9]+');

Route::post('state/save','StateController@save');


Route::get('syuser/list','SyUserController@index');

Route::get('syuser/add','SyUserController@add');

Route::post('syuser/add','SyUserController@addPost');

Route::get('syuser/edit/{id}','SyUserController@edit')
	->where('id', '[0-9]+');

Route::post('syuser/edit/{id}','SyUserController@editPost')
	->where('id', '[0-9]+');



Route::get('wxuser/register','WxUserController@register');

Route::post('wxuser/register','WxUserController@registerPost');

Route::post('wxuser/update','WxUserController@updatePost');


Route::get('complaint','ComplaintController@complaint');

Route::post('complaint','ComplaintController@complaintPost');

Route::get('complaint/mycp','ComplaintController@mycp');

Route::get('complaint/{id}','ComplaintController@cpitem')
	->where('id', '[0-9]+');



Route::get('complaint/list','ComplaintController@index');

Route::get('complaint/deal/{id}','ComplaintController@deal')
	->where('id', '[0-9]+');
	
Route::get('complaint/view/{id}','ComplaintController@view')
	->where('id', '[0-9]+');

Route::post('complaint/deal/{id}/accept','ComplaintController@accept')
	->where('id', '[0-9]+');

Route::post('complaint/deal/{id}/reject','ComplaintController@reject')
	->where('id', '[0-9]+');

	
Route::get('accept/list','AcceptController@index');

Route::get('accept/deal/{id}','AcceptController@deal')
	->where('id', '[0-9]+');

Route::post('accept/deal/{id}','AcceptController@dealPost')
	->where('id', '[0-9]+');

	
	
	
Route::get('events/list','EventsController@index');

Route::get('events/deal/{id}','EventsController@deal')
	->where('id', '[0-9]+');

Route::post('events/deal/{id}/save','EventsController@save')
	->where('id', '[0-9]+');

Route::post('events/deal/{id}/commit','EventsController@commit')
	->where('id', '[0-9]+');






