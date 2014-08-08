<?php
class WxMenuController extends BaseController{
	
	public function menu(){
		$openid=Input::get("openid");
		
		if($this->isEmployee($openid)){
			return array(
				'result'=>true,
				'data'=>array(
						array('name'=>'新增投诉受理','url'=>URL::to('wx/accept/add?openid='.$openid)),
						array('name'=>'待处理投诉','url'=>URL::to('wx/accept/todo?openid='.$openid)),
						array('name'=>'历史投诉','url'=>URL::to('wx/accept/history?openid='.$openid))
				)
			);
		}
		
		$wxUser=WxUser::where('openid',$openid)->first();
		
		if($this->notRegister($wxUser)){
			return array(
				'result'=>false,
				'data'=>"只有认证的注册用户才能进行微信投诉，<a href=\"".URL::to('/wx/register?openid='.$openid)."\">点此跳转注册页面</a>"
			);
		}
		
		if ($this->registerAndNotVerified($wxUser)) {
			return array(
				'result'=>true,
				'data'=>"只有认证的注册用户才能进行微信投诉，<a href=\"".URL::to('wx/user/info?openid='.$openid)."\">点此跳转认证页面</a>"
			);
		}
		
		if ($this->registerAndVerified($wxUser)) {
			return array(
				'result'=>true,
				'data'=>array(
						array('name'=>'新增投诉','url'=>URL::to('wx/complaint?openid='.$openid)),
						array('name'=>'历史投诉','url'=>URL::to('wx/complaint/mycp?openid='.$openid))
				)
			);
		}
		
	}
	
	private function isEmployee($openid){
		$syUser=SyUser::where("openid",$openid)->first();
		return $syUser!=null;
	}
	
	private function notRegister($wxUser){
		return $wxUser==null;
	}
	
	private function registerAndVerified($wxUser){
		return $wxUser->isVerified();
	}
	
	private function registerAndNotVerified($wxUser){
		return !$wxUser->isVerified();
	}
	
}