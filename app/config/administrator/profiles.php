<?php

return array(

  'title' => 'Profiles',
  'single' => 'Profile',
  'model' => 'Profile',

  'form_width' => 1000,

  'columns' => array(
    'view_form' => [ 'title' => 'Profile Wizard' ],
    'status',
    'regions_tos' => [ 'title' => 'Market Regions' ],
    'sectors_tos' => [ 'title' => 'Market Sectors' ],
    'keypersons_tos' => [ 'title' => 'Key People' ],
    'tech_title',  //todo
  ),
  'edit_fields' => array(
    'status' => array(
      'type' => 'enum',
      'options' => array(
        'STARTED' => 'Started',
        'COMPLETE_PENDING' => 'Submitted (not published)',
        'PUBLISHED' => 'Published',
        'REVOKED' => 'Revoked (un-published)', 
      ),
    ),
    'tech_title',  //todo
    'keypersons' => array(
      'title' => 'Key People (use the Key People tab or the Profile Wizard to edit inline)',
      'type' => 'relationship',
      'name_field' => 'name',
      'sort_field' => 'name',
    ),
    'regions' => array(
      'title' => 'Market Regions',
      'type' => 'relationship',
      'name_field' => 'name',
    ),
    'sectors' => array(
      'title' => 'Market Sectors',
      'type' => 'relationship',
      'name_field' => 'name',
    ),
  ),
);

