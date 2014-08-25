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

//用户登录
Route::get('','LoginController@login');
Route::get('login','LoginController@login');
Route::post('login','LoginController@loginPost');
Route::post('logout','LoginController@logout');

//客户投诉
Route::get('complaint/list',array('uses' =>'ComplaintController@index'));
Route::get('complaint/deal/{id}','ComplaintController@deal');
Route::get('complaint/view/{id}','ComplaintController@view');
Route::post('complaint/deal/{id}/accept','ComplaintController@accept');
Route::post('complaint/deal/{id}/reject','ComplaintController@reject');

//房间选择联动查询
Route::get('selroom/sel','SelRoomController@sel');
Route::get('selroom/sel_buildingunit','SelRoomController@selBuildingunit');

//投诉受理
Route::get('accept/list','AcceptController@index');
Route::get('accept/deal/{id}','AcceptController@deal');
Route::post('accept/deal/{id}','AcceptController@dealPost');

//系统用户
Route::get('syuser/list','SyUserController@toList');
Route::get('syuser/add','SyUserController@toAdd');
Route::get('syuser/edit/{id}','SyUserController@toEdit');
Route::post('syuser/save','SyUserController@save');

//系统标签
Route::get('sytag/list','SyTagController@index');

//投诉状态
Route::get('state/list','StateController@index');
Route::get('state/add','StateController@add');
Route::get('state/edit/{id}','StateController@edit');
Route::post('state/save','StateController@save');
Route::get('state/{id}/userinfo','StateController@userinfo');
Route::post('state/{id}/userinfo','StateController@userinfoPost');

//投诉处理满意度
Route::get('grade/list','GradeController@toList');
Route::get('grade/add','GradeController@toAdd');
Route::get('grade/edit/{id}','GradeController@toEdit');
Route::post('grade/save','GradeController@save');

//注册用户管理
Route::get('registeruser/list','RegisterUserController@toList');
Route::get('registeruser/view/{openid}','RegisterUserController@toView');

//小区管理
Route::get('sellproject/list','SellProjectController@toList');
Route::post('sellproject/switchstate','SellProjectController@switchState');


//配置选项
Route::get('syenum/list','SyenumController@toList');
Route::get('syenum/vals/{type}','SyenumController@toVals');
Route::post('syenum/vals/{type}','SyenumController@saveVal');



//微信获得菜单
Route::get('wx/menu','WxMenuController@service');

//内部员工绑定入口
Route::get('wx/bind','WxBindController@service');
Route::get('wx/binduser','WxBindController@toBindUser');
Route::post('wx/binduser','WxBindController@bindUser');

//用户注册
Route::get('wx/toregister','WxRegisterController@toRegister');
Route::get('wx/register','WxRegisterController@register');
Route::post('wx/register','WxRegisterController@registerPost');

//用户信息
Route::get('wx/user/info','WxUserController@info');
Route::post('wx/user/info','WxUserController@infoPast');
Route::post('wx/user/verify','WxUserController@verify');


//微信投诉
Route::get('wx/complaint','WxComplaintController@complaint');
Route::post('wx/complaint','WxComplaintController@complaintPost');
Route::get('wx/complaint/mycp','WxComplaintController@mycp');
Route::get('wx/complaint/{id}','WxComplaintController@cpitem');


//微信处理投诉（内部人员）
Route::get('wx/accept/add','WxAcceptController@add');
Route::post('wx/accept/add','WxAcceptController@addPost');

Route::get('wx/accept/todo','WxAcceptController@todo');
Route::get('wx/accept/doitem/{id}','WxAcceptController@doitem');
Route::post('wx/accept/doitem/{id}/save','WxAcceptController@dosave');
Route::post('wx/accept/doitem/{id}/commit','WxAcceptController@docommit');

Route::get('wx/accept/history','WxAcceptController@history');
Route::get('wx/accept/history/item/{id}','WxAcceptController@historyitem');





//直接发送处理
Route::get('wx/events/deal/{id}','WxEventsController@deal');
Route::post('wx/events/deal/{id}/save','WxEventsController@save');
Route::post('wx/events/deal/{id}/commit','WxEventsController@commit');

//微信显示图片
Route::get('wx/img/{imgname}','WxImgController@toImg');






