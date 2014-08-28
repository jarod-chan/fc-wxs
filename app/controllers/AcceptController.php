<?php
class AcceptController extends BaseController{

	public function toList(){
		$acceptSet=Accept::orderBy("id","desc")
			->get();
		return View::make('accept.list')
		->with('acceptSet',$acceptSet);
	}

	public function toDeal($id){
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

	public function deal($id){
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

	public function toAdd(){
		$view=View::make('accept.add');

		$stateBeg=State::beg()->first();
		$tagSet=SyTag::lists('name','key');
		$view->with('stateBeg',$stateBeg)
		->with('tagSet',$tagSet);

		$view->with('sellProjectSet',UserVerify::sellProject());

		$view
		->with('fromEnums',Accept::fromEnums())
		->with('degreeEnums',Accept::degreeEnums())
		->with('typeEnums',Accept::typeEnums());

		return $view;
	}

	public function add(){

		$arr=Input::all();
		$arr['complaint_id']=null;
		$arr['create_at']=new DateTime();

		//作为受理人
		$syuser = Auth::user();
		if($syuser){
			$arr['accept_id']=$syuser->id;
		}

		$accept=Accept::create($arr);

		//保存相关附件
		if (Input::has('file'))
		{
			C::save_fileable($accept,Input::get('file'));
		}


		//生成下一个节点处理人
		$next_id=Input::get("next_id");
		$state_id=Input::get("next_state_id");
		$arr=array(
				'state_id'=>$state_id,
				'deal_id'=>$next_id,
				'create_at'=>new Datetime(),
				'accept_id'=>$accept->id
		);
		$nextEvent=Events::create($arr);


		Session::flash('message', '保存成功');
		return Redirect::action('AcceptController@toList');
	}

}