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
    {{ HTML::style('css/landing.css?2') }}
    
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
  <body>

  <div class="main">
    <div class="section" id="motionry">
      <div class="wrap">
              <div class="container">
                <div class="row">
                  <div class="col-lg-4 col-md-5 col-sm-6 col-xs-8">
                    <a href="http://www.motionry.com"><img alt="Motionry Logo" class="logo img-responsive" src="{{ asset('img/White-Motionry-Logo.png') }}"/></a>
                  </div>
                  <div class="col-lg-5 col-lg-offset-3 col-md-6 col-md-offset-1 hidden-sm hidden-xs navlinks">
                    <ul>
                      <li><a href="https://twitter.com/Motionry" class="twitter-follow-button" data-show-count="false" data-lang="en">Follow @Motionry</a>
                     <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script> 
                      </li>
                      <li><a href="http://blog.motionry.com">Blog</a></li>
                      <li><a href="{{{ asset('/Motionry Terms of Service and Privacy Policy.pdf') }}}" target="_blank">Terms</a></li>
                      <li><a href="#" data-toggle='modal' data-target="#contact">Contact</a></li>
                    </ul>
                  </div>
                  <div class="col-sm-4 col-xs-4 visible-xs visible-sm mini-nav">
                    <div class="dropdown pull-right">
                      <button type="button" class="dropdown-toggle btn" data-toggle="dropdown" id="dropdown1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="glyphicon glyphicon-th-list"></span>
                      </button>
                      <ul class="dropdown-menu" role="menu" aria-labelledby="dropdown1">
                        <li><a href="https://twitter.com/Motionry" class="twitter-follow-button" data-show-count="false" data-lang="en">Follow @Motionry</a>
                       <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script> 
                        </li>
                        <li><a href="http://blog.motionry.com">Blog</a></li>
                        <li><a href="{{{ asset('/Motionry Terms of Service and Privacy Policy.pdf') }}}" target="_blank">Terms</a></li>
                        <li><a href="#" data-toggle='modal' data-target="#contact">Contact</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
                @if (Session::has('message'))
                  <div class="row" style="margin-top:10px;">
                    <div class="col-md-6 col-md-offset-3">
                      <div class="alert alert-success">{{{ Session::get('message') }}}</div> 
                    </div> 
                  </div>
                @endif
                <div class="row title-login hidden-sm hidden-xs">
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
                      <a class="forgot" href="#" data-toggle='modal' data-target="#forgot_password">Forgot password?</a>
                      
                      {{ Form::button('SIGN IN', [ 'class' => 'btn btn-primary', 'type' => 'submit' ]) }}
                      
                      {{ Form::close() }}
                    </div>
                  </div> 
                </div>
                <div class="row title-login-mini visible-sm visible-xs">
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
                      <a class="forgot" href="#" data-toggle='modal' data-target="#forgot_password">Forgot password?</a>
                      
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
              <div class="col-md-10 col-md-offset-1">
                <h2 class="hidden-sm hidden-xs">Simplify how you discover<br/>and collaborate with people around the world</h2>
                <h2 class="visible-sm visible-xs">Simplify how you discover<br/>and collaborate with people around the world</h2>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <img class="img-responsive hidden-sm hidden-xs" src="{{ asset('/img/page2bg.png') }}" />
                <img class="img-responsive visible-xs" src="{{ asset('/img/page2mbg.png') }}" />
                <img class="img-responsive visible-sm" src="{{ asset('/img/page2mbg.png') }}" />
              </div>
            </div>
            <div class="row arrow-down">
                <span class="scroll-down">Scroll&nbsp;Down</span><br/>
                <a href="#" id="scroll_down">
                  <span class="glyphicon glyphicon-chevron-down arrow2"></span>
                </a>
            </div>
          </div>
        </div>
    </div>
    <div class="section" id="page3">
      <div class="wrap">
        <div class="container">
          <div class="row">
            <div class="col-md-10 col-md-offset-1 our-story">
              <h2 class="hidden-sm hidden-xs">Our Story</h2> 
              <h2 class="visible-sm">Our Story</h2> 
              <h2 class="visible-xs">Our Story</h2> 
            </div>
          </div>
          <div class="row">
            <div class="col-md-10 col-md-offset-1 hidden-xs hidden-sm our-story-desc">
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
            <div class="col-md-10 col-md-offset-1 visible-xs our-story-desc">
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
            <div class="col-md-10 col-md-offset-1 visible-sm our-story-desc">
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
                <ul class="bottom-nav hidden-sm hidden-xs">
                  <li><a href="http://blog.motionry.com">Blog</a></li>
                  <li><a href="{{{ asset('/Motionry Terms of Service and Privacy Policy.pdf') }}}" target="_blank">Terms</a></li>
                  <li><a href="#" data-toggle="modal" data-target="#contact">Contact</a></li>
                </ul>
                <ul class="bottom-nav visible-sm visible-xs">
                  <li><a href="http://blog.motionry.com">Blog</a></li>
                  <li><a href="{{{ asset('/Motionry Terms of Service and Privacy Policy.pdf') }}}" target="_blank">Terms</a></li>
                  <li><a href="#" data-toggle="modal" data-target="#contact">Contact</a></li>
                </ul>
              </div>
              <div class="row copy">
                &copy;{{{ date('Y') }}} Motionry.  All Rights Reserved. 
              </div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-6">
              <ul class="social hidden-sm hidden-xs">
                <li><a href="https://twitter.com/Motionry"><img src="{{ asset('/img/twitter.png') }}"/></a></li>
                <li><a href="https://www.facebook.com/pages/Motionry/520892087928302"><img src="{{ asset('/img/facebook.png') }}"/></a></li>
              </ul>
              <ul class="social visible-sm visible-xs">
                <li><a href="https://twitter.com/Motionry"><img src="{{ asset('/img/twitter.png') }}"/></a></li>
                <li><a href="https://www.facebook.com/pages/Motionry/520892087928302"><img src="{{ asset('/img/facebook.png') }}"/></a></li>
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

<div class="modal fade" id="forgot_password" tabindex="-1" role="dialog" aria-labelledby="forgot_password_label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="forgot_password_modal_content">
      @include('password.remind')
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="contact" tabindex="-1" role="dialog" aria-labelledby="email_label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="email_modal_content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="email_label">Contact Motionry</h4>
      </div>
      {{ Form::open([ 'url' => route('pcontact'), 'id' => 'email_form', 'role' => 'form' ]) }}
      <div class="modal-body email">
        This message will be sent to Motionry.  How can we help you?
        <br/><br/>
        Your name: <input name="name" class="form-control" type="text"></input><br/>
        Your email: <input name="email" class="form-control" type="email"></input><br/>
        <textarea id="message" name="message" class="form-control" rows="10"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Send Message</button>
      </div>
      {{ Form::close() }}
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
