<?php
//客户投诉的处理评价
class Grade extends Eloquent{

	protected $table = 'sy_grade';

	protected $softDelete = true;

	public $timestamps = false;

	protected $fillable = array('name','val','state');

	public static function stateEnums(){
		return array('on' =>'开启','off'=>'关闭');
	}

	public function state(){
		return self::stateEnums()[$this->state];
	}

	public function scopeStateOn($query){
		$query->where('state','on')
			->orderBy('val');
	}


}