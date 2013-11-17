<?php

use Symfony\Component\HttpFoundation\File\UploadedFile;

class Keyperson extends Eloquent {
  use Codesleeve\Stapler\Stapler;

	protected $guarded = array();

	public static $rules = array();

  protected $table = 'keypersons'; 

  public function profile()
  {
    return $this->belongsTo('Profile');
  }

  public function __construct(array $attributes = array())
  {
    // TODO - decide what to do with stapler
    $this->hasAttachedFile('photo', array(
      'styles' => array(
        'medium' => '300x300',
        'thumb' => '100x100'
      )));

    parent::__construct($attributes);
  }

  public function getProfileTosAttribute()
  {
    $profile = $this->getAttribute('profile');
    return $profile->id . ': ' . $profile->tech_title;
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
