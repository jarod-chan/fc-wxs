<?php
class EasSellproject extends Eloquent{

	protected $table = 'eas_t_she_sellproject';

	protected $primaryKey='fid';

	public $timestamps = false;

	protected $fillable = array('fname_l2','state');

	public static function stateEnums(){
		return array('on' =>'开启','off'=>'关闭');
	}

	public function state(){
		return self::stateEnums()[$this->state];
	}

}