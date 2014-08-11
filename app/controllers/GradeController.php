<?php
class GradeController extends BaseController{

	public function toList(){
		$gradeSet=Grade::orderBy("id")->get();
		return View::make("grade.list")
			->with("gradeSet",$gradeSet);
	}

	public function toAdd(){
		$grade=new Grade;
		$grade->state='on';
		return View::make("grade.edit")
			->with("grade",$grade)
			->with("stateEnums",Grade::stateEnums());
	}

	public function toEdit($id){
		$grade=Grade::find($id);
		return View::make("grade.edit")
			->with("grade",$grade)
			->with("stateEnums",Grade::stateEnums());
	}

	public function save(){
		if(Input::has("id")){
			$grade=Grade::find(Input::get("id"));
		}else{
			$grade=new Grade;
		}
		$arr=Input::all();
		$grade->fill($arr);
		$grade->save();
		Session::flash('message', '保存成功');
		return Redirect::to("grade/list");
	}

}