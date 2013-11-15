<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	public function getAuthPassword()
	{
		return $this->password;
	}

	public function getReminderEmail()
	{
		return $this->email;
	}

  public function profiles()
  {
    return $this->hasMany('Profile', 'creator_id');
  }

  public function subscriptions()
  {
    return $this->belongsToMany('Profile', 'profile_saves', 'profile_id', 'user_id');
  }

  public function collaborations()
  {
    return $this->belongsToMany('Profile', 'profile_permissions', 'profile_id', 'user_id');
  }

  public function getFullNameAttribute() { return $this->getAttribute('first_name') . ' ' . $this->getAttribute('last_name'); }
  public function getInnovatorTosAttribute() { return $this->getAttribute('innovator') ? 'Yes' : ''; }
  public function getSeekerTosAttribute() { return $this->getAttribute('seeker') ? 'Yes' : ''; }
  public function getUnsureTosAttribute() { return $this->getAttribute('unsure') ? 'Yes' : ''; }

  public function setPasswordAttribute($value) 
  { 
    if (!empty($value)) 
      $this->attributes['password'] = Hash::make($value); 
  }
  

}
