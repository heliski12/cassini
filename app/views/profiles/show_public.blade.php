<!DOCTYPE html>
<html>
<head>
    <title>Motionry Innovator: {{{ $profile->tech_title }}}</title>

    {{ HTML::style('css/profile.css?' . Config::get('cassini.asset_version')) }}
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

<div id="wrapper">
    <header>
    <a href="{{ URL::to('/') }}"><img alt="Motionry Logo" id="logo" src="{{ asset('img/Black-Motionry-Logo.png') }}"/></a>
    <div id="nav_buttons">
    <a href="{{ URL::to('/#s') }}"><button id="join_1" >Join Motionry</button></a>
    <a href="{{ URL::to('/sign-in') }}"><button id="sign_in" >Sign In</button></a>
    </div>
    </header>

    <div id="content" class="group">

    <h1 class="tagline">{{{ $profile->public_tagline_or_tech_title }}}</h1>

    <div id="column_1">
        {{ HTML::image($profile->public_image_url, $profile->public_image_description, [ 'class' => '', 'id' => 'company_img' ]) }}
        <a href="{{ route('show_profile', [ $profile->id ]) }}"><button id="view_profile">View complete profile</button></a>
    </div><!--end #column_1-->

    <div id="column_2">
        <h3 id="company">{{{ $profile->organization_or_institution_name }}}</h3>
    
        <p><strong>Technology Overview:</strong> {{{ $profile->public_description ?: "None specified." }}}</p>
        <p><strong>Markets & Applications:</strong> {{{ $profile->sectors_tos }}}</p>
        @foreach ($profile->applications as $application)
            <div class="industry">{{{ $application->name }}}</div>
        @endforeach
    </div>


    </div>

    <aside>
        <p>Discover and connect with the world’s leading researchers, entrepreneurs and companies in energy, agriculture and materials related technologies.</p> 
        <a href="{{ URL::to('/#s2') }}"><button id="join_2">Join now for free</button></a>
    </aside>
</div><!--end #wrapper -->

<footer> Motionry &copy; {{ date('Y') }} </footer>

</body>
</html>

