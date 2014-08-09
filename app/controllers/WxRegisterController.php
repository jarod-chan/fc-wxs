<?php
use Illuminate\Support\Facades\View;
class WxRegisterController extends BaseController{

	public function toRegister(){
		$param=http_build_query(Input::all());
 		return View::make('wxregister.toregister')
 			->with('param',$param);
	}

	public function register(){
		$param=http_build_query(Input::all());
		$openid=Input::get('openid');
		$wxuser=WxUser::find($openid);

		if($wxuser){
			Session::flash('message', '您已经注册过该微信用户。');
			return View::make('common.message');
		}else{
			return View::make('wxregister.register')
				->with("param",$param)
				->with('typeEnums',WxUser::typeEnums());;
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

		$param=Input::only('tourl','openid');

 		return View::make('wxregister.success')
 			->with($param);
	}

}