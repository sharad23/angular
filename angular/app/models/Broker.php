<?php

class Broker extends \Eloquent {
	
	protected $fillable = ['broker','transaction_id'];
    
    public function transaction(){

    	 return $this->belongsTo('Transaction','transaction_id','id');
    }

}