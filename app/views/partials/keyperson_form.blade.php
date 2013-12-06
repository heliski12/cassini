<div class="form-group">
  {{ Form::label('first_name', 'First Name', [ 'class' => 'col-md-2 control-label' ]) }}
  <div class="col-md-10">
    {{ Form::text('first_name',Input::old('first_name'), [ 'class' => 'form-control', 'id' => 'first_name' ]) }}
  </div>
</div>
<div class="form-group">
  {{ Form::label('last_name', 'Last Name', [ 'class' => 'col-md-2 control-label' ]) }}
  <div class="col-md-10">
    {{ Form::text('last_name',Input::old('last_name'), [ 'class' => 'form-control', 'id' => 'last_name' ]) }}
  </div>
</div>
<div class="form-group">
  {{ Form::label('title', 'Title', [ 'class' => 'col-md-2 control-label' ]) }}
  <div class="col-md-10">
    {{ Form::text('title',Input::old('title'), [ 'class' => 'form-control', 'id' => 'title' ]) }}
  </div>
</div>
<div class="form-group">
  {{ Form::label('email', 'Email', [ 'class' => 'col-md-2 control-label' ]) }}
  <div class="col-md-10">
    {{ Form::text('email',Input::old('email'), [ 'class' => 'form-control', 'id' => 'email' ]) }}
  </div>
</div>
<div class="form-group">
  {{ Form::label('phone', 'Phone', [ 'class' => 'col-md-2 control-label' ]) }}
  <div class="col-md-10">
    {{ Form::text('phone',Input::old('phone'), [ 'class' => 'form-control', 'id' => 'phone' ]) }}
  </div>
</div>
<div class="form-group">
  {{ Form::label('address', 'Street Address', [ 'class' => 'col-md-2 control-label' ]) }}
  <div class="col-md-10">
    {{ Form::text('address',Input::old('address'), [ 'class' => 'form-control', 'id' => 'address' ]) }}
  </div>
</div>
<div class="form-group">
  {{ Form::label('address_line2', 'Address Line&nbsp;2', [ 'class' => 'col-md-2 control-label' ]) }}
  <div class="col-md-10">
    {{ Form::text('address_line2',Input::old('address_line2'), [ 'class' => 'form-control', 'id' => 'address_line2' ]) }}
  </div>
</div>
<div class="form-group">
  {{ Form::label('address_line3', 'Address Line&nbsp;3', [ 'class' => 'col-md-2 control-label' ]) }}
  <div class="col-md-10">
    {{ Form::text('address_line3',Input::old('address_line3'), [ 'class' => 'form-control', 'id' => 'address_line3' ]) }}
  </div>
</div>
<div class="form-group">
  {{ Form::label('city', 'City', [ 'class' => 'col-md-2 control-label' ]) }}
  <div class="col-md-4">
    {{ Form::text('city',Input::old('city'), [ 'class' => 'form-control', 'id' => 'city' ]) }}
  </div>
  {{ Form::label('state', 'State / Province', [ 'class' => 'col-md-2 control-label' ]) }}
  <div class="col-md-4">
    {{ Form::text('state',Input::old('state'), [ 'class' => 'form-control', 'id' => 'state' ]) }}
  </div>
</div>
<div class="form-group">
  {{ Form::label('zip_code', 'Zip&nbsp;Code / Postal&nbsp;Code', [ 'class' => 'col-md-2 control-label' ]) }}
  <div class="col-md-4">
    {{ Form::text('zip_code',Input::old('zip_code'), [ 'class' => 'form-control', 'id' => 'zip_code' ]) }}
  </div>
  {{ Form::label('country', 'Country', [ 'class' => 'col-md-2 control-label' ]) }}
  <div class="col-md-4">
    {{ Form::select('country', Config::get('countries.countries'), null, [ 'class' => 'form-control' ] ) }} 
  </div>
</div>
<div class="form-group">
  {{ Form::label('photo', 'Upload&nbsp;Photo (5&nbsp;MB&nbsp;max)', [ 'class' => 'col-md-2 control-label' ]) }}
  <div class="col-md-4">
    {{ Form::file('photo',[ 'class' => 'form-control', 'id' => 'photo' ]) }}

  </div>
</div>
