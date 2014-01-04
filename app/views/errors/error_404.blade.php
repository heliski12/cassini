@extends('layouts.error')

@section('content')
  <div class="container-full">

    <div class="row">
      <div class="col-md-12">
        <img src="{{ asset('/img/404.png') }}" class="error-icon" />
      </div>
      <div class="col-md-12 error-text">Click away from this internal error to go <a href="{{ URL::previous() }}">BACK</a> or to <a href="http://motionry.com">MOTIONRY.COM</a></div>
    </div>

  </div>
@stop

