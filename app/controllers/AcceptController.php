<?php
class AcceptController extends BaseController{

	public function index(){
		$acceptSet=Accept::orderBy("id")
			->get();
		return View::make('accept.index')
		->with('acceptSet',$acceptSet);
	}

	public function deal($id){
		$accept=Accept::find($id);
		$eventHistory=Events::where('accept_id',$accept->id)
			->orderBy('create_at','desc')
			->get();

		$dealUserSet=SyUser::dealUser()->lists('name','id');

		return View::make('accept.deal')
			->with('accept',$accept)
			->with('eventHistory',$eventHistory)
			->with('dealUserSet',$dealUserSet);
	}

	public function dealPost($id){
		$deal_id=Input::get('deal_id');
		$arr=array(
			'deal_id'=>$deal_id,
			'create_at'=>new Datetime(),
			'accept_id'=>$id
		);
		$event=Events::create($arr);
		Session::flash('message', '保存成功');
		return Redirect::action('AcceptController@index');
	}

}