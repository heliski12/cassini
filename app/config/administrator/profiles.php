<?php

return array(

  'title' => 'Profiles',
  'single' => 'Profile',
  'model' => 'Profile',

  // TOOD: rules

  'form_width' => 500,

  'columns' => array(
    'id' => [ 'title' => 'Id' ],
    'tech_title' => [ 'title' => 'Technology' ],  
    'view_form' => [ 'title' => 'Profile Wizard' ],
    'status_tos' => [ 'title' => 'Status' ],
    'creator_tos' => [ 'title' => 'Creator' ],
    'regions_tos' => [ 'title' => 'Market Regions' ],
    'sectors_tos' => [ 'title' => 'Market Sectors' ],
    'keypersons_tos' => [ 'title' => 'Key People' ],
  ),
  'filters' => array(
    'tech_title',
  ),
  'edit_fields' => array(
    'status' => array(
      'title' => 'Status',
      'type' => 'enum',
      'options' => array(
        'STARTED' => Config::get('cassini.profile_statuses')['STARTED'],
        'COMPLETE_PENDING' => Config::get('cassini.profile_statuses')['COMPLETE_PENDING'],
        'PUBLISHED' => Config::get('cassini.profile_statuses')['PUBLISHED'],
        'REVOKED' => Config::get('cassini.profile_statuses')['REVOKED'], 
      ),
    ),
    'innovator_type' => array(
      'title' => 'Provider Type',
      'type' => 'enum',
      'options' => array(
        'ENTREPRENEUR' => Config::get('cassini.provider_types')['ENTREPRENEUR'],
        'RESEARCHER' => Config::get('cassini.provider_types')['RESEARCHER'],
      ),
    ),
    'creator' => array(
      'title' => 'Creator',
      'type' => 'relationship',
      'name_field' => 'email',
    ),
    'collaborators' => array(
      'title' => 'Secondary Editors',
      'type' => 'relationship',
      'name_field' => 'email',
    ),
    'organization' => [ 'title' => 'Organization (if applicable)' ],
    'organization_type' => array(
      'title' => 'Organization type',
      'type' => 'enum',
      'options' => array(
        'FOR_PROFIT' => 'FOR PROFIT', 
        'NON_PROFIT' => 'NON PROFIT', 
      ),
    ),
    'institution' => array(
      'title' => 'Institution (if applicable)',
      'type' => 'relationship',
      'name_field' => 'name',
    ),
    'institution_department' => [ 'title' => 'Institution Department (if applicable)' ],
    'keypersons' => array(
      'title' => 'Key People (use the Key People tab or the Profile Wizard to edit inline)',
      'type' => 'relationship',
      'name_field' => 'email',
      'sort_field' => 'email',
    ),
    'tech_title' => [ 'title' => 'Technology Title' ],
    'tech_description' => array(
      'title' => 'Technology Description',
      'type' => 'textarea'
    ),
    'product_stage' => array(
      'title' => 'Product Stage',
      'type' => 'enum',
      'options' => array(
        'EXPERIMENTAL' => Config::get('cassini.product_stages')['EXPERIMENTAL'],
        'PROTOTYPE' => Config::get('cassini.product_stages')['PROTOTYPE'],
        'MARKET_PILOT' => Config::get('cassini.product_stages')['MARKET_PILOT'],
        'MARKET' => Config::get('cassini.product_stages')['MARKET'], 
      ),
    ),
    //'funding_status' => array(
      //'title' => 'Funding Status',
      //'type' => 'enum',
      //'options' => array(
        //'FUNDED' => Config::get('cassini.funding_statuses')['FUNDED'],
        //'SEEKING' => Config::get('cassini.funding_statuses')['SEEKING'],
        //'NOT_FUNDED' => Config::get('cassini.funding_statuses')['NOT_FUNDED'],
      //),
    //),
    'ip_trademarks' => array(
      'title' => 'Intellectual Property Trademarks',
      'type' => 'bool',
    ),
    'ip_trademarks_pending' => array(
      'title' => 'Intellectual Property Trademarks Pending',
      'type' => 'bool',
    ),
    'ip_patents' => array(
      'title' => 'Intellectual Property Patents',
      'type' => 'bool',
    ),
    'ip_patents_pending' => array(
      'title' => 'Intellectual Property Patents Pending',
      'type' => 'bool',
    ),
    'photos' => array(
      'title' => 'Photos (use the Photos tab or the Profile Wizard to edit inline)',
      'type' => 'relationship',
      'name_field' => 'description',
      'sort_field' => 'description',
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
    'applications' => array(
      'title' => 'Applications',
      'type' => 'relationship',
      'name_field' => 'name',
    ),
    'website_url' => [ 'title' => 'Webpage URL' ],
    'presentations' => array(
      'title' => 'Presentations (use the Presentations tab or the Profile Wizard to edit inline)',
      'type' => 'relationship',
      'name_field' => 'title',
      'sort_field' => 'title',
    ),
    'publications' => array(
      'title' => 'Publications (use the Publications tab or the Profile Wizard to edit inline)',
      'type' => 'relationship',
      'name_field' => 'article_title',
      'sort_field' => 'article_title',
    ),
  ),
);

