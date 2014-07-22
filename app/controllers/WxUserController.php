<?php

class WxUserController extends BaseController{

	//微信用户的注册页面
	public function register()
	{
		$openid=Input::get('openid');
		$wxUser=WxUser::find($openid); 

		if($wxUser){
			return View::make('wxuser.update')
			->with('openid',$openid)
			->with('typeEnums',WxUser::typeEnums())
			->with('wxUser',$wxUser);
		}else{
			return View::make('wxuser.register')
			->with('openid',$openid)
			->with('typeEnums',WxUser::typeEnums());
		}	
	}


	public function registerPost(){
		$openid=Input::get('openid');
		$idcard=Input::get('idcard');
		if(empty($idcard)){
			$verified='no';
		}else{
			$verified='yes';
		}
		$arr=array(
			'openid'=>$openid,
			'type'=>Input::get('type'),
			'name'=>Input::get('name'),
			'phone'=>Input::get('phone'),
			'email'=>Input::get('email'),
			'idcard'=>$idcard,
			'verified'=>$verified
		);
		$wxUser=new WxUser();
		$wxUser->fill($arr);
		$result=$wxUser->save();
		
		return Redirect::action('WxUserController@register', array('openid' => $openid));
	}


	public function updatePost(){
		$openid=Input::get('openid');
		$wxUser=WxUser::find($openid); 

		$wxUser->phone = Input::get('phone');
		$wxUser->email = Input::get('email');
		$wxUser->profession = Input::get('profession');	
		$wxUser->interest = Input::get('interest');
		$wxUser->verified = Input::get('verified');
		$wxUser->address = Input::get('address');
		
		$wxUser->save();

		return Redirect::action('WxUserController@register', array('openid' => $openid));
	}

}