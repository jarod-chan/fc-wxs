<?php

class UserController extends BaseController {

	public function index()
	{
		$users = User::all();
		return View::make('user.index')->with('users',$users);
	}

}
