<?php

use Illuminate\Support\Facades\Input;
class ComplaintController extends BaseController {
	
	public function complaint(){
		$openid=Input::get('openid');
		$wxUser=WxUser::find($openid);
		if(!$wxUser){
			$wxUser=new WxUser();
		}
		return View::make('complaint.complaint')
			->with("wxUser",$wxUser)
			->with("openid",$openid);
	} 
	
	
	public function  complaintPost(){		
		$openid=Input::get('openid');	
		$arr=array(
				'openid'=>$openid,
				'name'=>Input::get('name'),
				'phone'=>Input::get('phone'),
				'address'=>Input::get('address'),
				'content'=>Input::get('content'),
				'state'=>'N/A',
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

		
		Session::flash('message', '保存成功');
		return Redirect::action('ComplaintController@complaint', array('openid' => $openid));
	}
	
	public function mycp(){
		$openid=Input::get('openid');
		$complaintSet = Complaint::where('openid',$openid)
			->orderBy('create_at','desc')
			->get();
		return View::make('complaint.mycp')
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
		return View::make('complaint.cpitem')
			->with('complaint',$complaint)
			->with('files',$files)
			->with('eventHistory',$eventHistory);
	}
	
	public function deal($id){
		$complaint=Complaint::find($id);
		$files=UpFile::where('tabname', 'wx_complaint')
			->Where('pkid',$id)
			->orderBy('id')
			->get();
		
		return View::make('complaint.deal')
			->with('complaint',$complaint)
			->with('files',$files)
 			->with('communityEnums',Accept::communityEnums())
			->with('areaEnums',Accept::areaEnums())
			->with('buildingEnums',Accept::buildingEnums())
			->with('fromEnums',Accept::fromEnums())
			->with('degreeEnums',Accept::degreeEnums())
			->with('typeEnums',Accept::typeEnums())
			->with('unitEnums',Accept::unitEnums()); 
	}
	
	public function dealPost($id){
		$arr=Input::all();
		$complaint=Complaint::find($id);
		$arr['no']=uniqid();
		$arr['name']=$complaint->name;
		$arr['complaint_id']=$complaint->id;

		$accept=Accept::create($arr);
		
		$files=UpFile::where('tabname', 'wx_complaint')
			->Where('pkid',$complaint->id)
			->orderBy('id')
			->get();
		
		//复制相关附件
		foreach ($files as $file){
			$arr=array(
				'tabname'=>'sy_accept',
				'pkid'=>$accept->id,
				'filename'=>$file->filename
			);
			UpFile::create($arr);
		}
		
		Session::flash('message', '操作成功！');
		
		return Redirect::action('ComplaintController@index');
	}
	
	
	public function index(){
		$complaintSet=Complaint::all();
		return View::make('complaint.index')
			->with('complaintSet',$complaintSet);
	}

}