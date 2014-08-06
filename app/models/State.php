<?php
class State extends Eloquent{
	
	protected $table = 'sy_state';
	
	protected $softDelete = true;
	
	public $timestamps = false;
	
	protected $fillable = array('no','name','prop');
	
	
	public function stateUser(){
		return $this->hasMany('StateUser','state_id','id');
	}
	
	public function  isEnd(){
		return $this->prop=='end';
	}
	
	//范围查询
	public function scopeBeg($query)
	{
		return $query->where('prop','beg');
	}
	
	public function scopeNextState($query,$state){
		return $query->where('no',$state->no+1);
	}
	
}