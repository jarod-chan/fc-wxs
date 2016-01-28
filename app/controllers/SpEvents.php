<?php
class SpEvents {

	public static function toDeal($event,$accept){
		$view=View::make('spevents.deal');

		$currState=$event->state;
		$nextState=State::nextState($currState)->first();

		$view->with('event',$event)
			->with('accept',$accept)
			->with('currState',$currState)
			->with('nextState',$nextState);
		return $view;

	}

	public static function saveEvent($id){
		$arr=Input::all();
		if(empty($arr["next_id"])){
			$arr["next_id"]=null;
		}
		$event=Events::find($id);
		$event->fill($arr);
		$event->save();

		//附件处理
		if (Input::has('file'))
		{
			C::save_fileable($event,Input::get('file'));
		}
		if(Input::has('delete_file_id')){
			C::remove_filse(Input::get('delete_file_id'));
		}

		return $event;
	}

	public static function commitEvent($id){
		//保存当前节点
		$arr=Input::all();
		$arr["commit_at"]=new Datetime();
		$event=Events::find($id);
		$event->fill($arr);
		$event->save();

		//附件处理
		if (Input::has('file'))
		{
			C::save_fileable($event,Input::get('file'));
		}
		if(Input::has('delete_file_id')){
			C::remove_filse(Input::get('delete_file_id'));
		}

		$next_state_id=Input::get("next_state_id");
		$nextState=State::find($next_state_id);


		//如果非结束节点，生成下一节点
		if(!$nextState->isEnd()){
			$next_id=Input::get("next_id");
			$arr=array(
					'state_id'=>$nextState->id,
					'deal_id'=>$next_id,
					'create_at'=>new Datetime(),
					'accept_id'=>$event->accept_id
			);
			$nextEvent=Events::create($arr);

			$accept=Accept::find($event->accept_id);
			$accept->state_id=$event->state_id;
			//流程标签，只在负责人审批节点有效
			if($event->tag_key){
				$accept->tag_key=$event->tag_key;
			}
			$accept->save();

			return array('isfinish'=>false,'eventid'=>$nextEvent->id);
		}else{
			//更新受理单状态，不添加事件节点
			$accept=Accept::find($event->accept_id);
			$accept->state_id=$nextState->id;
			$accept->grade_id=$event->grade_id;//满意度评价，在在最后确认节点有效
			$accept->save();

			return array('isfinish'=>true,'eventid'=>$event->id);
		}
	}

}

