<?php

class Application extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

  public function profile()
  {
    return $this->belongsToMany('Profile');
  }
}
