<?php
class SpAccept {
	
	public static function toView($accept){
		$acceptFiles=UpFile::where('tabname', 'sy_accept')
			->Where('pkid',$accept->id)
			->orderBy('id')
			->get();
		$accept_view=View::make('spaccept.view')
			->with('accept',$accept)
			->with('acceptFiles',$acceptFiles);
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

}
