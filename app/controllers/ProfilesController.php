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

    if (empty($profile->creator))
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
      return Redirect::route('my_account');
    }
  }

  public function show($id)
  {
    $profile = Profile::with(['keypersons','institution','sectors','applications','publications.publication','presentations','awards','photos'])->find($id);

    // TODO - permissions

    return View::make('profiles.show')->with('profile', $profile);
  }

  public function index()
  {
    Input::flash();

    if (Input::has('a'))
    {
      // TODO - search goes here
      $results = Profile::with(['keypersons','institution','sectors'])->orderBy('created_at','DESC')->get();
    }
    else
    {
      $results = Profile::with(['keypersons','institution','sectors'])->where('status','PUBLISHED')->orderBy('created_at','DESC')->take(10)->get();
    }

    return View::make('profiles.search')->with('results',$results);
  }

  public function contact()
  {
    $profile = Profile::find(Input::get('profile_id'));
    $user = Auth::user();
    $user_message = Input::get('message');

    $data = array('user' => $user, 'profile' => $profile, 'user_message' => $user_message);
    Mail::send('emails.profile_contact', $data, function($message) use ($user)
    {
      $message->to(Config::get('cassini.support_email'), 'Motionry Admin')->subject("Motionry Admin: Someone has contacted motionry about a profile.");
    });

    return Redirect::route('show_profile', [ $profile->id ])->with('message','Your message has been sent!'); 
  }

  public function contactMultiple()
  {
    $profile_ids = explode(',',Input::get('profile_ids'));
    $user = Auth::user();
    $user_message = Input::get('message');

    $profiles = Profile::whereIn('id', $profile_ids)->get();

    if (empty($profiles))
    {
      Log::error('User ' . $user->id . ' has tried to contact for missing profiles, input: ' . Input::get('profile_ids'));
      App::abort('500');
    }

    $data = array('user' => $user, 'profiles' => $profiles, 'user_message' => $user_message);
    Mail::send('emails.profile_contact_multiple', $data, function($message) use ($user)
    {
      $message->to(Config::get('cassini.support_email'), 'Motionry Admin')->subject("Motionry Admin: Someone has contacted motionry about one or more profiles.");
    });

    return Redirect::route('saved_profiles')->with('message','Your message has been sent!'); 
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

  public function addEditor()
  {
    $profile = Profile::with('collaborators')->find(Input::get('profile_id'));
    $user = Auth::user();

    if (!$profile->isEditor($user))
    {
      Log::info("Invalid user tried to add editor profile.  User: $user->id, Profile: $profile->id");
      App::abort('500');
    }

    $email = Input::get('email');

    if (empty($email))
      return View::make('partials.secondary_editors')->with([ 'profile' => $profile, 'error' => 'No user found!' ]);

    $new_editor = User::where('email', strtolower($email))->first();

    if (empty($new_editor))
      return View::make('partials.secondary_editors')->with([ 'profile' => $profile, 'error' => 'No user found for ' . $email . '!' ]);

    $error = null;
    if (!$profile->isEditor($new_editor))
      $profile->collaborators()->attach($new_editor);
    else
      $error = 'User is an admin or already an editor.'; 

    $profile = Profile::with('collaborators')->find($profile->id);

    return View::make('partials.secondary_editors')->with(['profile' => $profile, 'error' => $error]);
  }

  public function removeEditor()
  {
    $profile = Profile::with('collaborators')->find(Input::get('profile_id'));
    $user = Auth::user();

    if (!$profile->isEditor($user))
    {
      Log::info("Invalid user tried to remove editor from profile.  User: $user->id, Profile: $profile->id");
      App::abort('500');
    }

    $editor = User::find(Input::get('user_id'));

    if (empty($editor) or !$profile->collaborators->contains($editor->id))
      return View::make('partials.secondary_editors')->with([ 'profile' => $profile, 'error' => 'That editor was not found.' ]);

    $profile->collaborators()->detach($editor);
    $profile = Profile::with('collaborators')->find($profile->id);

    return View::make('partials.secondary_editors')->with(['profile' => $profile]);
  }
}
