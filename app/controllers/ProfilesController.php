<?php

class ProfilesController extends BaseController {

  public function create($step = 1)  
  {
    Log::info("creating profile with session data " . print_r(Session::all(), true));

    $active_profile_id = Session::get('active_profile_id');

    if (!empty($active_profile_id))
    {
      if (Session::has('active_profile_last_touched'))
      {
        // look for abandoned profiles - if the application was started more than a day ago, just forget about it and start a new one
        $start_time = Session::get('active_profile_last_touched');
        $one_day_ago = new \DateTime;
        $one_day_ago->sub(new \DateInterval('P1D'));

        if ($start_time < $one_day_ago)
        {
          $active_profile_id = null;
          Session::forget('active_profile_id');
          Session::forget('active_profile_last_touched');
        }
      }
    }

    Log::info("creating profile, new session data after abandoned profile purge " . print_r(Session::all(), true));

    if (!empty($active_profile_id))
      $profile = Profile::find($active_profile_id);
    else
      $profile = new Profile;

    return View::make("profiles.create_step_$step")->with('step', $step)->with('profile', $profile);
  }

  public function edit($id)
  {
  }

  public function store($step = 1)
  {
    $profile_id = Input::get('profile_id'); 

    if (!empty($profile_id))
      $profile = Profile::find($profile_id); 
    else
      $profile = new Profile(Input::all());

    $profile->save();

    Session::put('active_profile_id', $profile->id);
    Session::put('active_profile_last_touched', new \DateTime);

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
