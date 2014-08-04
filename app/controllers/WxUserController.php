<?php

class WxUserController extends BaseController{

	//微信用户的注册页面
	public function info()
	{
		$openid=Input::get('openid');
		$wxUser=WxUser::find($openid); 

		if($wxUser){
			return View::make('wxuser.update')
			->with('openid',$openid)
			->with('typeEnums',WxUser::typeEnums())
			->with('wxUser',$wxUser);
		}else{
			return Redirect::action('WxRegisterController@toRegister', array('openid' => $openid,'tourl'=>'wx/user/info'));
		}	
	}


	public function infoPast(){
		$openid=Input::get('openid');
		$wxUser=WxUser::find($openid); 

		$wxUser->phone = Input::get('phone');
		$wxUser->email = Input::get('email');
		$wxUser->profession = Input::get('profession');	
		$wxUser->interest = Input::get('interest');
		$wxUser->verified = Input::get('verified');
		$wxUser->address = Input::get('address');
		
		$wxUser->save();

		return Redirect::action('WxUserController@info', array('openid' => $openid));
	}

}