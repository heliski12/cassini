<?php

return array(

  'title' => 'Institutions',
  'single' => 'Institution',
  'model' => 'Institution',

  'columns' => array(
    'id',
    'name',
    'logo_link' => ['title' => 'Logo', 'output' => '<img src="(:value)"/>'],
    'edit_logo' => ['title' => 'Edit logo'],
  ),
  'edit_fields' => array(
    'name',
  ),
);
