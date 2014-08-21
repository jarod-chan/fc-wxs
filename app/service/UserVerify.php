<?php
class UserVerify {

	private static function ownerRooms($name,$idcard){
		$customerSet=EasFdccustomer::with('room')
		->where("fname_l2",$name)
		->where("fcertificatenumber",$idcard)
		->get();
		$sellPorjectIds=EasSellproject::where('state','on')
		->lists('fid');
		$roomSet=array();
		$customerSet->each(function($customer) use ($sellPorjectIds,&$roomSet) {
			$room=$customer->room;
		    $sellProjectId=$room->fsellprojectid;
		    if(in_array($sellProjectId,$sellPorjectIds)){
				array_push($roomSet,$room);
		    }
		});
		return $roomSet;
	}

	public static  function isOwner($name,$idcard){
		$roomSet=self::ownerRooms($name, $idcard);
		return count($roomSet)>0;
	}

	public static function  firstRoom($name,$idcard){
		$roomSet=self::ownerRooms($name, $idcard);
		return $roomSet[0];
	}

	public static function sellProject(){
		return EasSellproject::where('state','on')
		->orderBy('fname_l2')
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