<?php

return array(

  'title' => 'Key People',
  'single' => 'Key Person',
  'model' => 'Keyperson',

  'rules' => array(
    'profile' => 'required',
  ),

  'columns' => array(
    'id',
    'first_name',
    'last_name',
    'profile_tos' => [ 'title' => 'Profile' ],
    'photo_file_name' => array(
      'title' => 'Photo',
      'type' => 'image',
      //'output' => '<img src="'.URL::to('/').'/system/originals/Keyperson/photo/(:value)" height="100" />',
      'output' => '<img src="'.URL::to('/').'/images/Keyperson/photo/(:value)" height="100" />',
    ),
  ),
  'edit_fields' => array(
    'first_name',
    'last_name',
    'profile' => array(
      'title' => 'Profile',
      'type' => 'relationship',
      'name_field' => 'tech_title',
    ),
    //'photo_file_name' => array(
      //'title' => 'Photo (automatically resized to 300x300 and 100x100)',
      //'type' => 'image',
      //'naming' => 'random',
      //'length' => 10,
      ////'location' => public_path() . '/system/originals/Keyperson/photo/',
      //'location' => public_path() . '/images/Keyperson/photo/',
      //'sizes' => array(
        ////array(300,300,'auto', public_path() . '/system/originals/Keyperson/photo/medium/',100),
        ////array(100,100,'auto', public_path() . '/system/originals/Keyperson/photo/thumb/',100),
        //array(300,300,'auto', public_path() . '/images/Keyperson/photo/medium/',100),
        //array(100,100,'auto', public_path() . '/images/Keyperson/photo/thumb/',100),
      //),
    //),
  ),
);
