<?php

class Presentation extends BaseModel {

	protected $guarded = array();

	public static $rules = array();

  public function profile()
  {
    return $this->belongsTo('Profile');
  }
}

