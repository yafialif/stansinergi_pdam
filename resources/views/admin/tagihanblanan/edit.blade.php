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

{!! Form::model($tagihanblanan, array('class' => 'form-horizontal', 'id' => 'form-with-validation', 'method' => 'PATCH', 'route' => array(config('quickadmin.route').'.tagihanblanan.update', $tagihanblanan->id))) !!}

<div class="form-group">
    {!! Form::label('datameteranpelanggan_id', 'Nama Pelanggan*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::select('datameteranpelanggan_id', $datameteranpelanggan, old('datameteranpelanggan_id',$tagihanblanan->datameteranpelanggan_id), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('awal_meteran', 'Meteran Sebelumnya*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('awal_meteran', old('awal_meteran',$tagihanblanan->awal_meteran), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('akhir_meteran', 'Meteran Sekarang*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('akhir_meteran', old('akhir_meteran',$tagihanblanan->akhir_meteran), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('total_pemakaian', 'Total Pemakaian /M3*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('total_pemakaian', old('total_pemakaian',$tagihanblanan->total_pemakaian), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('harga', 'Harga /M3*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('harga', old('harga',$tagihanblanan->harga), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('total_tagihan_bulan_ini', 'Total Tagihan Bulan ini*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('total_tagihan_bulan_ini', old('total_tagihan_bulan_ini',$tagihanblanan->total_tagihan_bulan_ini), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('tunggakan_sebelumnya', 'Tunggakan Sebelumnya*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('tunggakan_sebelumnya', old('tunggakan_sebelumnya',$tagihanblanan->tunggakan_sebelumnya), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('diskon', 'Diskon %', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('diskon', old('diskon',$tagihanblanan->diskon), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('total_tagihan', 'Total Tagihan', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('total_tagihan', old('total_tagihan',$tagihanblanan->total_tagihan), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('status_tagihan', 'Status Tagihan*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('status_tagihan', old('status_tagihan',$tagihanblanan->status_tagihan), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('catatan', 'catatan', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::textarea('catatan', old('catatan',$tagihanblanan->catatan), array('class'=>'form-control')) !!}
        
    </div>
</div>

<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
      {!! Form::submit(trans('quickadmin::templates.templates-view_edit-update'), array('class' => 'btn btn-primary')) !!}
      {!! link_to_route(config('quickadmin.route').'.tagihanblanan.index', trans('quickadmin::templates.templates-view_edit-cancel'), null, array('class' => 'btn btn-default')) !!}
    </div>
</div>

{!! Form::close() !!}

@endsection