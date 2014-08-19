<!DOCTYPE html>
<html>
<head>
    <title>Motionry Innovator: {{{ $profile->tech_title }}}</title>

    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('css/custom.css?'. Config::get('cassini.asset_version')) }}
    {{ HTML::style('css/public-profile.css?' . Config::get('cassini.asset_version')) }}
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

    <meta property="og:image" content="{{{ $profile->public_image_url }}}">
    <meta property="og:site_name" content="Motionry Marketplace" >
    <meta property="og:type" content="website" >
    <meta property="og:url" content="{{ URL::current() }}" >
    <meta name="twitter:card" content="summary" >
    <meta name="twitter:domain" content="www.motionry.com" >
    <meta name="twitter:site" content="@Motionry" >
    <meta name="twitter:site:id" content="784612502">
    <meta name="twitter:creator" content="@Motionry" >
    <meta name="description" content="{{{ $profile->public_description ?: 'Motionry is changing the way people connect to innovate.  We offer the only platform that connects the world\'s technologists, researchers and entrepreneurs developing sustainable technologies.' }}}">
    <meta property="og:title" content="Motionry Marketplace">
    <meta property="og:description" content="{{{ $profile->public_description ?: 'Motionry is changing the way people connect to innovate.  We offer the only platform that connects the world\'s technologists, researchers and entrepreneurs developing sustainable technologies.' }}}">

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
            <ul class="nav nav-pills navbar-right">
              <li><a href="{{ URL::to('/#s') }}">Join Motionry</a></li>
              <li><a href="{{ URL::to('/sign-in') }}">Sign In</a></li>
                <li><a href="http://blog.motionry.com/">Blog</a></li>
                <li><a class="twitter" href="https://twitter.com/motionry">Twitter</a></li>
            </ul>
          </div><!--/.nav-wrap -->
      </nav>
    </header>

    
    <div class="container group wrap">

      


      <div class="col-md-8 wrap">


          <h3 class="col-xs-12 pitch">{{{ $profile->public_tagline_or_tech_title }}}</h3>


      <div class="col-lg-6">
       
          {{ HTML::image($profile->public_image_url, $profile->public_image_description, [ 'class' => '', 'id' => 'company_img', 'width' => '100%' ]) }}
        
      </div>



      <div class="col-lg-6">
          <h3 id="company">{{{ $profile->organization_or_institution_name }}}</h3>
          <p><a class="btn btn-xs btn-primary btn-profile" href="{{ route('show_profile', [ $profile->id ]) }}" role="button">View Full Profile</a></p>
    
      <p><strong>Technology Overview:</strong> {{{ $profile->public_description ?: "None specified." }}}</p>
      <p><strong>Markets & Applications:</strong> {{{ $profile->sectors_tos }}}</p>
        @foreach ($profile->applications as $application)
            <div class="industry">{{{ $application->name }}}</div>
        @endforeach
      </div>

    </div>

    <aside class="col-md-3 col-md-offset-1">
          <h4>Technology Transfer, Rebooted</h4>
          <p>Discover and connect with the world&#039;s leading researchers, entrepreneurs and companies in energy, agriculture and material related technologies.</p> 
          <a class="btn btn-sm btn-sign-up" href="{{ URL::to('/#s2') }}" role="button">Join Now for Free</a>
      </aside>

      

    </div> <!-- /container -->

    <footer>
        <p>&copy; {{ date('Y') }} Motionry. All rights reserved.</p>
      <footer>

</body>
</html>

