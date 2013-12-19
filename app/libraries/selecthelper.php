<?php

class SelectHelper
{
  public static function get_region_options() 
  {  
    // TODO - cache these
    $regions = Region::all();   
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
    $sectors = Sector::all();   
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
    $publications = Publication::all();   
    $options = [ '' => 'Select a web publication...' ];
    foreach ($publications as $publication)
    {
      $options[$publication->id] = $publication->name;
    }
    return $options; 
  }

}

