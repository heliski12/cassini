@extends('layouts.create_profile')

@section('form')

              <div class="top-buffer" id="profile-step-2">

                <div class="form-group">
                  <label for="">Title of technology or research (can include a tagline)&nbsp;&nbsp;<span class="asterisk">*</span></label>
                  {{ Form::text('tech_title',$profile->tech_title, [ 'class' => 'form-control', 'id' => 'tech_title' ]) }}
                </div>

                <div class="form-group">  
                  <label for="">Description of the technology or research (max 1550 characters with spaces)&nbsp;&nbsp;<span class="asterisk">* (only the first 165 characters)</span></label>
                  <textarea id="tech_description" name="tech_description" class="form-control" maxlength="1550" rows="10">{{{ $profile->tech_description }}}</textarea>
                  <div id="tech_description_charcount">
                  </div>
                </div>

               <div class="col-md-4">
                  <div class="form-group">
                   <label for="" class="margin-fix">Technology or research stage</label>
                  {{ Form::select('product_stage', array_merge(['' => 'Select stage...'], Config::get('cassini.product_stages')), $profile->product_stage, [ 'class' => 'selectpicker form-control' ] ) }} 
                 </div>
               </div>

               <div class="col-md-4">
                <div class="form-group">
                  <label for="" class="margin-fix">Intellectual property</label>
                  {{ Form::select('intellectual_property[]', Config::get('cassini.intellectual_property_types'), $profile->intellectualProperty, [ 'class' => 'selectpicker form-control', 'multiple' => 'multiple', 'title' => 'Select all that apply...' ] ) }} 
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="" class="margin-fix">Market regions</label>
                  <select class="selectpicker form-control" multiple="multiple" title="Select all that apply..." name="region_ids[]"><option value="4">Africa</option><option value="9">Asia</option><option value="5">Australia</option><option value="8">China</option><option value="2">Europe</option><option value="3">India</option><option value="6">Latin America</option><option value="7">Middle East</option><option value="1">North America</option></select> 
                </div>
              </div>


              <div class="form-group">
                <label for="">What are the market applications?  For instance, a nanotechnology may be applicable to solar panels, HVAC, and green building materials.  Click on enter or return key after each entry to separate.&nbsp;&nbsp;<span class="asterisk">*</span></label>
                <ul id="market_applications">
                  @foreach ($profile->applications as $application)
                    <li>{{ $application->name }}</li>
                  @endforeach
                </ul>
              </div>

              <div class="col-md-6">  
                <div class="form-group">
                  <label for="" class="margin-fix">Market sector&nbsp;&nbsp;<span class="asterisk">*</span></label>
                  {{ Form::select('sector_ids[]', SelectHelper::get_sector_options(), $profile->sectorIds, [ 'class' => 'selectpicker form-control', 'multiple' => 'multiple', 'title' => 'Select all that apply...' ] ) }} 
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group"> 
                  <label for="" class="margin-fix">Funding status</label>
                  {{ Form::select('funding_statuses[]', Config::get('cassini.funding_statuses'), $profile->fundingStatuses, [ 'class' => 'selectpicker form-control', 'multiple' => 'multiple', 'title' => 'Select all that apply...' ] ) }} 
                </div>
              </div>

              <hr />

              <div class="form-group">

              <div class="form-group">
                <p class="help-block"><a href="#" class="add-fs-additional">Add additional info</a></p>
              </div>
                
              <label class="fs-additional" style="display:none;">If you are currently funded, provide the name of the funding organization OR if you are seeking funding, what you intend to do with the funding.  Also, provide your strategic needs such as market pilot partnerships. This information will appear in your published profile.</label>
              <div class="form-group fs-additional" style="display:none;">
                <textarea id="fs_extra_info" name="fs_extra_info" class="form-control" maxlength="1550" rows="10">{{ $profile->fs_extra_info }}</textarea>
              </div>
              <div class="row">
                <hr/>
              </div>
              <h5>Upload photo of the technology or research (max 4 photos)</h5>
              <div id="photos_list">
                @foreach (range(0,3) as $idx)
                  @if (sizeof($profile->photos) > $idx)
                    @include('partials.photo_form', [ 'photo' => $profile->photos[$idx], 'idx' => $idx, 'label' => $idx + 1 ])
                  @else
                    @include('partials.photo_form', [ 'photo' => new Photo, 'idx' => $idx, 'label' => $idx + 1 ])
                  @endif
                @endforeach
              </div>

                    </div>

                </div> <!-- top buffer -->

@stop
