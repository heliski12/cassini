<div class="form-horizontal">
  <div class="form-group">
    {{ Form::label('presentation[0][title]', 'Title (remove)', [ 'class' => 'col-md-2 control-label' ]) }}
    <div class="col-md-10">
      {{ Form::text('presentation[0][title]', Input::old('presentation[0][title]'), [ 'class' => 'form-control' ]) }}
    </div>
  </div>
  <div class="form-group">
    {{ Form::label('presentation[0][url]', 'URL', [ 'class' => 'col-md-2 control-label' ]) }}
    <div class="col-md-10">
      {{ Form::text('presentation[0][url]',Input::old('presentation[0][url])'), [ 'class' => 'form-control' ]) }}
    </div>
  </div>
</div>
