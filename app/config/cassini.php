<?php

return [

  'filestorage' => 'filesystem',  // or s3

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

  'not_specified' => 'Not Specified',
  'not_applicable' => 'n/a',

];
