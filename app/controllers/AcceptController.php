<?php
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
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
	
	public function add(){
		$openid=Input::get("openid");
		$dealUserSet=SyUser::dealUser()->lists('name','id');
		return View::make('accept.add')
			->with('openid',$openid)
			->with('communityEnums',Accept::communityEnums())
			->with('areaEnums',Accept::areaEnums())
			->with('buildingEnums',Accept::buildingEnums())
			->with('fromEnums',Accept::fromEnums())
			->with('degreeEnums',Accept::degreeEnums())
			->with('typeEnums',Accept::typeEnums())
			->with('unitEnums',Accept::unitEnums())
			->with('dealUserSet',$dealUserSet);
	}
	
	public function  addPost(){
		$openid=Input::get('openid');
		$syuser=SyUser::where('openid',$openid)->first();
		
		$arr=Input::all();
		$arr['no']=uniqid();
		$arr['complaint_id']=null;
		$arr['accept_id']=$syuser->id;
		$arr['create_at']=new DateTime();
		
		$accept=Accept::create($arr);
		
		if (Input::hasFile('file'))
		{
			foreach(Input::file('file') as $file){
				$ext = $file->getClientOriginalExtension();
				$filename=uniqid(date('Ymd-')).'.'.$ext;
				$file->move(public_path().'/data',$filename);
				$arr=array(
						'tabname'=>'sy_accept',
						'pkid'=>$accept->id,
						'filename'=>$filename
				);
				UpFile::create($arr);
			}
		}
		
		//生成下一个节点处理人
		$next_id=Input::get("next_id");
		$arr=array(
				'deal_id'=>$next_id,
				'create_at'=>new Datetime(),
				'accept_id'=>$accept->id
		);
		$nextEvent=Events::create($arr);
		
		
		return Redirect::action('AcceptController@add',array('openid'=>$openid));
	}
	
	public function  todo(){
		if(Input::has('openid')){
			$openid=Input::get('openid');
			$syuser=SyUser::where('openid',$openid)->first();
		}
		if(Input::has('syuserid')){
			$syuser=SyUser::find(Input::get('syuserid'));
		}
		$acceptSet = Accept::whereHas('events', function($q) use ($syuser)
		{
		    $q->where('deal_id', $syuser->id)
		    ->whereNull('commit_at');
		
		})
		->get();
		
		return View::make('accept.todo')
			->with('acceptSet',$acceptSet)
			->with('syuserid',$syuser->id);
	}
	
	public  function  doitem($id){
		$accept_id=$id;
		$syuserid=Input::get('syuserid');
		
		$accept=Accept::find($accept_id);
		$acceptFiles=UpFile::where('tabname', 'sy_accept')
			->Where('pkid',$accept_id)
			->orderBy('id')
			->get();
		
		$event=Accept::find($accept_id)
			->events()
			->whereNull('commit_at')
			->where('deal_id',$syuserid)
			->orderBy('create_at')
			->first();
		
		$files=UpFile::where('tabname', 'wx_event')
			->Where('pkid',$event->id)
			->orderBy('id')
			->get();
		
		//已经提交的历史
		$eventHistory=Accept::find($accept_id)
			->events()
			->whereNotNull('commit_at')
			->orderBy('create_at','desc')
			->get();
		
		$dealUserSet=SyUser::dealUser()->lists('name','id');
		$stateSet=State::orderBy("no")->lists('name','id');
		
		return View::make('accept.doitem')
			->with('event',$event)
			->with('files',$files)
			->with('accept',$accept)
			->with('acceptFiles',$acceptFiles)
			->with('eventHistory',$eventHistory)
			->with('dealUserSet',$dealUserSet)
			->with('stateSet',$stateSet);
	}
	
	private function saveEvent($id,$arr){
		$event=Events::find($id);
		$event->fill($arr);
		$event->save();
		
		//附件处理
		if (Input::hasFile('file'))
		{
			foreach(Input::file('file') as $file){
				$ext = $file->getClientOriginalExtension();
				$filename=uniqid(date('Ymd-')).'.'.$ext;
				$file->move(public_path().'/data',$filename);
				$arr=array(
						'tabname'=>'wx_event',
						'pkid'=>$id,
						'filename'=>$filename
				);
				UpFile::create($arr);
			}
		}
		return $event;
	}
	
	public function dosave($id){
		$arr=Input::all();
		$event=$this->saveEvent($id,$arr);
		
		Session::flash('message', '保存成功！');
		return  Redirect::action('AcceptController@todo',array('syuserid'=>$event->deal_id));
	}
	
	public function docommit($id){	
		
		$arr=Input::all();
		$arr["commit_at"]=new Datetime();
		$event=$this->saveEvent($id,$arr);
		
		$accept=Accept::find($event->accept_id);
		$accept->state_id=$event->state_id;
		$accept->save();
		
		$next_id=Input::get("next_id");
		$arr=array(
				'deal_id'=>$next_id,
				'create_at'=>new Datetime(),
				'accept_id'=>$event->accept_id
		);
		$nextEvent=Events::create($arr);
		
		Session::flash('message', '提交成功！');
		
		return  Redirect::action('AcceptController@todo',array('syuserid'=>$event->deal_id));
	}
	
	public function history(){
		if(Input::has('openid')){
			$openid=Input::get('openid');
			$syuser=SyUser::where('openid',$openid)->first();
		}
		if(Input::has('syuserid')){
			$syuser=SyUser::find(Input::get('syuserid'));
		}
		
		$acceptBy=Accept::where('accept_id',$syuser->id);
		
		$acceptSet = Accept::where('accept_id',$syuser->id)->orWhereHas('events', function($q) use ($syuser)
			{
				$q->where('deal_id', $syuser->id)
				->whereNotNull('commit_at');
			})
			->get();
		
		return View::make('accept.history')
			->with('acceptSet',$acceptSet)
			->with('syuserid',$syuser->id);
	}
	
	public function historyItem($id){
		$accept_id=$id;
		
		$accept=Accept::find($accept_id);
		$acceptFiles=UpFile::where('tabname', 'sy_accept')
			->Where('pkid',$accept_id)
			->orderBy('id')
			->get();
		
		//已经提交的历史
		$eventHistory=Accept::find($accept_id)
			->events()
			->whereNotNull('commit_at')
			->orderBy('create_at','desc')
			->get();
		
		echo '11111111';
		
		return View::make('accept.historyitem')
			->with('accept',$accept)
			->with('acceptFiles',$acceptFiles)
			->with('eventHistory',$eventHistory);
	}
	
}