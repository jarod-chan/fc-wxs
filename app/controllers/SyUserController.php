<?php

use Illuminate\Support\Facades\Redirect;
class SyUserController extends BaseController {

	public function login()
	{
		return View::make('syuser.login');
	}
	
	public function loginPost(){

		$email = Input::get('email');
		$password = Input::get('password');

		$credentials = array('email' => $email, 'password' => $password);
		if(Auth::attempt($credentials))
		{
			return Redirect::to('complaint/list');
		}
		else
		{
			return Redirect::to('login')
			->with('login_errors', true);
		}
	}
	
	
	public function index(){
		$syuserSet=SyUser::all();
		return View::make('syuser.index')
			->with('syuserSet', $syuserSet);
	}
	
	public function add(){
		return View::make('syuser.add')
			->with('roleEnums',SyUser::roleEnums());
	}
	
	public function addPost(){
		$arr=Input::all();
		$arr["password"]="";
		SyUser::create($arr);
		Session::flash('message', '保存成功');
		return Redirect::to("syuser/list");
	}
	
	public function edit($id){
		$syuser=SyUser::find($id);
		return View::make('syuser.edit')
			->with('syuser',$syuser)
			->with('roleEnums',SyUser::roleEnums());
	}
	
	public function editPost($id){
		$syuser=SyUser::find($id);
		$arr=Input::all();
		$syuser->fill($arr);
		$syuser->save();
		Session::flash('message', '保存成功');
		return Redirect::to("syuser/list");
	}
	
}
