@extends('layouts.public')

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
        {{ Form::open([ 'url' => URL::to('/login'), 'id' => 'login_form' ]) }}
        @if (Session::has('status'))
          <div class="error-message">
            {{ Session::get('status') }} 
          </div>
        @endif
        {{ Form::text('email',null, [ 'placeholder' => 'Email address', 'class' => 'form-control' ]) }}
        {{ Form::password('password', [ 'placeholder' => 'Password', 'class' => 'form-control' ]) }}
        <div>Forgot <a href="mailto:{{ Config::get('cassini.support_email') }}?subject={{ Config::get('cassini.forgot_email_subject') }}&body={{ Config::get('cassini.forgot_email_body') }}" target="_blank">email</a> or <a href="{{ action('RemindersController@getRemind') }}">password</a>?</div>
        
        {{ Form::button('SIGN IN', [ 'class' => 'btn btn-primary', 'type' => 'submit' ]) }}
        
        {{ Form::close() }}
        </div>
        <div class="signup">
          <div>New to Motionry?</div>
          {{ Form::button('SIGN UP', [ 'class' => 'btn btn-primary', 'data-toggle' => 'modal', 'data-target' => '#user_signup' ]) }}
        </div>
      </div>
    </div>
  </div>
</div>

@stop

@section('modal')
<div class="modal fade" id="user_signup" tabindex="-1" role="dialog" aria-labelledby="user_signup_label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="signup_modal_content">
      @include('partials.signup')
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@stop
