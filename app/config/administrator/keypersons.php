<?php

return array(

  'title' => 'Key People',
  'single' => 'Key Person',
  'model' => 'Keyperson',

  'columns' => array(
    'id',
    'name',
    'photo_file_name' => array(
      'title' => 'Photo',
      'type' => 'image',
      'output' => '<img src="http://s3.amazonaws.com/motionry-dev/(:value)" height="100" />',
    ),
  ),
  'edit_fields' => array(
    'name',
  ),
);
