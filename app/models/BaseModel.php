<?php

class BaseModel extends Eloquent {

  // return the old input value if it exists, if not return the object's field data
  public function getFormValue($old_input, $field_name)
  {
    if (!empty($old_input))
      return $old_input;
    else
      return $this->$field_name;
  }

  public function getCSVLine()
  {
    if (!empty(static::$csv_headings))
    {
      $line = [];
      $headings = explode(',',static::$csv_headings);
      foreach ($headings as $heading)
      {
        $parts = explode('.',$heading);
        if (sizeof($parts) == 1)
        {
          // is a normal field, just push its value onto the array
          array_push($line,$this->$heading); 
        }
        else
        {
          // is a dot field, look up the relationship
          $rel = $this->$parts[0];
          if (empty($rel))
          {
            array_push($line,'');
            continue;
          }

          if ($rel instanceof Illuminate\Database\Eloquent\Collection)
          {
            // relationship is a collection, iterate over it and create a sub cell
            $cell = [];
            foreach ($rel as $single)
            {
              array_push($cell,$single->$parts[1]);
            }
            array_push($line, implode(";",$cell));
          }
          else
          {
            // relationship is just an object, get the field value
            array_push($line, $rel->$parts[1]);
          }
        }
      }
    }
    return $this->str_putcsv($line) . "\n";
  }

  public static function getCSVHeading()
  {
    if (!empty(static::$csv_headings))
    {
      return static::$csv_headings . "\n";
    }
  }

  // taken from https://gist.github.com/johanmeiring/2894568
  private function str_putcsv($input, $delimiter = ',', $enclosure = '"')
  {
    // Open a memory "file" for read/write...
    $fp = fopen('php://memory', 'r+');
    // ... write the $input array to the "file" using fputcsv()...
    fputcsv($fp, $input, $delimiter, $enclosure);
    // ... rewind the "file" so we can read what we just wrote...
    rewind($fp);
    // ... read the entire line into a variable...
    $data = fread($fp, 10485760);
    // ... close the "file"...
    fclose($fp);
    // ... and return the $data to the caller, with the trailing newline from fgets() removed.
    return rtrim($data, "\n");
  }
  

}

