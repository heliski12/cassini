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
    {{ HTML::style('css/global.css?3') }}

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
    @section('wrap_open')
      <div class="wrap">
    @show

      <div class="container-full header">
        <div class="row">
          <div class="col-md-2">
            <a href="http://www.motionry.com"><img alt="Motionry Logo" src="{{ asset('img/Black-Motionry-Logo.png') }}"/></a>
          </div>
          <div class="col-md-5 col-md-offset-2 nav">
            <a href="{{ URL::to('/innovators') }}">Browse Innovators</a>
            <a href="{{ URL::to('/saved-profiles') }}">Saved Profiles</a>
            <a href="{{ URL::to('/my-account') }}">My Account</a>
          </div>
          <div class="col-md-2 col-md-offset-1 user-nav">
            <h5>{{ Auth::user()->email }}</h5>
            <h5>
              @if (Auth::user()->is_admin)
                <a href="{{ URL::to('/admin') }}">[admin]</a>&nbsp;&nbsp;
              @endif
              <a href="{{ URL::to('/logout') }}">Log Out</a>
            </h5>
          </div>
        </div>
      </div>

      @yield('content')

    </div>

    @yield('modal')

    {{ HTML::script('//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js') }}
    {{ HTML::script('js/bootstrap.min.js') }}

    @yield('js-lib')

    {{ HTML::script('js/marketplace.js?2') }}

    @yield('js-user')

  </body>
</html>
