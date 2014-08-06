<?php
class WxEventsController extends BaseController{

	
	public function deal($id){
		if(Session::has('message')){
			return View::make('wxevents.message')
				->with('eventId',$id);
		}
		$event=Events::find($id);
		$files=UpFile::where('tabname', 'wx_event')
			->Where('pkid',$event->id)
			->orderBy('id')
			->get();
		
		$accept=Accept::find($event->accept_id);
		$acceptFiles=UpFile::where('tabname', 'sy_accept')
			->Where('pkid',$event->accept_id)
			->orderBy('id')
			->get();
		$eventHistory=Events::where('accept_id',$event->accept_id)
			->whereNotNull('commit_at')
			->orderBy('create_at','desc')
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
	
		
		return View::make('wxevents.deal')
			->with('event',$event)
			->with('files',$files)
			->with('accept',$accept)
			->with('acceptFiles',$acceptFiles)
			->with('eventHistory',$eventHistory)
			->with('dealUserSet',$dealUserSet)
			->with('nextState',$nextState);
	}
	
	private function saveEvent($id,$arr){
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
	
	public function save($id){
		$arr=Input::all();
		$this->saveEvent($id, $arr);
		
		Session::flash('action', 'save');
		Session::flash('message', '保存成功！');
		return Redirect::action('WxEventsController@deal', array('id' => $id));
	}
	
	public function commit($id){

		$arr=Input::all();
		$arr["commit_at"]=new Datetime();
		$event=$this->saveEvent($id,$arr);
		
		$next_state_id=Input::get("next_state_id");
		$nextState=State::find($next_state_id);
		
		//更新受理单状态
		$accept=Accept::find($event->accept_id);
		$accept->state_id=$nextState->id;
		$accept->save();
		
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
			
			Session::flash('action', 'commit');
			Session::flash('message', '提交成功！请分享当前页面到下一步处理人。');
			
			return Redirect::action('WxEventsController@deal', array('id' => $nextEvent->id));
		}else{
			Session::flash('action', 'commit');
			Session::flash('message', '提交成功！流程已经结束。');
			
			return Redirect::action('WxEventsController@deal', array('id' => $event->id));
		}
		
			
	}
}