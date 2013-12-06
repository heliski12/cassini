@extends('layouts.create_profile')

@section('form')
<div class="row">
  <div class="col-md-10 col-md-offset-1">
    <h5>What type of Innovator are you?</h5>
    <div class="radio col-md-10 col-md-offset-2">
      <label>
        <input type="radio" name="innovator_type" id="researcher" value="researcher" >
        Researcher
      </label>
    </div>
    <div class="radio col-md-10 col-md-offset-2">
      <label>
        <input type="radio" name="innovator_type" id="entrepreneur" value="entrepreneur" >
        Entrepreneur
      </label>
    </div>
    <div class="row">
      <hr/>
    </div>

    <h5><a data-toggle="collapse" data-parent"#accordion" href="#collapse_kp1" class="icon">Key Researcher or Entrepreneur&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-chevron-up"></span></a></h5>

    <div class="panel-group" id="kp1_accordion">
      <div class="panel panel-default">
        <div id="collapse_kp1" class="panel-collapse collapse in">
          <div class="panel-body">
            @include('partials.keyperson_form')
          </div>
        </div>
      </div>
    </div>


  </div>
</div>
@stop
