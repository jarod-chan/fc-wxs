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
		$arr=Input::all();

		if($arr['need_verified']=="yes"){
			$name = Input::get("vf_name");
			$idcard =  Input::get("vf_card");
			$firstRoom=UserVerify::firstRoom($name,$idcard);
			if($firstRoom){
				$arr["verified"]='yes';
				$arr['type']='yz';
				$arr["name"]=$name;
				$arr["idcard"]=$idcard;
				$arr["defroom_id"]=$firstRoom->fid;
			}
		}
		$wxUser->fill($arr);
		$wxUser->save();

		return Redirect::action('WxUserController@info', array('openid' => $openid));
	}

	public function verify(){
		$openid = Input::get("openid");
		$name = Input::get("name");
		$idcard =  Input::get("idcard");
		$isOwner = UserVerify::isOwner($name,$idcard);
		if($isOwner){
			return array("result"=>true);
		}else{
			return array("result"=>false);
		}
	}

}