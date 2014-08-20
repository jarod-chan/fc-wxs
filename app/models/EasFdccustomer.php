<?php
class EasFdccustomer extends Eloquent{

	protected $table = 'eas_t_she_fdccustomer';

	protected $primaryKey='fid';

	public $timestamps = false;

	protected $fillable = array('fname_l2','froomid','fcertificatenumber');

	public function room(){
		return $this->belongsTo('EasRoom', 'froomid');
	}

}
