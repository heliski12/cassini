<?php

return array(

  'title' => 'Publications',
  'single' => 'Publication',
  'model' => 'Publication',

  'columns' => array(
    'id',
    'name',
    'photo_link' => ['title' => 'Photo', 'output' => '<img src="(:value)"/>'],
    'edit_photo' => ['title' => 'Edit photo'],
  ),
  'edit_fields' => array(
    'name',
  ),
);

