<?php
class EventsController extends BaseController{
	public function index(){
		$events=Events::all();
		return Response::json($events);
	}
	
	public function deal($id){
		if(Session::has('message')){
			return View::make('events.message')
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
			->orderBy('create_at')
			->get();

		$dealUserSet=SyUser::dealUser()->lists('name','id');
		$stateSet=State::orderBy("no")->lists('name','id');
		
		return View::make('events.deal')
			->with('event',$event)
			->with('files',$files)
			->with('accept',$accept)
			->with('acceptFiles',$acceptFiles)
			->with('eventHistory',$eventHistory)
			->with('dealUserSet',$dealUserSet)
			->with('stateSet',$stateSet);
	}
	
	public function save($id){
		$event=Events::find($id);
		$arr=Input::all();
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
		
		Session::flash('action', 'save');
		Session::flash('message', '保存成功！');
		return Redirect::action('EventsController@deal', array('id' => $id));
	}
	
	public function commit($id){
		$event=Events::find($id);
		$arr=Input::all();
		$arr["commit_at"]=new Datetime();
		$event->fill($arr);
		$event->save();
		
		$accept=Accept::find($event->accept_id);
		$accept->state_id=$event->state_id;
		$accept->save();
		
		$next_id=Input::get("next_id");
		$arr=array(
			'deal_id'=>$next_id,
			'create_at'=>new Datetime(),
			'accept_id'=>$event->accept_id
		);
		$nextEvent=Events::create($arr);
		
		Session::flash('action', 'commit');
		Session::flash('message', '提交成功！请分享当前页面到下一步处理人。');
		
		return Redirect::action('EventsController@deal', array('id' => $nextEvent->id));
	}
}