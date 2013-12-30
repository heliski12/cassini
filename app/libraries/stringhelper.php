<?php

class StringHelper
{
  public static function clean_url($url)
  {
    if (empty($url))
      return null;
    if (starts_with($url, 'http://') or starts_with($url, 'https://'))
      return $url;
    return "http://".$url;
  }

}

