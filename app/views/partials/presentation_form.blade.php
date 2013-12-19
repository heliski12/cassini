<div class="form-horizontal presentation{{ $idx }}">
{{ Form::hidden("presentations[$idx][id]", $presentation->id) }}
  <div class="form-group">
    <label class="control-label col-md-1">
    @if ($show_remove)
      <a href="#" class="icon remove-presentation" id="remove_presentation_{{$idx}}" title="Remove presentation"><span class="glyphicon glyphicon-remove"></span></a> 
    @else
      &nbsp;
    @endif
    </label>
    {{ Form::label("presentations[$idx][title]", 'Title', [ 'class' => 'col-md-1 control-label' ]) }}
    <div class="col-md-10">
      {{ Form::text("presentations[$idx][title]",$presentation->getFormValue(Input::old("presentations[$idx][title]"),"title"), [ 'class' => 'form-control' ]) }}
    </div>
  </div>
  <div class="form-group">
    {{ Form::label("presentations[$idx][url]", 'URL', [ 'class' => 'col-md-2 control-label' ]) }}
    <div class="col-md-10">
      {{ Form::text("presentations[$idx][url]",$presentation->getFormValue(Input::old("presentations[$idx][url]"),"url"), [ 'class' => 'form-control' ]) }}
    </div>
  </div>
</div>
