<?php

use Illuminate\Support\Facades\Redirect;
class SyUserController extends BaseController {

	public function index(){
		$syuserSet=SyUser::all();
		return View::make('syuser.index')
			->with('syuserSet', $syuserSet);
	}
	
	public function add(){
		$syuser=new SyUser;
		$syuser->role='accept';
		return View::make('syuser.edit')
			->with('syuser',$syuser)
			->with('roleEnums',SyUser::roleEnums());
	}
	
	public function edit($id){
		$syuser=SyUser::find($id);
		return View::make('syuser.edit')
			->with('syuser',$syuser)
			->with('roleEnums',SyUser::roleEnums());
	}
	
	public function addPost(){
		$arr=Input::all();
		$arr["password"]= Hash::make($arr["password"]);
		SyUser::create($arr);
		Session::flash('message', '保存成功');
		return Redirect::to("syuser/list");
	}
	

	
	public function save(){
		if(Input::has("id")){
			$syuser=SyUser::find(Input::get("id"));
		}else{
			$syuser=new SyUser;
		}
		$arr=Input::all();
		$password=$arr["password"];
		if(!empty($password)){
			$arr["password"]=Hash::make($password);
		}
		$syuser->fill($arr);
		$syuser->save();
		Session::flash('message', '保存成功');
		return Redirect::to("syuser/list");
	}
	
}
