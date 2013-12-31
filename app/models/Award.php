<?php

class Award extends BaseModel {

	protected $guarded = array();

	public static $rules = array();

  public function profile()
  {
    return $this->belongsTo('Profile');
  }

  public function getCleanUrlAttribute()
  {
    return StringHelper::clean_url($this->getAttribute('url'));
  }
}

