<?php
class EasSellproject extends Eloquent{

	protected $table = 'eas_t_she_sellproject';

	protected $primaryKey='fid';

	public $timestamps = false;

	protected $fillable = array('fname_l2');

}