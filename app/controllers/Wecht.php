<?php
include_once "WechtHandler.php";

class Wecht extends Wechat {

	protected function onText() {
		$openid = $this->getRequest ( 'FromUserName' );
		$content = trim ( $this->getRequest ( 'content' ) );

		$handler = new WBind();
		if ($handler->isPattern($content)) {
			$result =  $handler->deal($openid);
			$this->responseText($result);
		}

		$handler = new WMenu();
		$result =  $handler->deal($openid);
		$data=$result['data'];
		if ($result['result']) {
			$this->responseNews($data);
		}else{
			$this->responseText($data);
		}

	}
}