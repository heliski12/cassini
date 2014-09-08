<!DOCTYPE html>
<html lang="en">
  <head>
    <title>
      @section('title')
        Motionry: Connecting the World's Researchers and Tech Entrepreneurs
      @show
    </title>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Motionry is changing the way people connect to innovate.  We offer the only platform that connects the world's technologists, researchers and entrepreneurs developing sustainable technologies.">
    <meta name="author" content="Motionry">

    <link rel="SHORTCUT ICON" HREF="{{ URL::to('/favicon.png?' . Config::get('cassini.asset_version')) }}">

    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('css/custom.css?'. Config::get('cassini.asset_version')) }}
    {{ HTML::style('css/public-profile.css?'. Config::get('cassini.asset_version')) }}
    {{ HTML::style('css/profile.css?'. Config::get('cassini.asset_version')) }}

    @yield('css')
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

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

      @yield('js-head')
    
  </head>

  <body>

    <header>
      <nav class="navbar navbar-default" role="navigation">
          <div class="navbar-header">
            <a href="{{ URL::to('/') }}">
              <img alt="Motionry Logo" class="logo" src="{{ asset('img/Black-Motionry-Logo.png') }}">
            </a>
          </div><!--/.navbar-header-->
          <div class="nav-wrap">
            <div id="user">{{ Auth::user()->email }}</div>
            <ul class="nav nav-pills navbar-right">
              @if (Auth::user()->is_admin)
                <li><a href="{{ URL::to('/admin') }}">[admin]</a></li>
              @endif
              <li><a href="{{ URL::to('/logout') }}">Log Out</a></li>
              <li><a href="{{ URL::to('/my-account') }}">My Account</a>
              <li><a href="{{ URL::to('/saved-profiles') }}">Saved Profiles</a></li>
              <li><a href="{{ URL::to('/innovators') }}">Browse Innovators</a></li>
            </ul>
          </div><!--/.nav-wrap -->
      </nav>
    </header>

    <hr class="horizontal-one">
    
    <div class="container">
      @yield('content')
    </div>

    <footer>
        <p>&copy; {{ date('Y') }} Motionry. All rights reserved.</p>
    </footer>

    @yield('modal')

    {{ HTML::script('//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js') }}
    {{ HTML::script('js/jQuery.BlackAndWhite.js') }}
    {{ HTML::script('js/bootstrap.min.js') }}

    @yield('js-lib')

    {{ HTML::script('js/initializer.js?'.  Config::get('cassini.asset_version')) }}
    {{ HTML::script('js/marketplace.js?' . Config::get('cassini.asset_version')) }}

    @yield('js-user')

  </body>
</html>

