<?php
class WxEventsController extends BaseController{




	public function deal($id){
		if(Session::has('message')){
			return View::make('wxevents.message')
				->with('eventId',$id);
		}

		$event=Events::find($id);
		$accept=Accept::find($event->accept_id);

		$event_deal=SpEvents::toDeal($event, $accept);

		$accept_view=SpAccept::toView($accept);

		$event_history=SpAccept::toEventsHistory ($event->accept_id);


		return View::make('wxevents.deal')
			->with('accept_view',$accept_view)
			->with('event_deal',$event_deal)
			->with('event_history',$event_history)
			->with('event',$event);

	}




	public function save($id){

		SpEvents::saveEvent($id);


 		Session::flash('action', 'save');
		Session::flash('message', '保存成功！');
		return Redirect::action('WxEventsController@deal', array('id' => $id));
	}

	public function commit($id){
		$ret=SpEvents::commitEvent($id);

		if(!$ret["isfinish"]){
			Session::flash('action', 'commit');
			Session::flash('message', '提交成功！请分享当前页面到下一步处理人。');

			return Redirect::action('WxEventsController@deal', array('id' =>$ret["eventid"]));
		}else{
			Session::flash('action', 'commit');
			Session::flash('message', '提交成功！流程已经结束。');

			return Redirect::action('WxEventsController@deal', array('id' =>$ret["eventid"]));
		}

	}
}