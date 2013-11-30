<?php

class ProfilesController extends BaseController {

  public function create($step = null)  
  {
    // TODO look up profile for user

    if (empty($step) or $step == 1)
      return View::make('profiles.create_step_1');
    elseif ($step == 2)
      return View::make('profiles.create_step_2');
    else
      return View::make('profiles.create_step_3');
  }

  public function index()
  {
    return "marketplace index";
  }

}
