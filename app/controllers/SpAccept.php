<?php
class SpAccept {

	public static function toView($accept){
		$accept_view=View::make('spaccept.view')
			->with('accept',$accept);
		return $accept_view;
	}

	public static function toEventsHistory($accept_id) {
		$eventHistory=Events::where('accept_id',$accept_id)
			->whereNotNull('commit_at')
			->orderBy('create_at','desc')
			->get();
		return View::make('spaccept.event_history')
			->with("eventHistory",$eventHistory);
	}

	public static function addAccept($syuser){
		$arr=Input::all();
		$arr['complaint_id']=null;
		$arr['create_at']=new DateTime();

		//作为受理人
		if($syuser){
			$arr['accept_id']=$syuser->id;
		}
		//默认处于初始节点
		$stateInit=State::Init()->first();
		$arr["state_id"]=$stateInit->id;
		$accept=Accept::create($arr);

		//保存相关附件
		if (Input::has('file'))
		{
			C::save_fileable($accept,Input::get('file'));
		}


		$next_id=Input::get("next_id");
		$arr=array(
				'deal_id'=>$syuser->id,
				'next_id'=>$next_id,
				'state_id'=>$stateInit->id,
				'create_at'=>new Datetime(),
				'commit_at'=>new Datetime(),
				'accept_id'=>$accept->id
		);
		Events::create($arr);

		//生成下一个节点处理人
		$state_id=Input::get("next_state_id");
		$arr=array(
				'state_id'=>$state_id,
				'deal_id'=>$next_id,
				'create_at'=>new Datetime(),
				'accept_id'=>$accept->id
		);
		Events::create($arr);
	}

}
