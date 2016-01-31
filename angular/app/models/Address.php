<?php

class Address extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['name','person_id'];

	public function person(){

		return $this->belongsTo('Person','person_id','id');
	}

}