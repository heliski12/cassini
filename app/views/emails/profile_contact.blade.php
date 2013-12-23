A Motionry user has written about a profile.<br/><br/>
User: {{ $user->full_name }} ({{ $user->email }})<br/>
Profile: {{ $profile->tech_title }} ({{ $profile->id }})<br/><br/>
Message:<br/><br/>
{{ nl2br($user_message) }}
