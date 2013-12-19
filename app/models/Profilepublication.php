<?php

class ProfilePublication extends BaseModel {

	protected $guarded = array();

	public static $rules = array();

  protected $table = 'profile_publication';

  public function publication()
  {
    return $this->belongsTo('Publication', 'publication_id');
  }
    

}

