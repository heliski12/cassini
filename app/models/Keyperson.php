<?php


class Keyperson extends Eloquent {
  use Codesleeve\Stapler\Stapler;

	protected $guarded = array();

	public static $rules = array();

  protected $table = 'keypersons'; 

  public function profile()
  {
    return $this->belongsTo('Profile');
  }

  public function __construct(array $attributes = array())
  {
    $this->hasAttachedFile('photo', array(
      'styles' => array(
        'medium' => '300x300',
        'thumb' => '100x100'
      )));

    parent::__construct($attributes);
  }
}
