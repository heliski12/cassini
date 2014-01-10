<?php

return array(

  'title' => 'Institutions',
  'single' => 'Institution',
  'model' => 'Institution',

  'columns' => array(
    'id',
    'name',
    'logo_link' => ['title' => 'Photo', 'output' => '<img src="(:value)"/>'],
  ),
  'edit_fields' => array(
    'name',
  ),
);
