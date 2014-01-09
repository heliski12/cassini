<!DOCTYPE html>
<html lang="en">
  <head>
    <title>
      @section('title')
      Motionry Marketplace
      @show
    </title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('css/fonts.css') }}
    {{ HTML::style('css/landing.css') }}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->

<!--[if IE]>
<script type="text/javascript">
var console = { log: function() {} };
</script>
<![endif]-->

@if (app()->env == 'production')
<script type="text/javascript">
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-44904108-1', 'marketplace.motionry.com');
ga('send', 'pageview');

</script>

@endif

<script type="text/javascript">
var BASE_URL = "{{ URL::to('/') }}";
</script>

  </head>
  <body class="password-reset">

      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-5 col-sm-5 col-xs-12">
            <a href="http://www.motionry.com"><img alt="Motionry Logo" class="logo img-responsive" src="{{ asset('img/Black-Motionry-Logo.png') }}"/></a>
          </div>
        </div>
        <div class="row">
          <div class="col-md-8 col-md-offset-2">
            <h2>Change password - minimum password length is 8 characters</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-8 col-md-offset-2">

            {{ Form::open( [ 'url' => action('RemindersController@postReset'), 'role' => 'form', 'id' => 'password_reset_form' ] ) }}
            {{ Form::hidden('token', $token) }}

            <div class="form-group {{ (Session::has('error') ? 'has-error' : '') }}">
              <label class="" for="email">Email address</label>
              @if (Session::has('error'))
              <label class="control-label" for="email">{{ Session::get('error') }}</label>
              @endif
              {{ Form::email('email', null, [ 'class' => 'form-control', 'placeholder' => 'Email address' ]) }}
            </div>
            <div class="form-group {{ (Session::has('error') ? 'has-error' : '') }}">
              <label class="" for="password">Password</label>
              {{ Form::password('password', [ 'class' => 'form-control', 'id' => 'password', 'placeholder' => 'Password' ]) }}
            </div>
            <div class="form-group {{ (Session::has('error') ? 'has-error' : '') }}">
              <label class="" for="password_confirmation">Repeat password</label>
              {{ Form::password('password_confirmation', [ 'class' => 'form-control', 'id' => 'password', 'placeholder' => 'Repeat password' ]) }}
            </div>
            {{ Form::button('Change password', [ 'class' => 'btn btn-primary password', 'type' => 'submit' ] ) }}
            {{ Form::close() }}
          </div>
        </div>
        <div class="row">
          <div class="col-md-8 col-md-offset-2">
            <a href="{{ URL::to('/') }}" class="btn btn-primary">Go back to Motionry to log in</a>  
          </div>
        </div>
      </div>
  </body>
</html>
