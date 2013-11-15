<?php

return array(

  'title' => 'Profiles',
  'single' => 'Profile',
  'model' => 'Profile',

  'columns' => array(
    'id',
    'status',
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
  ),
);

