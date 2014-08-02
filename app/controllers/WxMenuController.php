<?php
class WxMenuController extends BaseController{
	
	public function menu(){
		$openid=Input::get("openid");
		$syUser=SyUser::where("openid",$openid)->first();
		if($syUser){
			return array(
				array('name'=>'新增投诉受理','url'=>URL::to('accept/add?openid='.$openid)),
				array('name'=>'待处理投诉','url'=>URL::to('accept/todo?openid='.$openid)),
				array('name'=>'历史投诉','url'=>URL::to('accept/history?openid='.$openid))
			);
		}else{
			return array(
				array('name'=>'新增投诉','url'=>URL::to('complaint?openid='.$openid)),
				array('name'=>'历史投诉','url'=>URL::to('complaint/mycp?openid='.$openid))
			);
		}
	}
	
}