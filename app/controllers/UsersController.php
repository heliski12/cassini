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
    
    $response = Response::make(View::make('partials.signup_success'), 200);
    $response->header('signup',true);
    return $response;  
	}

}
