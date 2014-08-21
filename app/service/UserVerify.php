<?php
class UserVerify {

	public static  function isOwner($name,$idcard){
		$num = EasFdccustomer::where("fname_l2",$name)
			->where("fcertificatenumber",$idcard)
			->count();
		return $num>0;
	}

	public static function  firstRoom($name,$idcard){
		$Fdccustomer=EasFdccustomer::where("fname_l2",$name)
		->where("fcertificatenumber",$idcard)
		->first();
		return $Fdccustomer->room;
	}

	public static function sellProject(){
		return EasSellproject::orderBy('fname_l2')
		->lists('fname_l2','fid');
	}

	public static function building($sellProjectId){
		return EasBuilding::where('fsellprojectid',$sellProjectId)
		->orderBy('fname_l2')
		->lists('fname_l2','fid');
	}

	public static function buildingUnit($buildingId){
		return EasBuildingunit::where('fbuildingid',$buildingId)
		->orderBy('fname_l2')
		->lists('fname_l2','fid');
	}

	public static function  room($buildunitId){
		return EasRoom::where('fbuildunitid',$buildunitId)
		->orderBy('fname_l2')
		->lists('fname_l2','fid');
	}

	public static function buildingRoom($buildingId){
		return EasRoom::where('fbuildingid',$buildingId)
		->where('fbuildunitid',null)
		->orderBy('fname_l2')
		->lists('fname_l2','fid');
	}


}