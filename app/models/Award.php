<?php

class Award extends BaseModel {

	protected $guarded = array();

	public static $rules = array();

  public function profile()
  {
    return $this->belongsTo('Profile');
  }
}

