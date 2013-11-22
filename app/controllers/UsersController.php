<?php

class UsersController extends BaseController {

	public function signup()
	{
    Input::flash();
    $v = User::validate(Input::all());

    if ($v->fails())
      return View::make('partials.signup')->with('errors', $v->messages());
    
    $response = Response::make(View::make('partials.signup_success'), 200);
    $response->header('signup',true);
    return $response;  
	}

}
