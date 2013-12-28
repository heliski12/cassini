A Motionry user has written about one or more profiles from his or her saved profile page.<br/><br/>
User: {{ $user->full_name }} ({{ $user->email }})<br/>
Profiles: <br/><br/>
@foreach($profiles as $profile)
  {{ $profile->id }}: {{ $profile->tech_title }}<br/><br/>
@endforeach

Message:<br/><br/>
{{ nl2br($user_message) }}
