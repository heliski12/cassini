<?php

class Keyperson extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

  public function profile()
  {
    return $this->belongsTo('Profile');
  }
}
