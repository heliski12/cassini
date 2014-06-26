<?php
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;

class Photo extends BaseModel implements StaplerableInterface {
  use EloquentTrait;
  
	protected $guarded = array();

	public static $rules = array();

  public function __construct(array $attributes = array())
  {
    $this->hasAttachedFile('photo', array(
      'styles' => array(
        'large' => '450',
        'thumb' => '100'
      ),
      'default_url' => null,
    ));

    parent::__construct($attributes);
  }

  public function profile()
  {
    return $this->belongsTo('Profile');
  }

  public function getProfileTosAttribute()
  {
    $profile = $this->getAttribute('profile');
    return $profile->id . ': ' . $profile->tech_title;
  }
  public function getPhotoLinkAttribute()
  {
    return $this->photo->url('thumb');
  }
  public function getViewFormAttribute()
  {
    return "<a target='_blank' href='" . route('edit_profile', ['id' => $this->profile->id ]) . "'>Use Profile Wizard</a>";
  }
}
