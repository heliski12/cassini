<div class="form-horizontal">
  <div class="form-group">
    {{ Form::label('award[0][title]', 'Title', [ 'class' => 'col-md-1 control-label' ]) }}
    <div class="col-md-11">
      {{ Form::text('award[0][title]', Input::old('award[0][title]'), [ 'class' => 'form-control' ]) }}
    </div>
  </div>
  <div class="form-group">
    {{ Form::label('award[0][url]', 'URL', [ 'class' => 'col-md-1 control-label' ]) }}
    <div class="col-md-11">
      {{ Form::text('award[0][url]',Input::old('award[0][url])'), [ 'class' => 'form-control' ]) }}
    </div>
  </div>
</div>
