<?php
class SelRoomController extends BaseController{

	public function sel(){
		$val=Input::get("val");
		$tag=Input::get("tag");
		if($tag=='building'){
			$arr=UserVerify::building($val);
		}else if($tag=='room'){
			$arr=UserVerify::room($val);
		}

		return $this->toJosnArray($arr);
	}

	private function toJosnArray($arr){
		$ret=array();
		foreach ($arr as  $k=>$v){
			array_push($ret,array('id'=>$k,'name'=>$v));
		}
		return $ret;
	}

	// 选择楼栋比较特殊，因为会出现没有单元，只有房间的情况
	public  function selBuildingunit(){
		$val=Input::get("val");
		$unit=UserVerify::buildingUnit($val);
		if(count($unit)>0){
			$unit=$this->toJosnArray($unit);
			return array('type'=>'unit','arr'=>$unit);
		}

		$room=UserVerify::buildingRoom($val);
		if(count($room)>0){
			$room=$this->toJosnArray($room);
			return array('type'=>'room','arr'=>$room);
		}

		return array('type'=>false);
	}

}