<?php

class ProfilesController extends BaseController {

  public function create($step = 1)  
  {
    // TODO look up profile for user

    $profile = new Profile;
    //$profile = Profile::find(1);

    if ($step == 1)
      return View::make('profiles.create_step_1')->with('step', 1)->with('profile', $profile);
    elseif ($step == 2)
      return View::make('profiles.create_step_2')->with('step', 2)->with('profile', $profile);
    else
      return View::make('profiles.create_step_3')->with('step', 3)->with('profile', $profile);
  }

  public function store($step = 1)
  {
    if (Input::has('next'))
    {
      Log::info("Going to next step number $step + 1");

      return Redirect::route('create_profile', [ $step + 1 ]);
    }
    elseif (Input::has('previous'))
    {
      Log::info("Going to previous step number $step - 1");

      return Redirect::route('create_profile', [ $step - 1 ]);
    }
    else
    {
      Log::info("Storing profile on step $step");

      return "Profile saved!";
    }
  }

  public function index()
  {
    return "marketplace index";
  }

}
