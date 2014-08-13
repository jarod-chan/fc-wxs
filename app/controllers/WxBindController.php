<?php
class WxBindController extends BaseController{

		public function service(){
			$openid=Input::get("openid");
			return array(
				'result'=>false,
				'data'=>"<a href=\"".URL::to('wx/binduser?openid='.$openid)."\">内部员工绑定入口</a>"
			);
		}

		public function  toBindUser(){
			$openid=Input::get("openid");
			$syUser=SyUser::where("openid",$openid)->first();
			if(!$syUser){
				$syUser=new SyUser;
			}
			return View::make('wxbind.binduser')
			->with('syuser',$syUser)
			->with('openid',$openid);
		}

		public function  bindUser(){
			$name=Input::get("name");
			$openid=Input::get("openid");
			$syUser=Syuser::where("name",$name)->first();
			if($syUser){
				$syUser->openid=$openid;
				$syUser->save();
				$syuser_id=Input::get("syuser_id");
				if(!empty($syuser_id)){
					Syuser::find($syuser_id)->update(array("openid"=>null));
				}
				Session::flash('message', '绑定成功！');
				return View::make("common.message");
			}else{
				Session::flash('message', '绑定失败，你输入的姓名有误！');
				return View::make("common.message")
				->with("back",true);
			}
		}
}