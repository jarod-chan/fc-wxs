<?php
class WxImgController extends BaseController{

	public function toImg($imgname){
		return View::make("wximg.img")
			->with("imgname",$imgname);
	}

}