<?php
class SpEvents {

	public static function toDeal($event,$accept){
		$view=View::make('spevents.deal');

		$files=UpFile::where('tabname', 'wx_event')
			->Where('pkid',$event->id)
			->orderBy('id')
			->get();

		$currState=$event->state;
		$nextState=State::nextState($currState)->first();

		$stateUserSet=$nextState->stateUser;
		$dealUserSet=array();
		foreach ($stateUserSet as $stateUser){
			if ($stateUser->tag_key==$accept->tag->key) {
				$dealUserSet[$stateUser->user_id]=$stateUser->user_name;
			}
		}

		if ($currState->isGrade()) {
			$gradeOn=Grade::stateOn()->get();
			$view->with('gradeSet',$gradeOn);
		}

		$view->with('event',$event)
			->with('files',$files)
			->with('accept',$accept)
			->with('dealUserSet',$dealUserSet)
			->with('nextState',$nextState);
		return $view;

	}

	public static function saveEvent($id){
		$arr=Input::all();
		$event=Events::find($id);
		$event->fill($arr);
		$event->save();

		//附件处理
		if (Input::hasFile('file'))
		{
			foreach(Input::file('file') as $file){
				$ext = $file->getClientOriginalExtension();
				$filename=uniqid(date('Ymd-')).'.'.$ext;
				$file->move(public_path().'/data',$filename);
				$arr=array(
						'tabname'=>'wx_event',
						'pkid'=>$id,
						'filename'=>$filename
				);
				UpFile::create($arr);
			}
		}
		return $event;
	}

	public static function commitEvent($id){
		$arr=Input::all();
		$arr["commit_at"]=new Datetime();
		$event=Events::find($id);
		$event->fill($arr);
		$event->save();

		$next_state_id=Input::get("next_state_id");
		$nextState=State::find($next_state_id);


		//如果非结束节点，生成下一节点
		if($nextState->isEnd()){
			//更新受理单状态
			$accept=Accept::find($event->accept_id);
			$accept->state_id=$nextState->id;
			$accept->save();

			return array('isfinish'=>true,'eventid'=>$event->id);
		}else{
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
			$accept->grade_id=$event->grade_id;
			$accept->save();

			return array('isfinish'=>false,'eventid'=>$nextEvent->id);
		}
	}

}

