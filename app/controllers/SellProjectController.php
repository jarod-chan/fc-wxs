<?php
class SellProjectController extends BaseController{

	public function toList(){
		$sellProjectSet=EasSellproject::orderBy("fname_l2")
		->get();
		return View::make("sellproject.list")
		->with('sellProjectSet',$sellProjectSet);
	}

	public function switchState(){
		$id=Input::get("id");
		$sellProject=EasSellproject::find($id);
		if($sellProject->state=='on'){
			$sellProject->state='off';
		}else{
			$sellProject->state='on';
		}
		$sellProject->save();
		Session::flash('message', '操作成功');
		return Redirect::to("sellproject/list");
	}
}