<div class="form-horizontal">
  <div class="form-group">
    {{ Form::label('presentation[0][title]', 'Title', [ 'class' => 'col-md-1 control-label' ]) }}
    <div class="col-md-11">
      {{ Form::text('presentation[0][title]', Input::old('presentation[0][title]'), [ 'class' => 'form-control' ]) }}
    </div>
  </div>
  <div class="form-group">
    {{ Form::label('presentation[0][url]', 'URL', [ 'class' => 'col-md-1 control-label' ]) }}
    <div class="col-md-11">
      {{ Form::text('presentation[0][url]',Input::old('presentation[0][url])'), [ 'class' => 'form-control' ]) }}
    </div>
  </div>
</div>
