<?php
class WxComplaintController extends BaseController {
	
	public function complaint(){
		$openid=Input::get('openid');
		$wxUser=WxUser::find($openid);
		
		if(!$wxUser){
			return Redirect::action('WxRegisterController@toRegister', array('openid' => $openid,'tourl'=>'wx/complaint'));
		}elseif(!$wxUser->isVerified()){
			Session::flash('message', '只有认证用户才能发起微信投诉。');
			return View::make('common.message');
		}else{
			return View::make('wxcomplaint.complaint')
				->with("wxUser",$wxUser)
				->with("openid",$openid);
		}
	}
	
	
	public function  complaintPost(){
		$openid=Input::get('openid');
		$arr=array(
				'openid'=>$openid,
				'name'=>Input::get('name'),
				'phone'=>Input::get('phone'),
				'address'=>Input::get('address'),
				'content'=>Input::get('content'),
				'state'=>'wait',
				'create_at'=>new DateTime()
		);
		$complaint = Complaint::create($arr);
	
		if (Input::hasFile('file'))
		{
			foreach(Input::file('file') as $file){
				$ext = $file->getClientOriginalExtension();
				$filename=uniqid(date('Ymd-')).'.'.$ext;
				$file->move(public_path().'/data',$filename);
				$arr=array(
						'tabname'=>'wx_complaint',
						'pkid'=>$complaint->id,
						'filename'=>$filename
				);
				UpFile::create($arr);
			}
		}
	
	
		Session::flash('message', '投诉已经提交，请耐心等待反馈。');
		return View::make('common.message');
	}
	
	public function mycp(){
		$openid=Input::get('openid');
		$complaintSet = Complaint::where('openid',$openid)
		->orderBy('create_at','desc')
		->get();
		return View::make('wxcomplaint.mycp')
		->with("complaintSet",$complaintSet);
	}
	
	public function cpitem($id){
		$complaint=Complaint::find($id);
		$files=UpFile::where('tabname', 'wx_complaint')
			->Where('pkid',$id)
			->orderBy('id')
			->get();
		$accept_id=Accept::where("complaint_id",$id)
			->pluck('id');
		$eventHistory=Events::where('accept_id',$accept_id)
			->whereNotNull('commit_at')
			->orderBy('create_at')
			->get();
		return View::make('wxcomplaint.cpitem')
			->with('complaint',$complaint)
			->with('files',$files)
			->with('eventHistory',$eventHistory);
	}
	
}

