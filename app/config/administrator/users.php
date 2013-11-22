<?php

return array(

  'title' => 'Users',
  'single' => 'User',
  'model' => 'User',

  'rules' => array(
      'first_name' => 'required',
      'last_name' => 'required',
      'email' => 'required|email|unique:users,email',
      'password' => 'required|min:8', 
      'role' => 'required',
    ),

  'columns' => array(
    'id',
    'full_name' => [ 'title' => 'Full Name', 'sort_field' => 'last_name' ],
    'email' => [ 'title' => 'Email' ],
    'last_login' => [ 'title' => 'Last Login' ],
    'innovator_tos' => [ 'title' => 'Innovator', 'sort_field' => 'innovator' ],
    'seeker_tos' => [ 'title' => 'Seeker', 'sort_field' => 'seeker' ],
    'unsure_tos' => [ 'title' => 'Unsure', 'sort_field' => 'unsure' ],
    'title' => [ 'title' => 'Title' ],
    'organization' => [ 'title' => 'Organizatin' ],
    'role' => [ 'title' => 'Role' ],
    'phone' => [ 'title' => 'Phone' ],
    'created_at' => [ 'title' => 'Created Date' ],
  ),
  'edit_fields' => array(
    'first_name' => [ 'title' => 'First Name' ],
    'last_name' => [ 'title' => 'Last Name' ],
    'email' => [ 'title' => 'Email' ],
    'innovator' => [ 'title' => 'Innovator', 'type' => 'bool' ], 
    'seeker' => [ 'title' => 'Seeker', 'type' => 'bool' ], 
    'unsure' => [ 'title' => 'Unsure', 'type' => 'bool' ], 
    'title' => [ 'title' => 'Title' ],
    'organization' => [ 'title' => 'Organizatin' ],
    'role' => [ 'title' => 'Role', 'type' => 'enum', 'options' => [ 'PENDING', 'USER', 'PRESS', 'ADMIN' ] ],
    'phone' => [ 'title' => 'Phone' ],
    'password' => [ 'title' => 'Password', 'type' => 'password', 'title' => 'Password' ] ,
  ),
);

