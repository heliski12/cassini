<?php

class Photo extends BaseModel {
  use Codesleeve\Stapler\Stapler;
	protected $guarded = array();

	public static $rules = array();

  public function __construct(array $attributes = array())
  {
    $this->hasAttachedFile('photo', array(
      'styles' => array(
        'large' => '450',
        'thumb' => '100'
      ),
    ));

    parent::__construct($attributes);
  }

  public function profile()
  {
    return $this->belongsTo('Profile');
  }
}
