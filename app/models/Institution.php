<?php

class Institution extends Eloquent {
  use Codesleeve\Stapler\Stapler;

	protected $guarded = array();

	public static $rules = array();

  public function __construct(array $attributes = array())
  {
    $this->hasAttachedFile('logo', array(
      'styles' => array(
        'medium' => '300',
        'small' => '100'
      ),
      'default_url' => '/img/company-avatar.png',
    ));

    parent::__construct($attributes);
  }

  public function profiles()
  {
    return $this->hasMany('Profile');
  }

  public function getLogoLinkAttribute()
  {
    return $this->logo->url('small');
  }

  public function getEditLogoAttribute()
  {
    return "<a href='" . route('institution_logo', ['id' => $this->id ]) . "'>Click here</a>";
  }

  public function getAddressAttribute()
  {
    $address_str = '';
    $city = $this->getAttribute('city'); 
    $state = $this->getAttribute('state'); 
    $country = $this->getAttribute('country'); 

    if (!empty($city))
      $address_str .= "$city, ";
    $address_str .= "$state ";
    $address_str .= $country;

    return $address_str;
  }
}
