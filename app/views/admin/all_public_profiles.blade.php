@foreach ($profiles as $profile) 
{{ link_to_route('show_public_profile', $profile->tech_title, [ $profile->slug ], [ 'target' => '_blank' ]) }}<br/>
@endforeach
