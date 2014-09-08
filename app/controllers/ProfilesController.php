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

    Log::info("The active profile id is " . $active_profile_id);

    // This seems to be causing problems with users taking more than a day to re-work their profiles.  Disabling for now.
    if (false && !empty($active_profile_id))
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

    if (empty($profile)) {
        Log::info("An empty profile was fetched.");
    } else {
        Log::info("User is " . Auth::user()->id);
        Log::info("Is editor " . $profile->isEditor(Auth::user()));
    }

    // TODO - revisit with complete permissions
    // don't let unauthorized users modify a profile!
    if (!empty($profile) and !$profile->isEditor(Auth::user()))
      $profile = null;

    if (empty($profile))
    {
        Log::info("The profile was empty, so creating a new one");
      Session::forget('active_profile_id');
      Session::forget('active_profile_last_touched');
      $profile = new Profile;
    }

    Log::info("Starting profile edit on profile " . $profile->id . " and step " . $step);

    return View::make("profiles.create_step_$step")->with('step', $step)->with('profile', $profile);
  }

  public function edit($id, $step = 1)
  {
      Log::info("Editing with profile id " . $id . "and step " . $step);
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
      if (!$profile->isEditor(Auth::user()))
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

    if (empty($profile->creator_id))
      $profile->creator()->associate(Auth::user());
    $profile->save();
    $profile->saveAssociatesForStep(Input::all(), $step);

    Session::put('active_profile_id', $profile->id);
    Session::put('active_profile_last_touched', new \DateTime);

    $edit = Input::has('edit') and Input::get('edit');

    // forget the user session entrepreneur and researcher cache flags.  these may have changed when he edited his profile
    Session::forget('entrepreneur');
    Session::forget('researcher');

    if (Input::has('next'))
    {
      if ($edit)
        return Redirect::route('edit_profile', [ $profile->id, $step + 1 ]);
      else
        return Redirect::route('create_profile', [ $step + 1 ]);
    }
    elseif (Input::has('previous'))
    {
      if ($edit)
        return Redirect::route('edit_profile', [ $profile->id, $step - 1 ]);
      else
        return Redirect::route('create_profile', [ $step - 1 ]);
    }
    else
    {
      if ($profile->status === 'COMPLETE_PENDING')
      {
        $user = $profile->creator;
        Mail::send('emails.application_submitted_email', [], function($message) use ($user)
        {
          $message->to($user->email, $user->full_name)->subject("Motionry application completed");
        });
        Mail::send('emails.admin_submit_profile', ['user' => $user, 'profile' => $profile], function($message) 
        {
          $message->to(Config::get('cassini.support_email'), 'Motionry Admin')->subject("Motionry Admin: Someone has submitted a profile for review");
        });
      }

      // TODO - this should be the profile preview
      return Redirect::route('my_account');
    }
  }

  public function show($id)
  {
    $profile = Profile::with(['keypersons','institution','sectors','applications','publications.publication','presentations','awards','realPhotos'])->find($id);

    if (!$profile || ($profile->status !== 'PUBLISHED' and !$profile->isEditor(Auth::user())))
      App::abort('404');

    // check permissions
    if (!$profile->isEditor(Auth::user()))
    {
      if ($profile->restrict_seekers) { if (Auth::user()->seeker) { App::abort('404'); } }
      if ($profile->restrict_researchers) { $researcher = Auth::user()->researcher; if ($researcher) { App::abort('404'); } }
      if ($profile->restrict_entrepreneurs) { $entrepreneur = Auth::user()->entrepreneur; if ($entrepreneur) { App::abort('404'); } }
    }

    return View::make('profiles.show')->with('profile', $profile);
  }

  public function showPublic($slug)
  {
      $profile = Profile::with([ 'institution', 'sectors', 'applications', 'photos' ])->find($slug);

      if (empty($profile) || !$profile->isPublicDisplayed()) {
          App::abort('404');
      }

      // send 301 permanent redirect if the user-supplied slug doesn't match the profile slug but a profile was found by id
      if ($profile->slug != $slug) {
          return Redirect::route('show_public_profile', [ $profile->slug ], 301);
      }

      return View::make('profiles.show_public')->with('profile', $profile);
  }

  public function clearSearchFields()
  {
      Session::forget('saved_search');
      return true;
  }

  public function index()
  {
    Input::flash();

    $seeker = Auth::user()->seeker;
    $researcher = Auth::user()->researcher;
    $entrepreneur = Auth::user()->entrepreneur;

    $savedSearch = Session::get('saved_search');

    $search_params = [];
    if (!empty($savedSearch) && !Input::has('a')) {
        parse_str($savedSearch, $search_params);
    }

    // "a" is the name of the submit button
    if (Input::has('a') || !empty($search_params))
    {
      $query = Input::has('q') ? Input::get('q') : (isset($search_params['q']) ? $search_params['q'] : '');
      $market_sectors = Input::has('m') ? Input::get('m') : (isset($search_params['m']) ? $search_params['m'] : null);
      $product_stages = Input::has('p') ? Input::get('p') : (isset($search_params['p']) ? $search_params['p'] : null);
      $innovator_types = Input::has('i') ? Input::get('i') : (isset($search_params['i']) ? $search_params['i'] : null);

      // Store the search params in the user session
      Session::put('saved_search', http_build_query(['q' => $query, 
          'm' => $market_sectors, 
          'p' => $product_stages, 
          'i' => $innovator_types]));

      // query sphinx if a search term was entered
      if (!empty($query))
      {
        $results = SphinxSearch::search($query)->get(true);
      }

      // find all the ids of the results of sphinx search 
      $ids = [];
      if (!empty($results) and $results)
        $ids = array_map(function($res) { return $res->id; }, $results);

      // if a search term was entered and there are no results, return an empty result set
      if (!empty($query) and empty($ids))
          return View::make('profiles.search')->with('results', [])->with('saved_input',$search_params);

      // do the eager fetches
      $results = Profile::with(['keypersons','institution','applications','sectors']);

      // filter the product stages
      if (!empty($product_stages))
        $results = $results->whereIn('product_stage',$product_stages);

      // filter the innovator types
      if (!empty($innovator_types))
      {
        $results = $results->where(function($query) use ($innovator_types) 
        {
          if (in_array('TECHNOLOGY_ENTREPRENEUR',$innovator_types))
            $query->orWhere('organization_type','=','FOR_PROFIT');
          if (in_array('RESEARCHER',$innovator_types))
            $query->orWhere('innovator_type','=','RESEARCHER');
          if (in_array('NON_PROFIT_ENTREPRENEUR',$innovator_types))
            $query->orWhere('organization_type','=','NON_PROFIT');
        });
      }

      // filter for permissions
      if (Auth::user()->role !== 'ADMIN')
      {
        if ($seeker)
          $results = $results->where('restrict_seekers',false);
        if ($researcher)
          $results = $results->where('restrict_researchers',false);
        if ($entrepreneur)
          $results = $results->where('restrict_entrepreneurs',false);
      }

      // filter for published
      $results = $results->where('status','PUBLISHED');

      // filter the market sectors
      if (!empty($market_sectors))
      {
        $results = $results->whereHas('sectors', function($query) use ($market_sectors)
      {
        $query->whereIn('sectors.id',$market_sectors);
      });
      }

      // if there are results from sphinx, then filter for these profiles
      if (!empty($ids))
        $results = $results->whereIn('id',$ids);
      
      $results = $results->paginate(Config::get('cassini.search_results_page_size'));
    }
    else
    {
      $results = Profile::with(['keypersons','institution','sectors','applications']);

      // filter for permissions
      if (Auth::user()->role !== 'ADMIN')
      {
        if ($seeker)
          $results = $results->where('restrict_seekers',false);
        if ($researcher)
          $results = $results->where('restrict_researchers',false);
        if ($entrepreneur)
          $results = $results->where('restrict_entrepreneurs',false);
      }

      $results = $results->where('status','PUBLISHED')->orderBy('created_at','DESC')->paginate(Config::get('cassini.search_results_page_size'));
    }

    return View::make('profiles.search')->with('results',$results)->with('saved_input',$search_params);
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

    return Redirect::route('show_profile', [ $profile->id ])->with('message','Thank you and your message has been sent.'); 
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

    return Redirect::route('saved_profiles')->with('message','Thank you and your message has been sent.'); 
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
