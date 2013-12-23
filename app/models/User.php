<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

  public static $rules = array(
    'first_name' => 'required',
    'last_name' => 'required',
    'organization' => 'required',
    'phone' => 'required',
    'email' => 'required|email|unique:users,email',
    'password' => 'required|between:8,250', 
    'password_confirmation' => 'required|same:password',
  );

  protected $fillable = [ 'first_name', 'last_name', 'organization', 'phone', 'email', 'password' ];

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
    return $this->belongsToMany('Profile', 'profile_saves', 'profile_id', 'user_id')->withTimestamps();
  }

  public function collaborations()
  {
    return $this->belongsToMany('Profile', 'profile_permissions', 'profile_id', 'user_id')->withTimestamps();
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

  public static function validate($input)
  {
    return Validator::make($input, static::$rules);
  }
  
  

}
