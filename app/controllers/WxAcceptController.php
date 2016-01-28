<?php
class WxAcceptController extends BaseController{

	public function add(){
		$openid=Input::get("openid");

		$currState=State::init()->first();
		$stateBeg=State::nextState($currState)->first();

		$tagSet=SyTag::lists('name','key');

		return View::make('wxaccept.add')
			->with('openid',$openid)
			->with('sellProjectSet',UserVerify::sellProject())
			->with('fromEnums',Accept::fromEnums())
			->with('degreeEnums',Accept::degreeEnums())
			->with('typeEnums',Accept::typeEnums())
			->with('stateBeg',$stateBeg)
			->with('tagSet',$tagSet);
	}

	public function  addPost(){
		$openid=Input::get('openid');
		$syuser=SyUser::where('openid',$openid)->first();

		SpAccept::addAccept($syuser);

		return View::make('common.message_pg')
			->with('message', '投诉已经受理！');
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