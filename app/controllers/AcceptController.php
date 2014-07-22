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
		return View::make('accept.deal')
			->with('accept',$accept)
			->with('files',$files);
	}
	
	public function dealPost($id){
		$deal=Input::get('deal');
		$arr=array(
			'deal'=>$deal,
			'create_at'=>new Datetime(),
			'accept_id'=>$id
		);
		$event=Events::create($arr);
		Session::flash('message', '保存成功');
		return Redirect::action('AcceptController@index');
	}
}