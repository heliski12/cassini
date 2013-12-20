<?php

class Institution extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

  public function profiles()
  {
    return $this->hasMany('Profile');
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
