<?php

class UsersController extends BaseController {

	public function signup()
	{
    Input::flash();
    $v = User::validate(Input::all());

    if ($v->fails())
      return View::make('partials.signup')->with('errors', $v->messages());

    $user = new User(Input::except([ '_token', 'password_confirmation' ]));
    $user->role = 'PENDING';
    $user->save();

    Auth::loginUsingId($user->id);

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

      if (Auth::user()->role === 'PENDING')
        return Redirect::route('authorization');
      elseif (empty(Auth::user()->profile))
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
  
  

}
