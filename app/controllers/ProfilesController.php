<?php

class ProfilesController extends BaseController {

  public function newProfile()
  {
    Session::forget('active_profile_id');
    Session::forget('active_profile_last_touched');
    return Redirect::route('create_profile');
  }

  public function create($step = 1)  
  {
    //Log::info("creating profile with session data " . print_r(Session::all(), true));

    $active_profile_id = Session::get('active_profile_id');

    if (!empty($active_profile_id))
    {
      if (Session::has('active_profile_last_touched') or Input::has('p'))
      {
        // look for abandoned profiles - if the application was started more than a day ago, just forget about it and start a new one
        $start_time = Session::get('active_profile_last_touched');
        $one_day_ago = new \DateTime;
        $one_day_ago->sub(new \DateInterval('P1D'));

        if ($start_time < $one_day_ago or Input::has('p'))
        {
          $active_profile_id = null;
          Session::forget('active_profile_id');
          Session::forget('active_profile_last_touched');
        }
      }
    }

    //Log::info("creating profile, new session data after abandoned profile purge " . print_r(Session::all(), true));

    if (!empty($active_profile_id))
      $profile = Profile::fetchFullProfileForStep($active_profile_id, $step);

    // TODO - revisit with complete permissions
    // don't let unauthorized users modify a profile!
    if (!empty($profile) and $profile->creator_id != Auth::user()->id)
      return App::abort('500');

    if (empty($profile))
    {
      Session::forget('active_profile_id');
      Session::forget('active_profile_last_touched');
      $profile = new Profile;
    }


    return View::make("profiles.create_step_$step")->with('step', $step)->with('profile', $profile);
  }

  public function edit($id, $step = 1)
  {
    Session::put('active_profile_id', $id);
    Session::put('active_profile_last_touched', new \DateTime);
    return $this->create($step);
  }

  public function store($step = 1)
  {
    Input::flash();

    $profile_id = Input::get('id'); 

    if (!empty($profile_id))
    {
      $profile = Profile::fetchFullProfileForStep($profile_id, $step); 

      // TODO - revisit
      // don't let unauthorized users modify a profile!
      if ($profile->creator_id != Auth::user()->id)
        App::abort('500');

      $profile->fill(Input::all());
    }
    else
    {
      $profile = new Profile(Input::all());
    }

    $v = Profile::validateForStep(Input::all(), $step);
    if (!empty($v) and $v->fails())
      return View::make("profiles.create_step_$step")->with([ 'errors' => $v->messages(), 'step' => $step, 'profile' => $profile ]);

    if (empty($profile->status))
      $profile->status = 'STARTED';
    elseif (Input::has('submit'))
      $profile->status = 'COMPLETE_PENDING';

    $profile->creator()->associate(Auth::user());
    $profile->save();
    $profile->saveAssociatesForStep(Input::all(), $step);

    Session::put('active_profile_id', $profile->id);
    Session::put('active_profile_last_touched', new \DateTime);

    $edit = Input::has('edit') and Input::get('edit');

    if (Input::has('next'))
    {
      Log::info("Going to next step number $step + 1");

      if ($edit)
        return Redirect::route('edit_profile', [ $profile->id, $step + 1 ]);
      else
        return Redirect::route('create_profile', [ $step + 1 ]);
    }
    elseif (Input::has('previous'))
    {
      Log::info("Going to previous step number $step - 1");

      if ($edit)
        return Redirect::route('edit_profile', [ $profile->id, $step - 1 ]);
      else
        return Redirect::route('create_profile', [ $step - 1 ]);
    }
    else
    {
      Log::info("Storing profile on step $step");

      // TODO - this should be the profile preview
      return Redirect::route('my_profiles');
    }
  }

  public function show($id)
  {
    // TODO - more eager fetches
    $profile = Profile::with(['keypersons','institution','sectors'])->find($id);

    // TODO - permissions

    return View::make('profiles.show')->with('profile', $profile);
  }

  public function index()
  {
    return View::make('profiles.search');
  }

  public function savedProfiles()
  {
    return View::make('profiles.saved_profiles');
  }

  public function myProfiles()
  {
    $profiles = Profile::with(['keypersons','institution'])->where('creator_id',Auth::user()->id)->get();

    return View::make('profiles.my_profiles')->with('profiles',$profiles);
  }

  public function contact()
  {
    $profile = Profile::find(Input::get('profile_id'));
    $user = Auth::user();
    $user_message = Input::get('message');

    Log::error("Mailing profile contact to admins");
    $data = array('user' => $user, 'profile' => $profile, 'user_message' => $user_message);
    Mail::send('emails.profile_contact', $data, function($message) use ($user)
    {
      $message->to(Config::get('cassini.admin_email'), 'Motionry Admin')->subject("Motionry Admin: Someone has contacted you about a profile.");
    });

    return Redirect::route('show_profile', [ $profile->id ])->with('message','Your message has been sent!'); 
  }

  public function save()
  {
    $profile = Profile::find(Input::get('profile_id'));
    $user = Auth::user();

    if ($user->subscriptions->contains($profile->id))
      return Redirect::route('show_profile', [ $profile->id ])->with('message', 'This profile has already been saved.  You can access it from the \'Saved Profiles\' link above.');

    $user->subscriptions()->attach($profile);

    return Redirect::route('show_profile', [ $profile->id ])->with('message', 'This profile has been saved.  You can access it from the \'Saved Profiles\' link above.');
  }
}
