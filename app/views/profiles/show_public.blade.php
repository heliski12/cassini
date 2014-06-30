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

<body>

<div id="wrapper">
    <header>
    <a href="{{ URL::to('/') }}"><img alt="Motionry Logo" id="logo" src="{{ asset('img/Black-Motionry-Logo.png') }}"/></a>
    <div id="buttons">
    <a class="button-wrap" href="{{ URL::to('/#s') }}"><button id="join1" >Join Motionry</button></a>
    <a class="button-wrap" href="{{ URL::to('/sign-in') }}"><button id="sign_in" >Sign In</button></a>
    </div>
    </header>

    <div id="content" class="group">

    <div id="column_right">
    <h1 id="h2_mobile">{{{ $profile->public_tagline_or_tech_title }}}</h1>
    <h3>{{{ $profile->organization_or_institution_name }}}</h3>
    </div>
    <h2 id="h2_regular">{{{ $profile->public_tagline_or_tech_title }}}</h2>

    {{ HTML::image($profile->public_image_url, $profile->public_image_description, [ 'class' => '', 'id' => 'field' ]) }}
    <div id="text">
        <h3>{{{ $profile->organization_or_institution_name }}}</h3>
        <p><strong>Markets:</strong> {{{ $profile->sectors_tos }}}</p>
        <p><strong>Strategic Opportunities:</strong> {{{ $profile->fs_extra_info ?: "None specified." }}}</p>
        @foreach ($profile->applications as $application)
            <div class="industry">{{{ $application->name }}}</div>
        @endforeach
    </div>
    <a class="button-wrap" href="{{ route('show_profile', [ $profile->id ]) }}"><button id="view_profile">View complete profile</button></a>
    </div>

    <aside>
        <p>Discover and connect with the world's leading researchers and entrepreneurs in energy, agriculture and materials related technologies.</p> 
        <p><a class="button-wrap" href="{{ URL::to('/#s2') }}"><button id="join2">Join now for free</button></a></p>
        
    </aside>
</div><!--end #wrapper -->

<footer> Motionry (c) {{ date('Y') }} </footer>

</body>
</html>

