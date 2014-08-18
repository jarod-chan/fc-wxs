<?php
class RegisterUserController extends BaseController{


	public function toList(){
		$wxuserSet=WxUser::orderBy("openid")->get();
		return View::make("registeruser.list")
			->with('wxuserSet',$wxuserSet);
	}

	public function toView($openid){
		$wxuser=WxUser::find($openid);
		return View::make("registeruser.view")
		->with('wxuser',$wxuser);
	}

}