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
			return View::make('common.message_pg')
				->with('message', '您已经注册过该微信用户。');
		}else{
			return View::make('wxregister.register')
				->with("param",$param)
				->with('typeEnums',WxUser::typeEnums());;
		}
	}

	public function registerPost(){
		$type=Input::get('type');
		if($type=='yz'){
			$idcard = Input::get("idcard");
			$isOwner = UserVerify::isOwner($idcard);
			if($isOwner){
				$arr=Input::all();
				$arr["verified"]='yes';
				$arr["idcard"]=$idcard;
				WxUser::create($arr);
				$param=Input::only('tourl','openid');
				return View::make('wxregister.success')
					->with($param);
			}else{
				$param=Input::only('tourl','openid');
				$param=http_build_query($param);
				$openid=Input::get('openid');
				return Redirect::to('wx/register?openid='.$openid)
					->with("message","对不起，您的身份证没有通过业主认证。</br>请确认您的身份证是否有误。")
					->with("param",$param)
					->withInput();
			}
		}else{
			$arr=Input::all();
			$arr["verified"]='no';
			$arr["idcard"]=null;
			WxUser::create($arr);
			$param=Input::only('tourl','openid');
			return View::make('wxregister.success')
				->with($param);
		}

	}


	public function registerPost_back(){
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