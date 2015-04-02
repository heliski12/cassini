@extends('layouts.public')

@section('content')

    <div class="top-container">

      <nav class="navbar navbar-default" role="navigation">
        <div class="nav-container">
          <div class="navbar-header">
            <a href="{{ URL::to('/') }}">
              <img alt="Motionry Logo" class="logo" src="{{URL::to('img/Black-Motionry-Logo.png')}}">
            </a>
          </div>
          <div class="nav-wrap">
            <ul class="nav nav-pills navbar-right">
                @if (Session::has('message'))
                  <li class="alert alert-success">{{{ Session::get('message') }}}</li>
                @endif
              <li><a href="{{ URL::to('/sign-in') }}">Sign In</a></li>
                <li><a href="http://blog.motionry.com/">Blog</a></li>
                <li><a href="#" data-toggle="modal" data-target="#contact">Contact</a></li>
                <li><a class="twitter" href="https://twitter.com/motionry">Twitter</a></li>
            </ul>
          </div><!-- /.nav-wrap -->
        </div><!-- /.nav-container -->
      </nav>

          <div class="jumbotron">
            <h1>Technology Transfer, Rebooted</h1>
            <p class="lead">We give innovators everywhere the power to connect, from an agtech startup in Silicon Valley to an energy researcher in Australia. Motionry is a community of startups, researchers and companies streamlining how to discover and develop partnerships.</p>
            <p>Get early access and help build something awesome.</p>
            <p><a class="btn btn-lg btn-sign-up" href="#" data-toggle="modal" data-target="#user_signup" role="button">Get Started</a></p>
          </div>
      </div><!-- /.top-container -->

      <div class="container">

          <div class="row brands">
             <h2>Meet some of our innovators:</h2>


            <div class="col-sm-4 brand-column">
              <a href="{{ URL::to('/innovators/219-peer-to-peer-electricity-network-for-those-who-lack-access-in-rural-areas') }}" class="bwWrapper">
                <img src="{{URL::to('img/ulink.jpg')}}" width="100%">
              </a>
              <a href="{{ URL::to('/innovators/233-valentis-nanotech-highly-improved-polymeric-films') }}" class="bwWrapper">
               <img src="{{URL::to('img/valentis.jpg')}}" width="100%">
              </a>
              <a href="http://www.bluerivert.com" class="bwWrapper">
               <img src="{{URL::to('img/blue-river.jpg')}}" width="100%">
              </a>
            </div>

              <div class="col-sm-4 brand-column">
              <a href="{{ URL::to('/innovators/241-enterprise-platform-for-global-agriculture') }}" class="bwWrapper">
               <img src="{{URL::to('img/agsquared.jpg')}}" width="100%">
              </a>
              <a href="{{ URL::to('/innovators/305-smart-grid-outage-management-load-management-technical-and-non-technical-remediation-medium-voltage-sensoring') }}" class="bwWrapper">
               <img src="{{URL::to('img/dtechs.jpg')}}" width="100%">
              </a>
              <a href="{{ URL::to('/innovators/253-farmia-livestock-exchange-made-easy') }}" class="bwWrapper">
               <img src="{{URL::to('img/farmia.jpg')}}" width="100%">
              </a>
            </div>

            <div class="col-sm-4 brand-column">
              <a href="{{ URL::to('/innovators/84-self-assembly-of-proteinpolymer-nanostructures') }}" class="bwWrapper">
               <img src="{{URL::to('img/MIT.jpg')}}" width="100%">
              </a>
              <a href="{{ URL::to('/innovators/223-strider-precision-agricultural-platform-for-smart-pest-control') }}" class="bwWrapper">
               <img src="{{URL::to('img/strider.jpg')}}" width="100%">
              </a>
              <a href="{{ URL::to('/innovators/247-pond-biofuels-industrial-algae-production-facility') }}" class="bwWrapper">
               <img src="{{URL::to('img/pond-biofuels.jpg')}}" width="100%">
              </a>
            </div>

          </div>

          <div class="footer">
            <p>&copy; {{ date('Y') }} Motionry. All rights reserved.</p>
          </div>

        </div> <!-- /container -->
@stop

@section('modal')
  @include('partials.signup_wrap')

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
		  <span class="{{ $errors->has('name') ? 'alert-danger' : '' }}">Your name: {{ $errors->has('name') ? $errors->first('name') : '' }}</span> <input name="name" class="form-control" type="text" value="{{ Input::old('name') }}"></input><br/>
		  <span class="{{ $errors->has('email') ? 'alert-danger' : '' }}">Your email: {{ $errors->has('email') ? $errors->first('email') : '' }}</span> <input name="email" class="form-control" type="email" value="{{ Input::old('email') }}"></input><br/>
		  <span class="{{ $errors->has('message') ? 'alert-danger' : '' }}">Your message: {{ $errors->has('message') ? $errors->first('message') : '' }}</span> <textarea id="message" name="message" class="form-control" rows="10" >{{ Input::old('message') }}</textarea><br/>
		  <span class="{{ $errors->has('challenge') ? 'alert-danger' : '' }}">What is {{{ $challenge }}}? {{ $errors->has('challenge') ? $errors->first('challenge') : '' }}</span> <input type="text" name="challenge" class="form-control" ></input>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Send Message</button>
        </div>
        {{ Form::close() }}
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
@stop

@section('js')
<script type="text/javascript">
	$(function() {
		var contact = {{ $errors->isEmpty() ? 'false' : 'true' }};
		if (contact) {
			$("#contact").modal();
		}
	});
</script>
@stop
