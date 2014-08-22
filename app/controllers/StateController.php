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
		Session::flash('message', '保存成功');
		return Redirect::to('state/list');
	}

	public function edit($id){
		$state=State::find($id);
		return View::make('state.edit')
		->with('state',$state);
	}

	public function userinfo($id){

		$stateUserSet=StateUser::where('state_id',$id)->orderBy("id")->get();
		$syUserSet=SyUser::dealUser()->lists('name','id');
		$tagSet=SyTag::lists('name','key');

		return View::make('state.userinfo')
			->with('stateUserSet',$stateUserSet)
			->with('syUserSet',$syUserSet)
			->with('tagSet',$tagSet)
			->with('id',$id);
	}

	private static function  delete($arr,$element){
		$key = array_search($element,$arr);
		if($key>=0){
			unset($arr[$key]);
		}
		return $arr;
	}

	public function userinfoPost($id){
		$stateUserSet=Input::get('stateUser');
		$stateUserIds=StateUser::where('state_id',$id)->lists('id');
		if(Input::has('stateUser')){
			foreach ($stateUserSet as $arr){
				$arr_id=$arr["id"];
				if(empty($arr_id)){
					$stateUser=new StateUser();
				}else {
					$stateUserIds=self::delete($stateUserIds,$arr_id);
					print_r($stateUserIds);
					$stateUser=StateUser::find($arr_id);
				}
				$arr["state_id"]=$id;
				$stateUser->fill($arr);
				$stateUser->save();
			}
		}
		if(count($stateUserIds)>0){
			StateUser::destroy($stateUserIds);
		}

		Session::flash('message', '保存成功');
		return Redirect::action("StateController@index");
	}

}