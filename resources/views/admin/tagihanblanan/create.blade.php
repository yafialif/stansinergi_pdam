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
    {!! Form::label('nama_petugas', 'Petugas*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {{-- {!! Form::text('id_petugas', old('id_petugas'), array('class'=>'form-control','readonly'=>'true')) !!} --}}
        {!! Form::text('nama_petugas', value(Auth::user()->name), array('class'=>'form-control', 'readonly'=>'true', 'innertext'=>'Some Text')) !!}
        {!! Form::hidden('id_petugas', value(Auth::user()->id), array('class'=>'form-control', 'readonly'=>'true', 'type'=>'hidden', 'innertext'=>'Some Text')) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('datameteranpelanggan_id', 'Nama Pelanggan*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::select('datameteranpelanggan_id', $datameteranpelanggan, old('datameteranpelanggan_id'), array('class'=>'form-control js-example-basic-single', 'id'=>'selectOptions')) !!}
    </div>
</div>
<div class="form-group">
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
        {!! Form::text('total_pemakaian', old('total_pemakaian'), array('class'=>'form-control','readonly'=>'true')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('harga', 'Harga /M3*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('harga', old('harga'), array('class'=>'form-control', 'readonly')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('total_tagihan_bulan_ini', 'Total Tagihan Bulan ini*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('total_tagihan_bulan_ini', old('total_tagihan_bulan_ini'), array('class'=>'form-control','readonly'=>'true')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('tunggakan_sebelumnya', 'Tunggakan Sebelumnya*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('tunggakan_sebelumnya', old('tunggakan_sebelumnya'), array('class'=>'form-control','readonly'=>'true')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('diskon', 'Diskon %', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('diskon', old('diskon'), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('total_tagihan', 'Total Tagihan', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('total_tagihan', old('total_tagihan'), array('class'=>'form-control','readonly'=>'true')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('status_tagihan', 'Status Tagihan*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {{-- {!! Form::text('status_tagihan', old('status_tagihan'), array('class'=>'form-control')) !!} --}}
        {!! Form::select('status_tagihan', ['' => 'Pilih salah satu','lunas' => 'Lunas', 'belum_lunas' => 'Belum Lunas'], old('status_tagihan'), ['class' => 'form-control']) !!}

    </div>
</div><div class="form-group">
    {!! Form::label('catatan', 'catatan', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::textarea('catatan', old('catatan'), array('class'=>'form-control')) !!}
        
    </div>
</div>

</div><div class="form-group">
    {!! Form::label('Lokasi anda', 'Lokasi anda', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-5">
        {!! Form::text('latitude', old('latitude'), array('class'=>'form-control','id'=>'latitude','readonly'=>'true')) !!}
    </div>
    <div class="col-sm-5">
        {!! Form::text('longitude', old('longitude'), array('class'=>'form-control','id'=>'longitude','readonly'=>'true')) !!}
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
  const baseUrl = window.location.origin;
  $('.js-example-basic-single').on('change', function() {
    // Ambil nilai yang dipilih
    var selectedValue = $(this).val();
    console.log(selectedValue);
var settings = {
  "url": baseUrl+"/api/gatdatapelanggan/"+selectedValue,
  "method": "GET",
  "timeout": 0,
  "headers": {
    "Cookie": "XSRF-TOKEN=eyJpdiI6IlFwQitPaVFNM0tBVWRlRjJwUFA1ZXc9PSIsInZhbHVlIjoiTHRVQUxSV2pxd2RpQmlFVm9qNjFvVGFBNjJVMnVnSDhvUkZIeFc1dVZiRjgzYXl1NGJyeGw5QlFiVjNuamFUViIsIm1hYyI6IjlhYjhlMzIwNDVkZjY0YzIwYmZlMTVkOGVhMjdmYWE1NDljOGY1ZGYxMjA5ZjA4OGVhNGE5MDE1NmU3ZDY1NTkifQ%3D%3D; laravel_session=eyJpdiI6Imk4eE9STVwvaWkxYjNNNllMYzhuZDRRPT0iLCJ2YWx1ZSI6ImZQTXJ0OVhPOHJUU3htdDRtazBoRTNVTEZPeHZ2WmVGM1FLZkNhblp3cXhEd25LXC80OEd0VTVQQ3V2UjVnN1VMIiwibWFjIjoiYzlhNDE2OGFhYzAzNmE4ZTQ2ODFmMTJhYjE3Y2Q3OTJiM2FmNWYxMTBiZjJlMzY0YTMxNmNjNjM2OGJkN2RkMiJ9"
  },
};
// on keyup count meteran
$.ajax(settings).done(function (response) {
  console.log(response);
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
    var start_meteran = $('#awal_meteran')[0].value;
    var selectedValue = $('#akhir_meteran')[0].value;
    var total_meteran = selectedValue - start_meteran;
    var biaya = 0;
    var harga = 0;
    var tunggakan_sebelumnya = $("#tunggakan_sebelumnya")[0].value;
    let cost = 0;
    var price1="",price2="",price3="",price4="";
    if (total_meteran <= 10) {
    cost = 20000;
    price1 = "20.000";
  } else if (total_meteran <= 40) {
    const additionalM3 = total_meteran - 10;
    cost = 20000 + additionalM3 * 500;
    price2 = "20.000 + ("+additionalM3+" x 500)";
  } else if (total_meteran <= 70) {
    const additionalM3 = total_meteran - 40;
    cost = 20000 + 30 * 500 + additionalM3 * 3000;
    price3 = "20.000 + (30 x 500) + ("+additionalM3+" x 3000)";
  } else {
   
    const additionalM3 = total_meteran - 70;
     price4 = "20.000 + (30 x 500) + (30 x 3000) + ("+additionalM3+" x 5000)";
    cost = 20000 + 30 * 500 + 30 * 3000 + additionalM3 * 5000;
  }
  
//   return cost;

console.log(price1);
$("#harga")[0].value = price1+price2+price3+price4;
$("#total_pemakaian")[0].value = total_meteran;
$("#total_tagihan_bulan_ini")[0].value = cost;
var diskon = $("#diskon")[0].value;
var total_tagihan = parseInt(cost)+parseInt(tunggakan_sebelumnya);
if(diskon>=1){
$("#total_tagihan")[0].value = total_tagihan-(total_tagihan*diskon/100);
}
else{
$("#total_tagihan")[0].value =total_tagihan;
}

    console.log(selectedValue);
    
}
});

if (navigator.geolocation) {
  // Geolocation didukung oleh browser
  navigator.geolocation.getCurrentPosition(function(position) {
    // Mendapatkan koordinat geografis (latitude dan longitude)
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;

    // Lakukan sesuatu dengan koordinat geografis, misalnya tampilkan dalam console
    console.log("Latitude: " + latitude);
    console.log("Longitude: " + longitude);
    $("#latitude")[0].value = latitude;
    $("#longitude")[0].value = longitude;
  }, function(error) {
    // Terjadi kesalahan saat mendapatkan lokasi
    console.error("Kesalahan: " + error.message);
  });
} else {
  // Geolocation tidak didukung oleh browser
  console.error("Geolocation tidak didukung oleh browser.");
}

</script>
@endsection