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

}

