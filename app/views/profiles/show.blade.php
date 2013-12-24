@extends('layouts.private')

@section('content')

<div class="container-full">
  @if (Session::has('message'))
    <div class="row message">
      <div class="col-md-10 col-md-offset-1">
        <div class="alert alert-success">{{ Session::get('message') }}</div>
      </div>
    </div>
  @endif
  <div class="row profile-wrap">
      <div class="row profile-top">
        <div class="col-md-2 profile-inst">
          @if ($profile->innovator_type === 'RESEARCHER')
            <div class="profile-logo">
              @if (!empty($profile->institution->photo))
                &nbsp;
              @else
                <img src="{{ URL::to('/img/university-avatar.png') }}"/>
              @endif
            </div>
            <div class="profile-inst-det">
              @if (!empty($profile->institution))
                {{ $profile->institution->name }}<br/>
                {{ $profile->institution->address }}
              @endif
            </div>
          @else
            <div class="profile-logo">
              @if (!empty($profile->entrepreneur_photo))
                &nbsp;
              @else
                <img src="{{ URL::to('/img/company-avatar.png') }}"/>
              @endif
            </div>
            <div class="profile-inst-det">
              {{ $profile->organization }}<br/>
              @if (!empty($profile->keypersons) and sizeof($profile->keypersons) > 0)
                {{ $profile->keypersons[0]->cityStateCountry }}
              @endif
            </div>
          @endif
        </div>
        <div class="col-md-7 profile-top-cell">
          <div class="tech-title">
            {{ $profile->tech_title }}
          </div>
          <div class="market-sectors">
            @foreach ($profile->sectors as $sector)
            <span class="label label-primary sector-pill">{{ $sector->name }}</span>
            @endforeach
          </div>
        </div>
        <div class="col-md-3">
          <button class="btn btn-warning btn-first col-md-12" data-toggle="modal" data-target="#contact">Contact Motionry about this Profile</button>
          {{ Form::open([ 'url' => route('save_profile'), 'id' => 'contact_form', 'role' => 'form' ]) }}
          {{ Form::hidden('profile_id', $profile->id) }}
          @if ($profile->subscribers->contains(Auth::user()->id))
            <button class="btn btn-warning btn-last disabled col-md-12" type="submit">Profile Saved</button>
          @else
            <button class="btn btn-warning btn-last col-md-12" type="submit">Save Profile</button>
          @endif
          {{ Form::close() }}
        
        </div>
      </div>
      <div class="row profile-body">
        <div class="row">
          <div class="col-md-7">
            <div class="row profile-body-cell">1</div> 
            <div class="row profile-body-cell">2</div> 
            <div class="row profile-body-cell">3</div> 
          </div>
          <div class="col-md-5">
            <div class="row profile-body-cell">
              <div class="profile-h">Key People</div>
              @foreach ($profile->keypersons as $keyperson)
                <div class="row profile-kp">
                  <div class="col-md-4">
                    <img src="{{ URL::to('/img/blank-avatar.jpg') }}"/> 
                  </div>
                  <div class="col-md-8 profile-kp-info">
                    <span class="profile-kp-name">
                      {{ $keyperson->full_name }}
                    </span><br/>
                    <span class="profile-kp-title">
                      {{ $keyperson->title }}  
                    </span>
                  </div>
                </div>
              @endforeach
            </div> 
            <div class="row profile-body-cell">
              <div class="profile-h">Funding</div>
            
            </div> 
          </div>
        </div>
        <div class="row profile-tabs">
          <div class="col-md-12">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#website" data-toggle="tab">Website</a></li>
              <li><a href="#publications" data-toggle="tab">Publications</a></li>
              <li><a href="#presentations" data-toggle="tab">Presentations</a></li>
              <li><a href="#awards" data-toggle="tab">Awards</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane fade in active" id="website">The website</div>
              <div class="tab-pane fade" id="publications">The publications</div>
              <div class="tab-pane fade" id="presentations">The presentations</div>
              <div class="tab-pane fade" id="awards">The awards</div>
            </div>
          </div> 
        </div>
      </div>
  </div>

</div>

@stop

@section('modal')
<div class="modal fade" id="contact" tabindex="-1" role="dialog" aria-labelledby="contact_label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="contact_modal_content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="contact_label">Contact motionry about this profile</h4>
      </div>
      {{ Form::open([ 'url' => route('contact'), 'id' => 'contact_form', 'role' => 'form' ]) }}
      <div class="modal-body">
        This private message regarding '<strong>{{ $profile->tech_title }}</strong>' will be sent to Motionry admins.
        <br/><br/>
        <textarea id="message" name="message" class="form-control" rows="10"></textarea>
        {{ Form::hidden('profile_id', $profile->id) }}
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


