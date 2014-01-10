<?php

return array(

  'title' => 'Photos',
  'single' => 'Photo',
  'model' => 'Photo',

  'columns' => array(
    'id',
    'description',
    'profile_tos' => [ 'title' => 'Profile' ],
    'view_form' => [ 'title' => 'Profile Wizard' ],
    'photo_link' => ['title' => 'Photo', 'output' => '<img src="(:value)"/>'],
  ),
  'edit_fields' => array(
    'description',
  ),
);

