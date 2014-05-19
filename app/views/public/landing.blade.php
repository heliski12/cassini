<!DOCTYPE html>
<html lang="en">
  <head>
    <title>
      @section('title')
        Motionry: Connecting the World's Researchers and Tech Entrepreneurs
      @show
    </title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="SHORTCUT ICON" HREF="favicon.png?4">

    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('css/fonts.css') }}
    {{ HTML::style('css/landing.css?4') }}
    
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

      <div class="wrap">
              <div class="container">
                <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
                    <a href="{{ URL::to('/') }}"><img alt="Motionry Logo" class="logo img-responsive" src="{{ asset('img/White-Motionry-Logo.png') }}"/></a>
                  </div>
                  <div class="col-lg-4 col-lg-offset-5 col-md-5 col-md-offset-3 hidden-sm hidden-xs navlinks">
                    <ul>
                      <li><a href="{{ route('sign-in') }}">Sign in</a></li>
                      <li><a href="http://blog.motionry.com">Blog</a></li>
                      <li><a href="#" data-toggle='modal' data-target="#contact">Contact</a></li>
                      <li><a target="_blank" href="https://twitter.com/motionry"><img src="{{ asset('img/twitter2.png') }}"/></a></li>
                    </ul>
                  </div>
                </div>
                <div class="row visible-sm visible-xs">
                  <div class="col-sm-12 col-xs-12 navlinks">
                    <ul>
                      <li><a href="{{ route('sign-in') }}">Sign in</a></li>
                      <li><a href="http://blog.motionry.com">Blog</a></li>
                      <li><a href="#" data-toggle='modal' data-target="#contact">Contact</a></li>
                      <li><a target="_blank" href="https://twitter.com/motionry"><img src="{{ asset('img/twitter2.png') }}"/></a></li>
                    </ul>
                  </div>
                </div>
                @if (Session::has('message'))
                  <div class="row" style="margin-top:10px;">
                    <div class="col-md-6 col-md-offset-3">
                      <div class="alert alert-success">{{{ Session::get('message') }}}</div> 
                    </div> 
                  </div>
                @endif
                <div class="row title-login visible-md visible-lg">
                    <h1>Discover and connect with the world's leading<br/>researchers and entrepreneurs.</h1>
                    <h2>Our platform fosters greater innovation and streamlined<br/>technology transfer, from basic R&D to early market demonstration.</h2>
                    {{ Form::button('GET STARTED', [ 'class' => 'btn btn-primary', 'data-toggle' => 'modal', 'data-target' => '#user_signup' ]) }}
                </div>
                <div class="row title-login visible-sm">
                    <h1>Discover and connect with the world's leading<br/>researchers and entrepreneurs.</h1>
                    <h2>Our platform fosters greater innovation and streamlined<br/>technology transfer, from basic R&D to early market demonstration.</h2>
                    {{ Form::button('GET STARTED', [ 'class' => 'btn btn-primary', 'data-toggle' => 'modal', 'data-target' => '#user_signup' ]) }}
                </div>
                <div class="row title-login visible-xs">
                    <h1>Discover and connect with the<br/>world's leading researchers<br/>and entrepreneurs.</h1>
                    <h2>Our platform fosters greater innovation and<br/>streamlined technology transfer, from basic<br/>R&D to early market demonstration.</h2>
                    {{ Form::button('GET STARTED', [ 'class' => 'btn btn-primary', 'data-toggle' => 'modal', 'data-target' => '#user_signup' ]) }}
                </div>
                <div class="row copy">
                    &copy; {{ date('Y') }} Motionry. All rights reserved.
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
        Your message: <textarea id="message" name="message" class="form-control" rows="10"></textarea>
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
    {{ HTML::script('js/public.js?1') }}
  </body>
</html>
