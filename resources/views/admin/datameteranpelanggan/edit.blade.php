@extends('admin.layouts.master')

@section('content')

<div class="row">
    <div class="col-sm-10 col-sm-offset-2">
        <h1>{{ trans('quickadmin::templates.templates-view_edit-edit') }}</h1>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {!! implode('', $errors->all('<li class="error">:message</li>')) !!}
                </ul>
        	</div>
        @endif
    </div>
</div>

{!! Form::model($datameteranpelanggan, array('class' => 'form-horizontal', 'id' => 'form-with-validation', 'method' => 'PATCH', 'route' => array(config('quickadmin.route').'.datameteranpelanggan.update', $datameteranpelanggan->id))) !!}

<div class="form-group">
    {!! Form::label('nama', 'Nama Pemilik*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('nama', old('nama',$datameteranpelanggan->nama), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('no_meteran', 'Nomor Meteran*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('no_meteran', old('no_meteran',$datameteranpelanggan->no_meteran), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('start_meteran', 'Start Meteran*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('start_meteran', old('start_meteran',$datameteranpelanggan->start_meteran), array('class'=>'form-control')) !!}
        
    </div>
</div>
<div class="form-group">
    {!! Form::label('rt', 'rt', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('rt', old('rt',$datameteranpelanggan->rt), array('class'=>'form-control')) !!}
        
    </div>
</div>
<div class="form-group">
    {!! Form::label('rw', 'rw*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('rw', old('rw',$datameteranpelanggan->rw), array('class'=>'form-control')) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('alamat', 'Alamat*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('alamat', old('alamat',$datameteranpelanggan->alamat), array('class'=>'form-control')) !!}
        
    </div>
</div>
<div class="form-group">
    {!! Form::label('dusun', 'Dusun', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        <select class="form-control" name="dusun">
            <option {{ $datameteranpelanggan->dusun == 'Babakan' ? 'selected' : ''}}  value="Babakan">Babakan</option>
            <option {{ $datameteranpelanggan->dusun == 'Pangkalan' ? 'selected' : ''}} value="Pangkalan">Pangkalan</option>
            <option {{ $datameteranpelanggan->dusun == 'Gondosoli' ? 'selected' : ''}} value="Gondosoli">Gondosoli</option>
        </select>
    </div>
</div>
<div class="form-group">
    {!! Form::label('Desa', 'Desa', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('desa', old('desa',$datameteranpelanggan->desa), array('class'=>'form-control')) !!}
        
    </div>
</div>
<div class="form-group">
    {!! Form::label('wa', 'HP/WA', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('wa', old('wa',$datameteranpelanggan->wa), array('class'=>'form-control')) !!}
        
    </div>
</div>
<div class="form-group">
    {!! Form::label('jenis_saluran', 'Dusun', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        <select class="form-control" name="jenis_saluran">
            <option {{ $datameteranpelanggan->jenis_saluran == 'Pompa' ? 'selected' : ''}} value="Pompa">Pompa</option>
            <option {{ $datameteranpelanggan->jenis_saluran == 'Gravitasi' ? 'selected' : ''}} value="Gravitasi">Gravitasi</option>
        </select>
        
    </div>
</div>
<div class="form-group">
    {!! Form::label('catatan', 'catatan', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::textarea('catatan', old('catatan',$datameteranpelanggan->catatan), array('class'=>'form-control ckeditor')) !!}
        
    </div>
</div>

<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
      {!! Form::submit(trans('quickadmin::templates.templates-view_edit-update'), array('class' => 'btn btn-primary')) !!}
      {!! link_to_route(config('quickadmin.route').'.datameteranpelanggan.index', trans('quickadmin::templates.templates-view_edit-cancel'), null, array('class' => 'btn btn-default')) !!}
    </div>
</div>

{!! Form::close() !!}

@endsection