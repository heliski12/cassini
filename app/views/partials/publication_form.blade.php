<div class="form-horizontal publication{{ $idx }}">
  {{ Form::hidden("publications[$idx][id]", $publication->id) }}
  <div class="form-group">
    <label class="control-label col-md-1">
    @if ($show_remove)
      <a href="#" class="icon remove-publication" id="remove_publication_{{$idx}}" title="Remove publication"><span class="glyphicon glyphicon-remove"></span></a> 
    @else
     &nbsp;
    @endif
    </label>
    {{ Form::label('', '&nbsp;', [ 'class' => 'col-md-1 control-label' ]) }}
    <div class="col-md-4">
      {{ Form::select("publications[$idx][publication_id]", SelectHelper::get_publication_options(), $publication->getFormValue(Input::old("publications[$idx][publication_id]"),"publication_id"), [ 'class' => 'selectpicker'. (!empty($extra) ? '-extra' : '') ] ) }} 
    </div>
    {{ Form::label("publications[$idx][name]", 'or enter name', [ 'class' => 'col-md-2 control-label' ]) }}
    <div class="col-md-4">
      {{ Form::text("publications[$idx][name]", $publication->getFormValue(Input::old("publications[$idx][name]"),"name"), [ 'class' => 'form-control' ]) }}
    </div>
  </div>
  <div class="form-group">
    {{ Form::label("publications[$idx][article_title]", 'Title', [ 'class' => 'col-md-2 control-label' ]) }}
    <div class="col-md-10">
      {{ Form::text("publications[$idx][article_title]", $publication->getFormValue(Input::old("publications[$idx][article_title]"),"article_title"), [ 'class' => 'form-control' ]) }}
    </div>
  </div>
  <div class="form-group">
    {{ Form::label("publications[$idx][article_url]", 'URL', [ 'class' => 'col-md-2 control-label' ]) }}
    <div class="col-md-10">
      {{ Form::text("publications[$idx][article_url]",$publication->getFormValue(Input::old("publications[$idx][article_url]"),"article_url"), [ 'class' => 'form-control' ]) }}
    </div>
  </div>
</div>
