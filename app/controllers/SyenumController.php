<?php
class SyenumController extends BaseController{

	public function toList(){
		$typeSet=Syenum::allTypes();
		return View::make('syenum.list')
		->with('typeSet',$typeSet);
	}

	public function toVals($type){
		$syenumSet=Syenum::where('type',$type)
		->orderBy("sq")
		->get();
		return View::make('syenum.vals')
		->with('syenumSet',$syenumSet)
		->with('type',$type);
	}

	public function saveVal($type){
		$syenumSet=Input::get("syenum");
		$syenumKeys=Syenum::where('type',$type)->lists('key');
		foreach ($syenumSet as $syenum){
			$obj=Syenum::where('type',$type)->where('key',$syenum['key'])->first();
			if($obj){
				$syenumKeys=H::delete($syenumKeys,$syenum['key']);
				DB::table('sy_enum')->where('type',$type)->where('key',$syenum['key'])->update($syenum);
			}else {
				$syenum['type']=$type;
				DB::table('sy_enum')->insert($syenum);
			}
		}
		if(count($syenumKeys)>0){
			Syenum::where('type',$type)
				->whereIn('key',$syenumKeys)
				->delete();
		}
		Session::flash('message', '保存成功');
		return Redirect::to("syenum/list");
	}

}
