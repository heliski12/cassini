<?php

class Publication extends BaseModel {
  use Codesleeve\Stapler\Stapler;

	protected $guarded = array();

	public static $rules = array();

  public function __construct(array $attributes = array())
  {
    $this->hasAttachedFile('photo', array(
      'styles' => array(
        'medium' => '300',
        'small' => '100'
      ),
    ));

    parent::__construct($attributes);
  }

  public function profiles()
  {
    return $this->hasMany('Profile', 'profile_id');
  }

  public function getPhotoLinkAttribute()
  {
    return $this->photo->url('small');
  }
}
