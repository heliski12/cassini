<?php

use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;

class Keyperson extends BaseModel implements StaplerableInterface {
  use EloquentTrait;

	protected $guarded = array();

  protected static $csv_headings = 'id,profile_id,first_name,last_name,title,email,phone,address,address_line2,address_line3,city,state,zip_code,country,created_at';

  public static $rules = array(
    'first_name' => 'required',
    'last_name' => 'required',
    'email' => 'required|email',
  );

  protected $table = 'keypersons'; 

  public function profile()
  {
    return $this->belongsTo('Profile');
  }

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

  public function getProfileTosAttribute()
  {
    $profile = $this->getAttribute('profile');
    return $profile->id . ': ' . $profile->tech_title;
  }
  public function getPhotoLinkAttribute()
  {
    return $this->photo->url('small');
  }
  public function getViewFormAttribute()
  {
    return "<a target='_blank' href='" . route('edit_profile', ['id' => $this->profile->id ]) . "'>Use Profile Wizard</a>";
  }
  public function getFullNameAttribute() { return $this->getAttribute('first_name') . ' ' . $this->getAttribute('last_name'); }
  public function getCityStateCountryAttribute() 
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

  public static function validateMultiple($input)
  {
    return Validator::make($input, static::rulesForMultiple($input));
  }

  public static function rulesForMultiple($input)
  {
    $rules = [];
    foreach ($input['keypersons'] as $idx => $keyperson)
    {
      $rules["keypersons.$idx.first_name"] = 'required';
      $rules["keypersons.$idx.last_name"] = 'required';
      //$rules["keypersons.$idx.email"] = 'required|email';
    }
    return $rules;
  }
  
}

