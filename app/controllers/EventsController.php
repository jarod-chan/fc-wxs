<?php
class EventsController extends BaseController{
	public function index(){
		$events=Events::all();
		return Response::json($events);
	}
}