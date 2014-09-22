@extends('layouts.public')

@section('content')
  <div class="container">
      <div class="row">
          <div class="col-md-3 col-sm-6 col-xs-8">
              <a href="{{ URL::to('/') }}"><img alt="Motionry Logo" class="logo img-responsive" src="{{ asset('img/Black-Motionry-Logo.png') }}"/></a>
          </div>
      </div>
      <hr/>

      <div class="row">
          <div class="col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12">
              <div class="signin">
                  <div class="login-or-signup">
                      <span class="login-msg">SIGN IN</span> or <span class="login-msg"><a href="#user_signup" data-toggle="modal" data-target="#user_signup">SIGN UP</a></span> 
                  </div>
                  {{ Form::open([ 'url' => URL::to('/login'), 'id' => 'login_form' ]) }}
                  @if (Session::has('status'))
                  <div class="error-message">
                      {{ Session::get('status') }} 
                  </div>
                  @endif
                  {{ Form::text('email',null, [ 'placeholder' => 'Email address', 'class' => 'form-control' ]) }}
                  {{ Form::password('password', [ 'placeholder' => 'Password', 'class' => 'form-control' ]) }}
                  <a class="forgot" href="#" data-toggle='modal' data-target="#forgot_password">Forgot password?</a>

                  {{ Form::button('SIGN IN', [ 'class' => 'btn btn-primary', 'type' => 'submit' ]) }}

                  {{ Form::close() }}
              </div>
          </div>

      </div>
  </div>

@stop

@section('modal')
  @include('partials.signup_wrap')

  <div class="modal fade" id="forgot_password" tabindex="-1" role="dialog" aria-labelledby="forgot_password_label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" id="forgot_password_modal_content">
        @include('password.remind')
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
@stop

















