@extends('layouts.master')

@section('title')
  @parent
@stop

@section('wrap_open')
  <div class="wrap-login">
@stop

@section('content')

<div class="container-full login-splash">
  <div class="container login-content">
    <div class="row">
      <div class="col-sm-7 col-sm-offset-1">
        <h2>
          Welcome to Motionry and<br/>
          discover technologies that matter.
        </h2>
      </div>
      <div class="col-sm-3">
        <div class="signin">
        {{ Form::open(array('url' => 'login', 'id' => 'login-form')) }}
        {{ Form::text('email',null, [ 'placeholder' => 'Email address', 'class' => 'form-control' ]) }}
        {{ Form::text('password',null, [ 'placeholder' => 'Password', 'class' => 'form-control' ]) }}
        <div>Forgot <a href="mailto:{{ Config::get('cassini.support_email') }}?subject={{ Config::get('cassini.forgot_email_subject') }}&body={{ Config::get('cassini.forgot_email_body') }}" target="_blank">email</a> or <a href="#">password</a>?</div>
        
        {{ Form::button('Sign In', array('class' => 'btn btn-info', 'type' => 'submit')) }}
        
        {{ Form::close() }}
        </div>
        <div class="signup">
          <div>New to Motionry?</div>
          {{ Form::button('Sign Up', array('class' => 'btn btn-info')) }}
        </div>
      </div>
    </div>
  </div>

</div>

@stop
