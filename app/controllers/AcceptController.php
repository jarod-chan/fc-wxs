<?php
use Illuminate\Support\Facades\View;
class AcceptController extends BaseController{
	
	public function index(){
		$acceptSet=Accept::all();
		return View::make('accept.index')
		->with('acceptSet',$acceptSet);
	}
	
	public function deal($id){
		$accept=Accept::find($id);
		$files=UpFile::where('tabname', 'sy_accept')
			->Where('pkid',$id)
			->orderBy('id')
			->get();
		$eventHistory=Events::where('accept_id',$accept->id)
			->orderBy('create_at','desc')
			->get();
		
		$dealUserSet=SyUser::dealUser()->lists('name','id');

		return View::make('accept.deal')
			->with('accept',$accept)
			->with('files',$files)
			->with('eventHistory',$eventHistory)
			->with('dealUserSet',$dealUserSet);
	}
	
	public function dealPost($id){
		$deal_id=Input::get('deal_id');
		$arr=array(
			'deal_id'=>$deal_id,
			'create_at'=>new Datetime(),
			'accept_id'=>$id
		);
		$event=Events::create($arr);
		Session::flash('message', '保存成功');
		return Redirect::action('AcceptController@index');
	}
}