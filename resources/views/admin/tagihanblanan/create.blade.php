@extends('admin.layouts.master')

@section('content')

<div class="row">
    <div class="col-sm-10 col-sm-offset-2">
        <h1>{{ trans('quickadmin::templates.templates-view_create-add_new') }}</h1>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {!! implode('', $errors->all('<li class="error">:message</li>')) !!}
                </ul>
        	</div>
        @endif
    </div>
</div>

{!! Form::open(array('route' => config('quickadmin.route').'.tagihanblanan.store', 'id' => 'form-with-validation', 'class' => 'form-horizontal')) !!}

<div class="form-group">
    {!! Form::label('datameteranpelanggan_id', 'Nama Pelanggan*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::select('datameteranpelanggan_id', $datameteranpelanggan, old('datameteranpelanggan_id'), array('class'=>'form-control js-example-basic-single', 'id'=>'selectOptions')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('awal_meteran', 'Meteran Sebelumnya*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('awal_meteran', old('awal_meteran'), array('class'=>'form-control', 'readonly')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('akhir_meteran', 'Meteran Sekarang*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('akhir_meteran', old('akhir_meteran'), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('total_pemakaian', 'Total Pemakaian /M3*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('total_pemakaian', old('total_pemakaian'), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('harga', 'Harga /M3*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('harga', old('harga'), array('class'=>'form-control', 'readonly')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('total_tagihan_bulan_ini', 'Total Tagihan Bulan ini*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('total_tagihan_bulan_ini', old('total_tagihan_bulan_ini'), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('tunggakan_sebelumnya', 'Tunggakan Sebelumnya*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('tunggakan_sebelumnya', old('tunggakan_sebelumnya'), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('diskon', 'Diskon %', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('diskon', old('diskon'), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('total_tagihan', 'Total Tagihan', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('total_tagihan', old('total_tagihan'), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('status_tagihan', 'Status Tagihan*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {{-- {!! Form::text('status_tagihan', old('status_tagihan'), array('class'=>'form-control')) !!} --}}
        {!! Form::select('status_tagihan', ['lunas' => 'Lunas', 'belum_lunas' => 'Belum Lunas'], old('status_tagihan'), ['class' => 'form-control']) !!}

    </div>
</div><div class="form-group">
    {!! Form::label('catatan', 'catatan', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::textarea('catatan', old('catatan'), array('class'=>'form-control')) !!}
        
    </div>
</div>

<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
      {!! Form::submit( trans('quickadmin::templates.templates-view_create-create') , array('class' => 'btn btn-primary')) !!}
    </div>
</div>


{!! Form::close() !!}

@endsection
@section('javascript')

<script>
$(document).ready(function() {
  $('.js-example-basic-single').select2();
});

$(document).ready(function() {
  // Tangkap peristiwa perubahan pada elemen select
  var start_meteran = 0;
  $('.js-example-basic-single').on('change', function() {
    // Ambil nilai yang dipilih
    var selectedValue = $(this).val();
    console.log(selectedValue);
var settings = {
  "url": "http://127.0.0.1:8000/api/gatdatapelanggan/"+selectedValue,
  "method": "GET",
  "timeout": 0,
  "headers": {
    "Cookie": "XSRF-TOKEN=eyJpdiI6IlFwQitPaVFNM0tBVWRlRjJwUFA1ZXc9PSIsInZhbHVlIjoiTHRVQUxSV2pxd2RpQmlFVm9qNjFvVGFBNjJVMnVnSDhvUkZIeFc1dVZiRjgzYXl1NGJyeGw5QlFiVjNuamFUViIsIm1hYyI6IjlhYjhlMzIwNDVkZjY0YzIwYmZlMTVkOGVhMjdmYWE1NDljOGY1ZGYxMjA5ZjA4OGVhNGE5MDE1NmU3ZDY1NTkifQ%3D%3D; laravel_session=eyJpdiI6Imk4eE9STVwvaWkxYjNNNllMYzhuZDRRPT0iLCJ2YWx1ZSI6ImZQTXJ0OVhPOHJUU3htdDRtazBoRTNVTEZPeHZ2WmVGM1FLZkNhblp3cXhEd25LXC80OEd0VTVQQ3V2UjVnN1VMIiwibWFjIjoiYzlhNDE2OGFhYzAzNmE4ZTQ2ODFmMTJhYjE3Y2Q3OTJiM2FmNWYxMTBiZjJlMzY0YTMxNmNjNjM2OGJkN2RkMiJ9"
  },
};
// on keyup count meteran
$.ajax(settings).done(function (response) {
//   console.log(response);
    start_meteran = response.start_meteran;
  $("#awal_meteran")[0].value = response.start_meteran;
  $("#tunggakan_sebelumnya")[0].value = response.tunggakan;
   hitung();
});
  });
// on keyup count meteran
  $('#akhir_meteran').on('keyup', function() {
        hitung();
  });

    $('#diskon').on('keyup', function() {
        hitung();
  });


function hitung(){

    // Ambil nilai yang dipilih
    var selectedValue = $('#akhir_meteran')[0].value;
    var total_meteran = selectedValue - start_meteran;
    var biaya = 0;
    var harga = 0;
    var tunggakan_sebelumnya = $("#tunggakan_sebelumnya")[0].value;
    if (total_meteran >= 0 && total_meteran <= 10) {
  biaya = total_meteran * 20000;
  harga = 20000;
} else if (total_meteran >= 11 && total_meteran <= 40) {
  biaya = total_meteran * 500;
   harga = 500;
} else if (total_meteran >= 41 && total_meteran <= 70) {
  biaya = total_meteran * 3000;
   harga = 3000;
} else if (total_meteran >= 71) {
  biaya = total_meteran * 5000;
   harga = 5000;
}
$("#harga")[0].value = harga;
$("#total_pemakaian")[0].value = total_meteran;
$("#total_tagihan_bulan_ini")[0].value = total_meteran*harga;
var diskon = $("#diskon")[0].value;
var total_tagihan = parseInt((total_meteran*harga))+parseInt(tunggakan_sebelumnya);
if(diskon>=1){
$("#total_tagihan")[0].value = total_tagihan-(total_tagihan*diskon/100);
}
else{
$("#total_tagihan")[0].value =total_tagihan;
}

    console.log(selectedValue);
    
}
});

</script>
@endsection