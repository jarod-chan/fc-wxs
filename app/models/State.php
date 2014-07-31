<?php
class State extends Eloquent{
	
	protected $table = 'sy_state';
	
	protected $softDelete = true;
	
	public $timestamps = false;
	
	protected $fillable = array('no','name');
	
}