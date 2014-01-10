A Motionry user has submitted profile.<br/><br/>
User: {{ $user->full_name }} ({{ $user->email }})<br/>
Profile: {{ $profile->id }}: {{ $profile->tech_title }}<br/><br/>

You may log into <a href="{{ URL::to('/admin') }}">admin</a> to review 
