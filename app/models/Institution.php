<?php

class Institution extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

  public function profiles()
  {
    return $this->hasMany('Profile');
  }
}
