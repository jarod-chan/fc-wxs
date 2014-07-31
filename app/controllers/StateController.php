<?php
class StateController extends BaseController{
	public function index(){
		$stateSet=State::orderBy("no")->get();	
		return View::make('state.index')
			->with('stateSet',$stateSet);
	}
	
	public function add(){
		$state=new State;
		return View::make('state.edit')
			->with('state',$state);
	}
	
	public function save(){
		$arr=Input::all();
		if(Input::has('id')){
			$state=State::find(Input::get('id'));
		}else{
			$state=new State;
		}

		$state->fill($arr);
		$state->save();
		return Redirect::to('state/list');
	}
	
	public function edit($id){
		$state=State::find($id);
		return View::make('state.edit')
		->with('state',$state);
	}
	
}