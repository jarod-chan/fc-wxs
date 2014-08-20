<?php
class EasRoom extends Eloquent{

	protected $table = 'eas_t_she_room';

	protected $primaryKey='fid';

	public $timestamps = false;

	protected $fillable = array('fname_l2','fsellprojectid','fbuildingid','fbuildunitid');

	public function building(){
		return $this->belongsTo('EasBuilding', 'fbuildingid');
	}

	public function buildingunit(){
		return $this->belongsTo('EasBuildingunit', 'fbuildunitid');
	}

	public function sellproject(){
		return $this->belongsTo('EasSellproject', 'fsellprojectid');
	}

	private function append($target,$obj){
		if($obj){
			return $target.($obj->fname_l2);
		}
		return $target;
	}

	public function address(){
		$sellproject=$this->sellproject;
		$building=$this->building;
		$buildingUnit=$this->buildingunit;
		$address="";
		$address=$this->append($address,$sellproject);
		$address=$this->append($address,$building);
		$address=$this->append($address,$buildingUnit);
		$address=$this->append($address,$this);
		return $address;
	}

}