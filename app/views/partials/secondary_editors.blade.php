@foreach ($profile->collaborators as $idx => $collaborator)
  {{ $collaborator->email }}&nbsp;<a href="#" class="icon remove-se" pid="{{ $profile->id }}" uid="{{ $collaborator->id }}" title="Remove editor"><span class="glyphicon glyphicon-remove"></span></a>
@if ($idx < sizeof($profile->collaborators) - 1)
,  
  @endif
@endforeach
@if (!empty($error))
  <span class="alert alert-danger">
    {{ $error }}
  </span> 
@endif
