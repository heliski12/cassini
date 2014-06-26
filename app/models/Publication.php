<?php
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;

class Publication extends BaseModel implements StaplerableInterface {
  use EloquentTrait;

	protected $guarded = array();

	public static $rules = array();

  public function __construct(array $attributes = array())
  {
    $this->hasAttachedFile('photo', array(
      'styles' => array(
        'medium' => '300',
        'small' => '100'
      ),
      'default_url' => '/img/publication.png',
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

  public function getEditPhotoAttribute()
  {
    return "<a href='" . route('publication_photo', ['id' => $this->id ]) . "'>Click here</a>";
  }

}
