<?php
class State extends Eloquent{

	protected $table = 'sy_state';

	protected $softDelete = true;

	public $timestamps = false;

	protected $fillable = array('no','name','prop');


	public function stateUser(){
		return $this->hasMany('StateUser','state_id','id');
	}


	//是否某个节点的判断
	public function isState($stateStr){
		return $this->prop==$stateStr;
	}

	//是否结束节点
	public function  isInit(){
		return $this->prop=='init';
	}

	//是否结束节点
	public function  isEnd(){
		return $this->prop=='end';
	}

	//范围查询
	public function scopeInit($query)
	{
		return $query->where('prop','init');
	}



	public function scopeNextState($query,$state){
		return $query->where('no',$state->no+1);
	}

}