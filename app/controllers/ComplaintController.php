<?php

class ComplaintController extends BaseController {


	public function index(){
		$complaintSet=Complaint::orderBy('id')
			->get();
		return View::make('complaint.index')
		->with('complaintSet',$complaintSet);
	}

	public function deal($id){

		$complaint=Complaint::find($id);

		$stateBeg=State::beg()->first();
		$tagSet=SyTag::lists('name','key');

		$view=View::make('complaint.deal');
		$view->with('complaint',$complaint)
			->with('fromEnums',Accept::fromEnums())
			->with('degreeEnums',Accept::degreeEnums())
			->with('typeEnums',Accept::typeEnums())
			->with('stateBeg',$stateBeg)
			->with('tagSet',$tagSet);

		$room=$complaint->room;

		$view->with('room',$room)
			->with('sellProjectSet',UserVerify::sellProject())
			->with('buildingSet',UserVerify::building($room->fsellprojectid))
			->with('buildingUnitSet',UserVerify::buildingUnit($room->fbuildingid))
			->with('roomSet',UserVerify::room($room->fbuildunitid));
		return $view;
	}

	public function view($id){
		$complaint=Complaint::find($id);


		return View::make('complaint.view')
			->with('complaint',$complaint);
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


		//复制相关附件
		foreach ($complaint->files as $file){
			$arr=array(
				'filename'=>$file->filename
			);
			$accept->files()->create($arr);
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