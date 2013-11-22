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
        {{ Form::open(array('url' => 'login', 'id' => 'login_form')) }}
        {{ Form::text('email',null, [ 'placeholder' => 'Email address', 'class' => 'form-control' ]) }}
        {{ Form::text('password',null, [ 'placeholder' => 'Password', 'class' => 'form-control' ]) }}
        <div>Forgot <a href="mailto:{{ Config::get('cassini.support_email') }}?subject={{ Config::get('cassini.forgot_email_subject') }}&body={{ Config::get('cassini.forgot_email_body') }}" target="_blank">email</a> or <a href="#">password</a>?</div>
        
        {{ Form::button('SIGN IN', array('class' => 'btn btn-primary', 'type' => 'submit')) }}
        
        {{ Form::close() }}
        </div>
        <div class="signup">
          <div>New to Motionry?</div>
          {{ Form::button('SIGN UP', array('class' => 'btn btn-primary', 'data-toggle' => 'modal', 'data-target' => '#user_signup')) }}
        </div>
      </div>
    </div>
  </div>
</div>

@stop

@section('modal')
<div class="modal fade" id="user_signup" tabindex="-1" role="dialog" aria-labelledby="user_signup_label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="user_signup_label">CREATE A MOTIONRY ACCOUNT</h4>
      </div>
        {{ Form::open( [ 'url' => 'signup', 'id' => 'signup_form', 'role' => 'form' ] ) }}
      <div class="modal-body">
          <div class="checkbox">
            <label>
              {{ Form::checkbox('innovator','innovator',false) }} I'm an innovator (conduct research or have technology)
            </label>
          </div> 
          <div class="checkbox">
            <label>
              {{ Form::checkbox('seeker','seeker',false) }} I'm a seeker (looking for partners)
            </label>
          </div> 
          <div class="checkbox">
            <label>
              {{ Form::checkbox('unsure','unsure',false) }} Unsure and would like to learn more
            </label>
          </div> 
          <div class="form-group">
            {{ Form::label('first_name', 'First Name') }}
            {{ Form::text('first_name',null, [ 'class' => 'form-control', 'id' => 'first_name' ]) }}
          </div>
          <div class="form-group">
            {{ Form::label('last_name', 'Last Name') }}
            {{ Form::text('last_name',null, [ 'class' => 'form-control', 'id' => 'last_name' ]) }}
          </div>
          <div class="form-group">
            {{ Form::label('organization', 'Organization') }}
            {{ Form::text('organization',null, [ 'class' => 'form-control', 'id' => 'organization' ]) }}
          </div>
          <div class="form-group">
            {{ Form::label('phone', 'Phone') }}
            {{ Form::text('phone',null, [ 'class' => 'form-control', 'id' => 'phone' ]) }}
          </div>
          <div class="form-group">
            {{ Form::label('email', 'Email') }}
            {{ Form::text('email',null, [ 'class' => 'form-control', 'id' => 'email' ]) }}
          </div>
          <div class="form-group">
            {{ Form::label('password', 'Password') }}
            {{ Form::text('password',null, [ 'class' => 'form-control', 'id' => 'password' ]) }}
          </div>
          <div class="form-group">
            {{ Form::label('password_confirmation', 'Password Confirmation') }}
            {{ Form::text('password_confirmation',null, [ 'class' => 'form-control', 'id' => 'password_confirmation' ]) }}
          </div>
          <div class="form-group">
            <p class="help-block">The Innovator account requires a brief application which will be sent to you shortly.</p> 
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
        {{ Form::button('SIGN UP', [ 'class' => 'btn btn-primary', 'type' => 'submit' ] ) }}
      </div>
        {{ Form::close() }}
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@stop
