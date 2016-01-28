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
		if(Auth::attempt($credentials))
		{
			return Redirect::to('accept/list');
		}
		else
		{
			return Redirect::to('login')
			->with('login_errors', true);
		}
	}

	public function logout(){
		Auth::logout();
		return Redirect::to('login');
	}
}