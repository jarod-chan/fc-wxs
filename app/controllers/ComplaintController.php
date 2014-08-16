<?php

class ComplaintController extends BaseController {


	public function index(){
		$complaintSet=Complaint::all();
		return View::make('complaint.index')
		->with('complaintSet',$complaintSet);
	}

	public function deal($id){
		$complaint=Complaint::find($id);
		$files=UpFile::where('tabname', 'wx_complaint')
			->Where('pkid',$id)
			->orderBy('id')
			->get();


		$stateBeg=State::beg()->first();
		$tagSet=SyTag::lists('name','key');

		return View::make('complaint.deal')
			->with('complaint',$complaint)
			->with('files',$files)
 			->with('communityEnums',Accept::communityEnums())
			->with('areaEnums',Accept::areaEnums())
			->with('buildingEnums',Accept::buildingEnums())
			->with('fromEnums',Accept::fromEnums())
			->with('degreeEnums',Accept::degreeEnums())
			->with('typeEnums',Accept::typeEnums())
			->with('unitEnums',Accept::unitEnums())
			->with('stateBeg',$stateBeg)
			->with('tagSet',$tagSet);
	}

	public function view($id){
		$complaint=Complaint::find($id);
		$files=UpFile::where('tabname', 'wx_complaint')
			->Where('pkid',$id)
			->orderBy('id')
			->get();

		return View::make('complaint.view')
			->with('complaint',$complaint)
			->with('files',$files);
	}

	public function accept($id){
		$complaint=Complaint::find($id);
		$complaint->fill(array('state'=>'deal'));
		$complaint->save();

		$arr=Input::all();
		$arr['no']=uniqid();
		$arr['name']=$complaint->name;
		$arr['complaint_id']=$complaint->id;
		$arr['create_at']=new DateTime();

		//作为受理人受理日期
		$syuser = Auth::user();
		if($syuser){
			$arr['accept_id']=$syuser->id;
		}

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

		//生成下一个节点处理人
		$next_id=Input::get("next_id");
		$state_id=Input::get("next_state_id");
		$arr=array(
				'state_id'=>$state_id,
				'deal_id'=>$next_id,
				'create_at'=>new Datetime(),
				'accept_id'=>$accept->id
		);
		$nextEvent=Events::create($arr);

		Session::flash('message', '操作成功！');

		return Redirect::action('ComplaintController@index');
	}

	public function reject($id){
		$complaint=Complaint::find($id);
		$complaint->fill(array('state'=>'close'));
		$complaint->save();

		Session::flash('message', '操作成功！');

		return Redirect::action('ComplaintController@index');
	}



}