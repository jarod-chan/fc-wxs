<?php
class AcceptController extends BaseController{

	public function toList(){
		$syUser = Auth::user();
 		if($syUser->role=='admin'){
			$acceptSet=Accept::orderBy("id","desc")
			->get();
		}
		if($syUser->inState('init')){
			$acceptSet=Accept::where('accept_id',$syUser->id)
			->orderBy("id","desc")
			->get();
		}

		return View::make('accept.list')
		->with('acceptSet',$acceptSet);
	}

	public function toAdd(){
		$view=View::make('accept.add');

		$currState=State::init()->first();
		$stateBeg=State::nextState($currState)->first();
		$view->with('stateBeg',$stateBeg);

		$view->with('sellProjectSet',UserVerify::sellProject());

		$view
		->with('fromEnums',Accept::fromEnums())
		->with('degreeEnums',Accept::degreeEnums())
		->with('typeEnums',Accept::typeEnums());

		return $view;
	}

	public function add(){
		//作为受理人
		$syuser = Auth::user();
		SpAccept::addAccept($syuser);

		Session::flash('message', '保存成功');
		return Redirect::action('AcceptController@toList');
	}

	public function toDeal($id){
		$accept=Accept::find($id);
		$eventHistory=Events::where('accept_id',$accept->id)
			->orderBy('id','desc')
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





}