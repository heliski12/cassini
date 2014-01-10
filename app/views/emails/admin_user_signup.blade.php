A Motionry user has signed up for an account.<br/><br/>
User: {{ $user->full_name }} ({{ $user->email }})<br/>
Innovator: {{ $user->innovator ? "yes" : "no" }} <br/>
Seeker: {{ $user->seeker ? "yes" : "no" }} <br/>
Unsure: {{ $user->unsure ? "yes" : "no" }} <br/>

You may log into <a href="{{ URL::to('/admin') }}">admin</a> to review his or her information. 
