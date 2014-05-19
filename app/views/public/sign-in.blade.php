<!DOCTYPE html>
<html lang="en">
  <head>
    <title>
      @section('title')
        Motionry: Connecting the World's Researchers and Tech Entrepreneurs
      @show
    </title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="SHORTCUT ICON" HREF="favicon.png?3">

    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('css/fonts.css') }}
    {{ HTML::style('css/landing.css?3') }}
    
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

    <meta property="og:image" content="{{ URL::to('/img/Black-Motionry-Logo.png') }}">
    <meta property="og:site_name" content="Motionry Marketplace" >
    <meta property="og:type" content="website" >
    <meta property="og:url" content="{{ URL::current() }}" >
    <meta name="twitter:card" content="summary" >
    <meta name="twitter:domain" content="www.motionry.com" >
    <meta name="twitter:site" content="@Motionry" >
    <meta name="twitter:site:id" content="784612502">
    <meta name="twitter:creator" content="@Motionry" >
    <meta name="description" content="Motionry is changing the way people connect to innovate.  We offer the only platform that connects the world's technologists, researchers and entrepreneurs developing sustainable technologies.">
    <meta property="og:title" content="Motionry Marketplace">
    <meta property="og:description" content="Motionry is changing the way people connect to innovate.  We offer the only platform that connects the world's technologists, researchers and entrepreneurs developing sustainable technologies.">
    
    

    @if (app()->env == 'production')
    <script type="text/javascript">
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-34438676-1']);
      _gaq.push(['_setDomainName', 'motionry.com']);
      _gaq.push(['_trackPageview']);

      (function() {
       var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
       ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';
       var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
       })();

     </script>
    @endif

      <script type="text/javascript">
        var BASE_URL = "{{ URL::to('/') }}";
      </script>
    
  </head>
  <body class="sign-in">

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
                      <span class="login-msg">SIGN IN</span> 
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

<div class="modal fade" id="forgot_password" tabindex="-1" role="dialog" aria-labelledby="forgot_password_label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="forgot_password_modal_content">
      @include('password.remind')
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

    {{ HTML::script('//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js') }}
    {{ HTML::script('//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js') }}
    {{ HTML::script('js/bootstrap.min.js') }}
    {{ HTML::script('js/public.js?1') }}
  </body>
</html>
















