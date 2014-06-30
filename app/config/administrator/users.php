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
    'last_login_ip' => [ 'title' => 'Last Login IP' ],
    'type_tos' => [ 'title' => 'type' ],
    'role' => [ 'title' => 'Role' ],
    'organization' => [ 'title' => 'Organization' ],
    'created_at' => [ 'title' => 'Created Date' ],
  ),
  'filters' => array(
    'first_name',
    'last_name',
    'email',
  ),
  'edit_fields' => array(
    'first_name' => [ 'title' => 'First Name' ],
    'last_name' => [ 'title' => 'Last Name' ],
    'email' => [ 'title' => 'Email' ],
    'innovator' => [ 'title' => 'Innovator', 'type' => 'bool' ], 
    'seeker' => [ 'title' => 'Seeker', 'type' => 'bool' ], 
    'unsure' => [ 'title' => 'Unsure', 'type' => 'bool' ], 
    'title' => [ 'title' => 'Title' ],
    'organization' => [ 'title' => 'Organization' ],
    'role' => [ 'title' => 'Role (Changing to USER approves user and sends a welcome email)', 'type' => 'enum', 'options' => [ 'PENDING', 'USER', 'PRESS', 'ADMIN' ] ],
    'phone' => [ 'title' => 'Phone' ],
    'password' => [ 'title' => 'Password', 'type' => 'password', 'title' => 'Password' ] ,
  ),
);

