<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

  public static $rules = array(
    'first_name' => 'required',
    'last_name' => 'required',
    'organization' => 'required',
    'email' => 'required|email|unique:users,email',
    'password' => 'required|between:8,250', 
    'password_confirmation' => 'required|same:password',
  );

  public static $password_rules = array(
    'old_password' => 'required',
    'new_password' => 'required|between:8,250',
    'confirm_password' => 'required|same:new_password',
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

  public function getTypeTosAttribute() { 
    $type = "";
    $type.= $this->getAttribute('innovator') ? 'Innov,' : '';
    $type.= $this->getAttribute('seeker') ? 'Seeker,' : '';
    $type.= $this->getAttribute('unsure') ? 'Unsure' : '';
    return $type;
  }
  public function getFullNameAttribute() { return $this->getAttribute('first_name') . ' ' . $this->getAttribute('last_name'); }
  public function getInnovatorTosAttribute() { return $this->getAttribute('innovator') ? 'Yes' : ''; }
  public function getSeekerTosAttribute() { return $this->getAttribute('seeker') ? 'Yes' : ''; }
  public function getUnsureTosAttribute() { return $this->getAttribute('unsure') ? 'Yes' : ''; }
  public function getIsAdminAttribute() { return $this->getAttribute('role') === 'ADMIN'; }

  // TODO - CACHE THESE!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
  public function getEntrepreneurAttribute() 
  {
    if (Session::has('entrepreneur'))
    {
      Log::info('user entrepreneur cache hit');
      return Session::get('entrepreneur');
    }

    $this->load('profiles');
    foreach ($this->profiles as $profile)
    {
      if ($profile->innovator_type == 'ENTREPRENEUR')
      {
        Session::put('entrepreneur',true);
        return true;
      }
    }
    Session::put('entrepreneur',false);
    return false;
  }
  public function getResearcherAttribute() 
  {
    if (Session::has('researcher'))
    {
      Log::info('user researcher cache hit');
      return Session::get('researcher');
    }

    $this->load('profiles');
    foreach ($this->profiles as $profile)
    {
      if ($profile->innovator_type == 'RESEARCHER')
      {
        Session::put('researcher',true);
        return true;
      }
    }
    Session::put('researcher',false);
    return false;
  }
  ////////////////////////////////////////////////////////

  public $from_migration = false;
  public function setPasswordAttribute($value) 
  { 
    if (!empty($value)) 
      $this->attributes['password'] = $this->from_migration ? $value : Hash::make($value);
  }
  public function setMigratePasswordAttribute($value)
  {
    $this->attributes['password'] = $value;
  }
  public function setEmailAttribute($value)
  {
    if (!empty($value))
      $this->attributes['email'] = strtolower($value);
  }

  public static function validate($input)
  {
    return Validator::make($input, static::$rules);
  }
  public static function validatePassword($input)
  {
    return Validator::make($input, static::$password_rules);
  }
  
  

}
