<?php

class Person extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['name'];

	public function addresses(){

		return $this->hasMany('Address','person_id','id');
	}

}