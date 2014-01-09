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
    {{ HTML::style('css/onepage-scroll.css') }}
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
  <body>

  <div class="main">
    <div class="section" id="motionry">
      <div class="wrap">
              <div class="container">
                <div class="row">
                  <div class="col-lg-4 col-md-5 col-sm-5 col-xs-12">
                    <a href="http://www.motionry.com"><img alt="Motionry Logo" class="logo img-responsive" src="{{ asset('img/White-Motionry-Logo.png') }}"/></a>
                  </div>
                  <div class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-3 col-sm-5 col-sm-offset-2 col-xs-12 navlinks">
                    <ul>
                      <li><a href="#">Blog</a></li>
                      <li><a href="{{{ asset('/Motionry Terms of Service and Privacy Policy.pdf') }}}" target="_blank">Terms</a></li>
                      <li><a href="#">Contact</a></li>
                    </ul>
                  </div>
                </div>
                <div class="row title-login">
                  <div class="col-md-7 col-md-offset-1">
                    <h1>Discover technologies that matter</h1> 
                  </div>
                  <div class="col-md-3">
                    <div class="signin">
                      <div class="login-or-signup">
                        <span class="login-msg">LOG IN</span> or 
                        {{ Form::button('SIGN UP', [ 'class' => 'btn btn-link', 'data-toggle' => 'modal', 'data-target' => '#user_signup' ]) }}
                      </div>
                      {{ Form::open([ 'url' => URL::to('/login'), 'id' => 'login_form' ]) }}
                      @if (Session::has('status'))
                        <div class="error-message">
                          {{ Session::get('status') }} 
                        </div>
                      @endif
                      {{ Form::text('email',null, [ 'placeholder' => 'Email address', 'class' => 'form-control' ]) }}
                      {{ Form::password('password', [ 'placeholder' => 'Password', 'class' => 'form-control' ]) }}
                      <a class="forgot" href="{{ action('RemindersController@getRemind') }}">Forgot password?</a>
                      
                      {{ Form::button('SIGN IN', [ 'class' => 'btn btn-primary', 'type' => 'submit' ]) }}
                      
                      {{ Form::close() }}
                    </div>
                  </div> 
                </div>
                <div class="row arrow-down">
                    <span class="scroll-down">Scroll&nbsp;Down</span><br/>
                    <a href="#" id="scroll_down">
                      <span class="glyphicon glyphicon-chevron-down"></span>
                    </a>
                </div>
              </div>
      </div> 
    </div>
    <div class="section" id="page2">
        <div class="wrap">
          <div class="container">
            <div class="row">
              <div class="col-md-8 col-md-offset-2">
                <h2>Simplify how you discover<br/>and collaborate with people around the world</h2>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <img class="img-responsive" src="{{ asset('/img/page2bg.png') }}" />
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="section" id="page3">
      <div class="wrap">
        <div class="container">
          <div class="row">
            <div class="col-md-10 col-md-offset-1 our-story">
              <h2>Our Story</h2> 
            </div>
          </div>
          <div class="row">
            <div class="col-md-10 col-md-offset-1 our-story-desc">
              <p>
                Imagine a platform that connects the world’s technologists and researchers.  
              </p>
              <p>
                That’s what Motionry has to offer.  We make it easy for you to explore solutions and find the right partner.  
              </p>
              <p>
                Our team of technology experts and engineers are empowering visionaries who look past limitations, imagine new possibilities and create better tomorrows. 
              </p>
              <p>
                What innovations will you discover?
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="footer">
        <div class="container">
          <div class="row">
            <div class="col-md-8 col-md-offset-1 col-sm-7 col-sm-offset-1 col-xs-6">
              <div class="row">
                <ul class="bottom-nav">
                  <li><a href="#">Blog</a></li>
                  <li><a href="{{{ asset('/Motionry Terms of Service and Privacy Policy.pdf') }}}" target="_blank">Terms</a></li>
                  <li><a href="#">Contact</a></li>
                </ul>
              </div>
              <div class="row copy">
                &copy;{{{ date('Y') }}} Motionry.  All Rights Reserved. 
              </div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-6">
              <ul class="social">
                <li><a href="#"><img src="{{ asset('/img/twitter.png') }}"/></a></li>
                <li><a href="#"><img src="{{ asset('/img/facebook.png') }}"/></a></li>
              </ul>
            </div>
          </div>
        
        </div>
      </div>
    
    </div>
  </div>

<div class="modal fade" id="user_signup" tabindex="-1" role="dialog" aria-labelledby="user_signup_label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="signup_modal_content">
      @include('partials.signup')
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

    {{ HTML::script('//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js') }}
    {{ HTML::script('//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js') }}
    {{ HTML::script('js/bootstrap.min.js') }}
    {{ HTML::script('js/jquery.onepage-scroll.min.js') }}
    {{ HTML::script('js/public.js?1') }}
  </body>
</html>
