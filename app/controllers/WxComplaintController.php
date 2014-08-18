<?php
class WxComplaintController extends BaseController {

	public function complaint(){
		$openid=Input::get('openid');
		$wxUser=WxUser::find($openid);

		if($wxUser && $wxUser->isVerified()){
			return View::make('wxcomplaint.complaint')
			->with("wxUser",$wxUser)
			->with("openid",$openid);
		}else {
			Session::flash('message', '只有用户类型为[业主]的用户才能进行客户投诉。');
			return View::make('common.message');
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

		if (Input::has('file'))
		{
			C::save_files('wx_complaint',$complaint->id,Input::get('file'));
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

