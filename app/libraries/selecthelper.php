<?php

class SelectHelper
{
  public static function get_region_options() 
  {  
    // TODO - cache these
    $regions = Region::orderBy('name')->get();   
    $options = [];
    foreach ($regions as $region)
    {
      $options[$region->id] = $region->name;
    }
    return $options; 
  }

  public static function get_sector_options() 
  {  
    // TODO - cache these
    $sectors = Sector::orderBy('name')->get();   
    $options = [];
    foreach ($sectors as $sector)
    {
      $options[$sector->id] = $sector->name;
    }
    return $options; 
  }

  public static function get_publication_options()
  {
    // TODO - cache these
    $publications = Publication::orderBy('name')->get();   
    $options = [ '' => 'Select a web publication...' ];
    foreach ($publications as $publication)
    {
      $options[$publication->id] = $publication->name;
    }
    return $options; 
  }

  public static function get_institution_options()
  {
    // TODO - cache these
    $institutions = Institution::orderBy('name')->get();
    $options = [ '' => 'Select an institution...' ];
    foreach ($institutions as $institution)
    {
      $options[$institution->id] = $institution->name;
    }
    return $options;
  }

}

