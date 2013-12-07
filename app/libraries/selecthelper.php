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

}

