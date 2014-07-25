<?php
class EventsController extends BaseController{
	public function index(){
		$events=Events::all();
		return Response::json($events);
	}
	
	public function deal($id){
		$event=Events::find($id);
		$accept=Accept::find($event->accept_id);
		$files=UpFile::where('tabname', 'sy_accept')
			->Where('pkid',$event->accept_id)
			->orderBy('id')
			->get();
		$eventHistory=Events::where('accept_id',$event->accept_id)
			->whereNotNull('commit_at')
			->orderBy('create_at')
			->get();
		$personSet=Events::personSet();
		$typeSet=Events::typeSet();
		
		return View::make('events.deal')
			->with('event',$event)
			->with('accept',$accept)
			->with('files',$files)
			->with('eventHistory',$eventHistory)
			->with('personSet',$personSet)
			->with('typeSet',$typeSet);
	}
	
	public function dealPost($id){
		$event=Events::find($id);
		$arr=Input::all();
		$arr["commit_at"]=new Datetime();
		$event->fill($arr);
		$event->save();
		return Redirect::action('EventsController@deal', array('id' => $id));
	}
}