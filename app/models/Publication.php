<?php

class Publication extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

  public function profiles()
  {
    return $this->belongsToMany('Profile')->withPivot('article_title', 'article_url');
  }
}
