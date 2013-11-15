<?php

class Profile extends Eloquent {
  protected $guarded = array();

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

  public function getViewFormAttribute()
  {
    return "<a href='" . URL::to('/') . "/admin_profile_wizard'>Use Profile Wizard</a>";
  }

  public function getKeypersonsTosAttribute()
  {
    $keypersons = [];
    foreach ($this->getAttribute('keypersons') as $keyperson)
      $keypersons[]= $keyperson->name;
    return implode(', ', $keypersons);
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


}
