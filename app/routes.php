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

Route::pattern('id', '[0-9]+');

Route::get('','LoginController@login');

Route::get('login','LoginController@login');

Route::post('login','LoginController@loginPost');

Route::post('logout','LoginController@logout');

//系统标签
Route::get('sytag/list','SyTagController@index');


//微信获得菜单
Route::get('wx/menu','WxMenuController@menu');


//用户注册
Route::get('wx/toregister','WxRegisterController@toRegister');
Route::get('wx/register','WxRegisterController@register');
Route::post('wx/register','WxRegisterController@registerPost');


//用户信息
Route::get('wx/user/info','WxUserController@info');
Route::post('wx/user/info','WxUserController@infoPast');


//投诉状态
Route::get('state/list','StateController@index');
Route::get('state/add','StateController@add');
Route::get('state/edit/{id}','StateController@edit');
Route::post('state/save','StateController@save');
Route::get('state/{id}/userinfo','StateController@userinfo');
Route::post('state/{id}/userinfo','StateController@userinfoPost');



Route::get('syuser/list','SyUserController@index');

Route::get('syuser/add','SyUserController@add');

Route::get('syuser/edit/{id}','SyUserController@edit')
	->where('id', '[0-9]+');

Route::post('syuser/save','SyUserController@save');






Route::get('complaint','ComplaintController@complaint');

Route::post('complaint','ComplaintController@complaintPost');

Route::get('complaint/mycp','ComplaintController@mycp');

Route::get('complaint/{id}','ComplaintController@cpitem')
	->where('id', '[0-9]+');



Route::get('complaint/list',array('uses' =>'ComplaintController@index'));

Route::get('complaint/deal/{id}','ComplaintController@deal')
	->where('id', '[0-9]+');
	
Route::get('complaint/view/{id}','ComplaintController@view')
	->where('id', '[0-9]+');

Route::post('complaint/deal/{id}/accept','ComplaintController@accept')
	->where('id', '[0-9]+');

Route::post('complaint/deal/{id}/reject','ComplaintController@reject')
	->where('id', '[0-9]+');

	
Route::get('accept/list','AcceptController@index');



Route::get('accept/deal/{id}','AcceptController@deal');
Route::post('accept/deal/{id}','AcceptController@dealPost');

	
Route::get('accept/add','AcceptController@add');

Route::post('accept/add','AcceptController@addPost');

Route::get('accept/history','AcceptController@history');

Route::get('accept/history/item/{id}','AcceptController@historyitem')
	->where('id', '[0-9]+');


Route::get('accept/todo','AcceptController@todo');

Route::get('accept/doitem/{id}','AcceptController@doitem')
	->where('id', '[0-9]+');;

Route::post('accept/doitem/{id}/save','AcceptController@dosave')
	->where('id', '[0-9]+');

Route::post('accept/doitem/{id}/commit','AcceptController@docommit')
	->where('id', '[0-9]+');
	
	


Route::get('wx/events/deal/{id}','WxEventsController@deal');
Route::post('wx/events/deal/{id}/save','WxEventsController@save');
Route::post('wx/events/deal/{id}/commit','WxEventsController@commit');






