@extends('layouts.create_profile')

@section('form')
<div class="row" id="profile-step-2">
  <div class="col-md-10 col-md-offset-1">
    <h5>Title of technology or research (can include a tagline)</h5>
    <div class="form-group">
      {{ Form::text('tech_title',Input::old('tech_title'), [ 'class' => 'form-control', 'id' => 'tech_title' ]) }}
    </div>
    <h5>Description of the technology or research (max 1550 characters with spaces)</h5>
    <div class="form-group">
      <textarea id="tech_description" name="tech_description" class="form-control" maxlength="1550" rows="10"></textarea>
      <div id="tech_description_charcount">
      </div>
    </div>
    <h5>Technology or research stage</h5>
    <div class="row">
      <div class="form-group">
        <div class="col-md-6">
          {{ Form::select('product_stage', array_merge(['' => 'Select stage...'], Config::get('cassini.product_stages')), null, [ 'class' => 'selectpicker form-control' ] ) }} 
        </div>
      </div>
    </div>
    <h5>Intellectual property</h5>
    <div class="row">
      <div class="form-group">
        <div class="col-md-6">
          {{ Form::select('intellectual_propery', Config::get('cassini.product_stages'), null, [ 'class' => 'selectpicker form-control', 'multiple' => 'multiple', 'title' => 'Select all that apply...' ] ) }} 
        </div>
      </div>
    </div>
    <div class="row">
      <hr/>
    </div>
    <h5>Market regions</h5>
    <div class="row">
      <div class="form-group">
        <div class="col-md-6">
          {{ Form::select('regions', SelectHelper::get_region_options(), null, [ 'class' => 'selectpicker form-control', 'multiple' => 'multiple', 'title' => 'Select all that apply...' ] ) }} 
        </div>
      </div>
    </div>
  </div>
</div>
@stop
