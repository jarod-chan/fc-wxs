<?php
class WxMenuController extends BaseController{

	public function service(){
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
				'data'=>"只有注册的[业主用户]才能进行客户投诉，<a href=\"".URL::to('/wx/register?openid='.$openid)."\">点此跳转注册页面</a>"
			);
		}

		if ($this->registerAndNotVerified($wxUser)) {
			return array(
				'result'=>false,
				'data'=>"您的用户类型是[".$wxUser->getTypeVal()."]，只有用户类型为[业主]的用户才能进行客户投诉，<a href=\"".URL::to('wx/user/info?openid='.$openid)."\">点此跳转认证成为业主页面</a>"
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