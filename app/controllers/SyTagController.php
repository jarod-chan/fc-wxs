<?php

class SyTagController extends BaseController {

	public function index(){
		$syTagSet=SyTag::orderBy('key')->get();
		return View::make('sytag.index')
			->with('syTagSet', $syTagSet);
	}
		
}
