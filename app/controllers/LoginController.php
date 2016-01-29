<?php
class LoginController extends BaseController{

	public function login()
	{
		return View::make('login.login');
	}

	public function loginPost(){

		$name = Input::get('name');
		$password = Input::get('password');

		$credentials = array('name' => $name, 'password' => $password);

		if (Auth::validate($credentials)){
			$syUser=SyUser::where('name',$name)->first();
			if($syUser->role=='admin'||$syUser->inState('init')){
				Auth::login($syUser);
				return Redirect::to('accept/list');
			}
		}

		return Redirect::to('login')
			->with('login_errors', true);

	}

	public function logout(){
		Auth::logout();
		return Redirect::to('login');
	}
}