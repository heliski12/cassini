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
    {{ HTML::style('css/global.css') }}
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    @if (false and app()->env == 'production')
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
    @section('wrap_open')
      <div class="wrap">
    @show

      <div class="container-full header">
        <div class="row">
          <div class="col-md-2 col-sm-3">
            <a href="http://www.motionry.com"><img alt="Motionry Logo" src="{{ asset('img/motionry.jpg') }}"/></a>
          </div>
          <div class="col-md-2 col-md-offset-8 col-sm-3 col-sm-offset-6 user-nav">
            <h6>CHANGE <a href="#">EMAIL</a> OR <a href="#">PASSWORD</a></h6> 
            <h5>{{ Auth::user()->email }}</h5>
            <h5><a href="{{ URL::to('/logout') }}">Log Out</a></h5>
          </div>
        </div>
      </div>

      @yield('content')

    </div>

    @yield('modal')

    {{ HTML::script('//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js') }}
    {{ HTML::script('js/bootstrap.min.js') }}
    {{ HTML::script('js/marketplace.js') }}

    @yield('js')

  </body>
</html>
