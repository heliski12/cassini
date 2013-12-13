<?php

class Profile extends Eloquent {
  // there has to be another way of ignoring standard form input in one place.
  // using Input::except(['next','previous']) would lead to repeated code
  // TODO
  protected $guarded = ['keyperson','next','previous'];

  public static $rules = array();

  public function sectors()
  {
    return $this->belongsToMany('Sector');
  }

  public function regions()
  {
    return $this->belongsToMany('Region');
  }

  public function applications()
  {
    return $this->belongsToMany('Application');
  }

  public function publications()
  {
    return $this->belongsToMany('Publication')->withPivot('article_title', 'article_url');
  }

  public function keypersons()
  {
    return $this->hasMany('Keyperson');
  }

  public function presentations()
  {
    return $this->hasMany('Presentation');
  }

  public function institution()
  {
    return $this->belongsTo('Institution');
  }

  public function creator()
  {
    return $this->belongsTo('User', 'creator_id');
  }

  public function subscribers()
  {
    return $this->belongsToMany('User', 'profile_saves', 'user_id', 'profile_id');
  }

  public function collaborators()
  {
    return $this->belongsToMany('User', 'profile_permissions', 'user_id', 'profile_id');
  }

  public function photos()
  {
    return $this->hasMany('Photo');
  }

  public function awards()
  {
    return $this->hasMany('Award');
  }

  public function getViewFormAttribute()
  {
    return "<a href='" . URL::to('/') . "/admin_profile_wizard'>Use Profile Wizard</a>";
  }

  public function getStatusTosAttribute()
  {
    if (!array_key_exists($this->getAttribute('status'), Config::get('cassini.profile_statuses')))
      return Config::get('cassini.not_specified');
    return Config::get('cassini.profile_statuses')[$this->getAttribute('status')];
  }

  public function getKeypersonsTosAttribute()
  {
    $keypersons = [];
    foreach ($this->getAttribute('keypersons') as $keyperson)
      $keypersons[]= "<a href='" . URL::to('/') . "/admin/keypersons/" . $keyperson->id . "' target='_blank'>" . $keyperson->name . "</a>";
    return implode(', ', $keypersons);
  }

  public function getProviderTypeTosAttribute()
  {
    if (!array_key_exists($this->getAttribute('provider_type'), Config::get('cassini.provider_types')))
      return Config::get('cassini.not_specified');
    return Config::get('cassini.provider_types')[$this->getAttribute('provider_type')];
  }

  public function getRegionsTosAttribute()
  {
    $regions = [];
    foreach ($this->getAttribute('regions') as $region)
      $regions[]= $region->name;
    return implode(', ', $regions);
  } 

  public function getSectorsTosAttribute()
  {
    $sectors = [];
    foreach ($this->getAttribute('sectors') as $sector)
      $sectors[]= $sector->name;
    return implode(', ', $sectors);
  } 

  public function getPhotosCountAttribute()
  {
    $photos = $this->getAttribute('photos');
    if (empty($photos))
      return "0";
    return sizeof($photos);
  }
  public function getPresentationsCountAttribute()
  {
    $presentations = $this->getAttribute('presentations');
    if (empty($presentations))
      return "0";
    return sizeof($presentations);
  }
  public function getPublicationsCountAttribute()
  {
    $publications = $this->getAttribute('publications');
    if (empty($publications))
      return "0";
    return sizeof($publications);
  }

}
