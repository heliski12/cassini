<?php

class Region extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

  public function profiles()
  {
    return $this->belongsToMany('Profile');
  }
}
