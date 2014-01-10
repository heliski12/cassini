<?php

use Symfony\Component\HttpFoundation\File\UploadedFile;

class Keyperson extends BaseModel {
  use Codesleeve\Stapler\Stapler;

	protected $guarded = array();

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

Keyperson::saving(function($keyperson)
{
  // TODO - check for admin
  if (Input::has('photo_file_name'))
  {
    //print_r(Input::get('photo_file_name'));
    //$original = $keyperson->getOriginal();
    //print_r("\n" . $original['photo_file_name']);

    // stapler attempt - this would require line 119 of stapler/storage/filesystem to be changed from rename to copy 
    /*
    $path = public_path() . '/system/originals/' . Input::get('photo_file_name');
    $new_path = public_path() . '/system/originals/Keyperson/photo/' . Input::get('photo_file_name');

    $file = new UploadedFile($path, Input::get('photo_file_name'), null, filesize($path), UPLOAD_ERR_OK, true); 
    $keyperson->photo = $file;

    copy($path,$new_path);
     */
  }
  
});
Keyperson::updating(function($keyperson)
{
  if (Input::has('photo_file_name'))
  {
    //print_r(Input::get('photo_file_name'));
    //$original = $keyperson->getOriginal();
    //print_r("\n" . $original['photo_file_name']);
  }  
});

