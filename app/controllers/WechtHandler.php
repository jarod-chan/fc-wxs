<?php

/**
 *返回内部员工绑定入口
 */
class WBind {

	public function isPattern($content) {
		return $content == '绑定';
	}

	public function deal($openid) {
		return "<a href=\"".URL::to('wx/binduser?openid='.$openid)."\">内部员工绑定入口</a>";
	}
}


/**
 * 返回客户的操作菜单
 */
class WMenu {

	public function deal($openid) {
		$result=$this->service($openid);

		if ($result['result']) {
			$server_content=$result['data'];
			$items = array(
					new NewsResponseItem('客户投诉', '方远房产', URL::to('wechatimg/main.jpg'),'')
			);
			for ($i=0; $i < count($server_content); $i++) {
				$name = $server_content[$i]['name'];
				$url = $server_content[$i]['url'];
				$key = $server_content[$i]['key'];
				$items_tmp = array(new NewsResponseItem($name, '方远房产', URL::to("wechatimg/$key.jpg"), $url));
				$items = array_merge($items, $items_tmp);
			}
			$result['data']=$items;
		}
		return  $result;
	}


	//一下代码从WxMenuController复制，值修改了service的参数
	public function service($openid){

		if($this->isEmployee($openid)){
			return array(
					'result'=>true,
					'data'=>array(
							array('name'=>'新增诉求受理','url'=>URL::to('wx/accept/add?openid='.$openid),'key'=>"add"),
							array('name'=>'待处理投诉','url'=>URL::to('wx/accept/todo?openid='.$openid),'key'=>"todo"),
							array('name'=>'历史投诉','url'=>URL::to('wx/accept/history?openid='.$openid),'key'=>"done")
					)
			);
		}

		$wxUser=WxUser::where('openid',$openid)->first();

		if($this->notRegister($wxUser)){
			return array(
					'result'=>false,
					'data'=>"只有注册的[业主用户]才能进行客户诉求，<a href=\"".URL::to('/wx/register?openid='.$openid)."\">点此跳转注册页面</a>"
			);
		}

		if ($this->registerAndNotVerified($wxUser)) {
			return array(
					'result'=>false,
					'data'=>"您的用户类型是[".$wxUser->getTypeVal()."]，只有用户类型为[业主]的用户才能进行客户诉求，<a href=\"".URL::to('wx/user/info?openid='.$openid)."\">点此跳转认证成为业主页面</a>"
			);
		}

		if ($this->registerAndVerified($wxUser)) {
			return array(
					'result'=>true,
					'data'=>array(
							array('name'=>'新增投诉','url'=>URL::to('wx/complaint?openid='.$openid),'key'=>'add'),
							array('name'=>'历史投诉','url'=>URL::to('wx/complaint/mycp?openid='.$openid),'key'=>'done')
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



