<?php
class WxComplaintController extends BaseController {

	public function complaint(){
		$openid=Input::get('openid');
		$wxUser=WxUser::find($openid);

		if($wxUser && $wxUser->isVerified()){
			$roomSet=array();
			$wxUser->ownCustomers()->each(function( $customer )use ( &$roomSet ){
				$room=$customer->room;
				$roomSet[$room->fid]=$room->address();
			});

			return View::make('wxcomplaint.complaint')
			->with("wxUser",$wxUser)
			->with("openid",$openid)
			->with("roomSet",$roomSet);
		}else {
			return View::make('common.message_pg')
			->with('message', '只有用户类型为[业主]的用户才能进行客户投诉。');
		}
	}

	public function  complaintPost(){
		$openid=Input::get('openid');
		$arr=Input::All();
		$arr['openid']=$openid;
		$arr['state']='wait';
		$arr['create_at']=new DateTime();

		$complaint = Complaint::create($arr);

		if (Input::has('file'))
		{
			C::save_fileable($complaint,Input::get('file'));
		}

		return View::make('common.message_pg')
		->with('message', '投诉已经提交，请耐心等待反馈。');
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
		$accept_id=Accept::where("complaint_id",$id)
			->pluck('id');
		$eventHistory=Events::where('accept_id',$accept_id)
			->whereNotNull('commit_at')
			->orderBy('create_at')
			->get();
		return View::make('wxcomplaint.cpitem')
			->with('complaint',$complaint)
			->with('eventHistory',$eventHistory);
	}

}

