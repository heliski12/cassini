<?php

class Publication extends BaseModel {
	protected $guarded = array();

	public static $rules = array();

  public function profiles()
  {
    return $this->hasMany('Profile', 'profile_id');
  }
}
