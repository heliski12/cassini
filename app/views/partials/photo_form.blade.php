<div class="form-horizontal">
  @if (empty($photo) or empty($photo->photo_file_name))
    <div class="form-group">
      <label class="col-md-3 control-label" for="photo_photos[]">Photo {{ $label }}@if ($label == 1)&nbsp;&nbsp;<span class="asterisk">*</span>@endif</label>
      <div class="col-md-9">
        {{ Form::file('photo_photos[]',[ 'class' => 'form-control' ]) }}
      </div>
    </div>
  @else
    <div class="form-group">
      <label class="col-md-3 control-label">Photo {{ $label }}@if ($label == 1)&nbsp;&nbsp;<span class="public-warning">*</span>@endif</label>
      <div class="col-md-9">
        <img class="photo-photo" src="{{ asset($photo->photo->url('thumb')) }}" />
      </div>
      <div>
        {{ Form::label("photo_photos[]", "Upload&nbsp;new&nbsp;photo $label (5&nbsp;MB&nbsp;max)", [ "class" => "col-md-3 control-label" ]) }}
        <div class="col-md-9">
          {{ Form::file("photo_photos[]",[ "class" => "form-control" ]) }}
        </div>
      </div>
    </div>
  @endif
  <div class="form-group">
    {{ Form::label("photos[$idx][description]", 'Description', [ 'class' => 'col-md-3 control-label' ]) }}
    <div class="col-md-9">
      {{ Form::text("photos[$idx][description]",$photo->getFormValue(Input::old("photo[$idx][description]"),"description"), [ 'class' => 'form-control' ]) }}
      {{ Form::hidden("photos[$idx][id]", $photo->id) }}
    </div>
  </div>
</div>
