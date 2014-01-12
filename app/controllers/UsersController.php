<?php

class UsersController extends BaseController {

	public function signup()
	{
    Input::flash();
    $v = User::validate(Input::all());

    if ($v->fails())
      return View::make('partials.signup')->with('errors', $v->messages());

    $user = new User(Input::except([ '_token', 'password_confirmation' ]));
    $user->innovator = Input::has('innovator');
    $user->seeker = Input::has('seeker');
    $user->unsure = Input::has('unsure');
    $user->role = 'PENDING';
    $user->save();

    Auth::loginUsingId($user->id);

    Mail::send('emails.welcome_email', [], function($message) use ($user)
    {
      $message->to($user->email, $user->full_name)->subject("Thanks for signing up on Motionry");
    });
    Mail::send('emails.admin_user_signup', ['user' => $user], function($message) 
    {
      $message->to(Config::get('cassini.support_email'), 'Motionry Admin')->subject("Motionry Admin: Someone has signed up for Motionry");
    });

    return View::make('partials.post_register');
    
    // TODO - needed if want to forward to pending authorization page
    //$response = Response::make(View::make('partials.signup_success'), 200);
    //$response->header('signup',true);
    //return $response;  
	}

  public function login()
  {
    $credentials = array(
      'email' => Input::get('email'),
      'password' => Input::get('password')
    );

    if (Auth::attempt($credentials)) 
    {
      Auth::user()->last_login = new \DateTime;
      Auth::user()->save();

      Session::forget('researcher');
      Session::forget('entrepreneur');

      $user = User::with('profiles')->find(Auth::user()->id);

      if ($user->role === 'PENDING')
        return Redirect::route('authorization');
      elseif ($user->innovator and empty($user->profiles))
        return Redirect::route('create_profile');
      else
        return Redirect::route('marketplace');
    }
    else
    {
      return Redirect::guest('/')->with("status", "Error: Invalid Username or Password");
    }
  }

  public function logout()
  {
    Auth::logout();
    return Redirect::to('/');
  }
  
  public function myAccount()
  {
    $profiles = Profile::with(['keypersons','institution','collaborators'])->where('creator_id',Auth::user()->id)->get();

    $collaborations = Auth::user()->collaborations;
    $collaborations->load(['keypersons','institution','collaborators']);

    return View::make('users.my_account')->with('profiles',$profiles->merge($collaborations));
  }

  public function savedProfiles()
  {
    $profiles = Auth::user()->subscriptions;
    $profiles->load('keypersons','institution');
    return View::make('profiles.saved_profiles')->with('profiles', $profiles);
  }

  public function removeSavedProfile()
  {
    $profile = Profile::with('subscribers')->find(Input::get('profile_id'));

    if (empty($profile) or !$profile->subscribers->contains(Auth::user()->id))
    {
      Log::error("User " . Auth::user()->id . " tried to delete non saved profile.  ID input: " . Input::get('profile_id'));
      App::abort('500');
    }

    $profile->subscribers()->detach(Auth::user());
  }

  public function updatePassword()
  {
    $v = User::validatePassword(Input::all());

    if ($v->fails())
      return Redirect::route('my_account')->with('errors', $v->messages());

    if (!Hash::check(Input::get('old_password'), Auth::user()->password))
      return Redirect::route('my_account')->with('errors', new Illuminate\Support\MessageBag(['old_password' => 'Old password is incorrect.']));

    Auth::user()->password = Input::get('new_password');
    Auth::user()->save();

    return Redirect::route('my_account')->with('message', 'Password updated.');
  }
  
  public function email()
  {
    $user = Auth::user();
    $user_message = Input::get('message');

    Log::error("Mailing private email to admins");
    $data = array('user' => $user, 'user_message' => $user_message);
    Mail::send('emails.email_contact', $data, function($message) use ($user)
    {
      $message->to(Config::get('cassini.support_email'), 'Motionry Admin')->subject("Motionry Admin: Someone has sent you a message from their account profile page.");
    });

    return Redirect::route('my_account')->with('message','Your message has been sent!'); 
  }

  public function pcontact()
  {
    $user_message = Input::get('message');
    $name = Input::get('name');
    $email = Input::get('email');

    Log::error("Mailing private email to admins from public pages");
    $data = array('user_message' => $user_message, 'name' => $name, 'email' => $email);
    Mail::send('emails.pub_email_contact', $data, function($message) 
    {
      $message->to(Config::get('cassini.support_email'), 'Motionry Admin')->subject("Motionry Admin: Someone has sent you a message from the public landing page.");
    });

    return Redirect::to('/')->with('message','Your message has been sent!'); 
  }



}
