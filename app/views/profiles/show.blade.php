@extends('layouts.private')

@section('content')

<div class="container">
  <div class="row profile-wrap">
    <div class="col-md-10 col-md-offset-1">
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
          <button class="btn btn-warning btn-first">Contact Motionry about this Profile</button>
          <button class="btn btn-warning btn-last">Save Profile</button>
        
        </div>
      </div>
      <div class="row profile-body">
        <div class="row">
          <div class="col-md-8">
            <div class="row profile-body-cell">1</div> 
            <div class="row profile-body-cell">2</div> 
            <div class="row profile-body-cell">3</div> 
          </div>
          <div class="col-md-4">
            <div class="row profile-body-cell">a</div> 
            <div class="row profile-body-cell">b</div> 
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

</div>

@stop



