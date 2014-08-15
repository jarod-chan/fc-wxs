<?php
class WxAcceptController extends BaseController{

	public function add(){
		$openid=Input::get("openid");
		$stateBeg=State::beg()->first();
		$tagSet=SyTag::lists('name','key');

		return View::make('wxaccept.add')
			->with('openid',$openid)
			->with('communityEnums',Accept::communityEnums())
			->with('areaEnums',Accept::areaEnums())
			->with('buildingEnums',Accept::buildingEnums())
			->with('fromEnums',Accept::fromEnums())
			->with('degreeEnums',Accept::degreeEnums())
			->with('typeEnums',Accept::typeEnums())
			->with('unitEnums',Accept::unitEnums())
			->with('stateBeg',$stateBeg)
			->with('tagSet',$tagSet);
	}

	public function  addPost(){
		$openid=Input::get('openid');
		$syuser=SyUser::where('openid',$openid)->first();

		$arr=Input::all();
		$arr['no']=uniqid();
		$arr['complaint_id']=null;
		$arr['accept_id']=$syuser->id;
		$arr['create_at']=new DateTime();

		$accept=Accept::create($arr);

		if (Input::has('file'))
		{
			C::save_files('sy_accept',$accept->id,Input::get('file'));
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

		Session::flash('message', '投诉已经受理！');
		return View::make('common.message');
	}

	public function history(){
		if(Input::has('openid')){
			$openid=Input::get('openid');
			$syuser=SyUser::where('openid',$openid)->first();
		}
		if(Input::has('syuserid')){
			$syuser=SyUser::find(Input::get('syuserid'));
		}

		$acceptBy=Accept::where('accept_id',$syuser->id);

		$acceptSet = Accept::where('accept_id',$syuser->id)
			->orWhereHas('events', function($q) use ($syuser)
			{
				$q->where('deal_id', $syuser->id)
				->whereNotNull('commit_at');
			})
			->get();

		return View::make('wxaccept.history')
		->with('acceptSet',$acceptSet)
		->with('syuserid',$syuser->id);
	}

	public function historyItem($id){
		$accept_id=$id;
		$accept=Accept::find($accept_id);

		$accept_view=SpAccept::toView($accept);
		$event_history=SpAccept::toEventsHistory ($accept_id);

		return View::make('wxaccept.historyitem')
		->with('accept_view',$accept_view)
		->with('event_history',$event_history);
	}

	public function  todo(){
		if(Input::has('openid')){
			$openid=Input::get('openid');
			$syuser=SyUser::where('openid',$openid)->first();
		}
		if(Input::has('syuserid')){
			$syuser=SyUser::find(Input::get('syuserid'));
		}
		$acceptSet = Accept::whereHas('events', function($q) use ($syuser)
			{
				$q->where('deal_id', $syuser->id)
				->whereNull('commit_at');

			})
			->get();

		return View::make('wxaccept.todo')
			->with('acceptSet',$acceptSet)
			->with('syuserid',$syuser->id);
	}

	public  function  doitem($id){
		$accept_id=$id;
		$syuserid=Input::get('syuserid');

		$accept=Accept::find($accept_id);

		$event=Accept::find($accept_id)
			->events()
			->whereNull('commit_at')
			->where('deal_id',$syuserid)
			->orderBy('create_at')
			->first();

		$event_deal=SpEvents::toDeal($event, $accept);

		$accept_view=SpAccept::toView($accept);

		$event_history=SpAccept::toEventsHistory ($event->accept_id);

		return View::make('wxaccept.doitem')
			->with('accept_view',$accept_view)
			->with('event_deal',$event_deal)
			->with('event_history',$event_history)
			->with('event',$event);
	}



	public function dosave($id){
		$event=SpEvents::saveEvent($id);

		Session::flash('message', '保存成功！');
		return  Redirect::action('WxAcceptController@todo',array('syuserid'=>$event->deal_id));
	}

	public function docommit($id){

		SpEvents::commitEvent($id);
		$event=Events::find($id);

		Session::flash('message', '提交成功！');
		return  Redirect::action('WxAcceptController@todo',array('syuserid'=>$event->deal_id));
	}

}