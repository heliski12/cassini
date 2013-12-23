<?php

return [

  'filestorage' => 'filesystem',  // or s3
  'admin_email' => 'jstavis@gmail.com',

  'profile_statuses' => [ 
    'STARTED' => 'Started',
    'COMPLETE_PENDING' => 'Submitted (not published)',
    'PUBLISHED' => 'Published',
    'REVOKED' => 'Revoked (un-published)',  
  ],

  'provider_types' => [
    'TECHNOLOGY_ENTREPRENEUR' => 'Technology Entrepreneur',
    'ACADEMIC_RESEARCHER' => 'Academic Researcher',
    'GOVERNMENT_RESEARCHER' => 'Government Researcher',
  ],

  'product_stages' => [
    'EXPERIMENTAL' => 'Experimental',
    'PROTOTYPE' => 'Prototpye',
    'MARKET_PILOT' => 'Market Pilot',
    'MARKET' => 'Market', 
  ],

  'funding_statuses' => [
    'FUNDED' => 'We have investors or receive funding',
    'SEEKING' => 'We are seeking funding',
    'NOT_FUNDED' => 'Not currently funded',
  ],

  'intellectual_property_types' => [
    'TRADEMARKS' => 'Trademarks',
    'TRADEMARKS_PENDING' => 'Trademarks pending',
    'PATENTS' => 'Patents',
    'PATENTS_PENDING' => 'Patents pending',
  ],

  'viewer_types' => [
    'RESTRICT_SEEKERS' => 'Seekers (Companies, Foundations, Gov\'t Agencies)',
    'RESTRICT_RESEARCHERS' => 'Researchers',
    'RESTRICT_ENTREPRENEURS' => 'Entrepreneurs',
  ],

  'status_not_specified' => 'Started',
  'not_specified' => 'Not Specified',
  'not_applicable' => 'n/a',

  'forgot_email_subject' => 'Forgot Email',
  'forgot_email_body' => 'To send the registered email address please provide your first and last name as well as your organization.  We will call the registered phone number for verification.',
  'support_email' => 'support@motionry.com',

];
