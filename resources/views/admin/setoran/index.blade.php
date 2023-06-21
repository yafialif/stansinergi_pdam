@extends('admin.layouts.master')

@section('content')

    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">{{ trans('quickadmin::templates.templates-customView_index-list') }}</div>
        </div>
        <div class="portlet-body">
            @if(Auth::user()->role_id <= 2)
            {!! Form::open(array('route' => 'cekstoran', 'id' => 'form-with-validation', 'class' => 'form-horizontal')) !!}
            <div class="form-group">
                {!! Form::label('nama_petugas', 'Petugas*', array('class'=>'col-sm-2 control-label')) !!}
                <div class="col-sm-10">
                    {!! Form::select('id_user', $user, old('id_user'), array('class'=>'form-control js-example-basic-single', 'id'=>'selectOptions')) !!}
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2">
                {!! Form::submit( 'Cek data' , array('class' => 'btn btn-primary')) !!}
                </div>
            </div>
             {!! Form::close() !!}
            @else
            <h2>123</h2>
            @endif
            @if($tagihanblanan)
                 <table class="table table-striped table-hover table-responsive datatable" id="datatable">
                <thead>
                    <tr>
                        <th>
                            {!! Form::checkbox('select_all',1,false,['class' => 'mass']) !!}
                        </th>
                        <th>Nama Petugas</th>
                        <th>Nama Pelanggan</th>
                        <th>Meteran Sebelumnya</th>
                        <th>Meteran Sekarang</th>
                        <th>Total Pemakaian /M3</th>
                        {{-- <th>Harga /M3</th> --}}
                        <th>Total Tagihan Bulan ini</th>
                        <th>Tunggakan Sebelumnya</th>
                        <th>Diskon %</th>
                        <th>Total Tagihan</th>
                        <th>Status Tagihan</th>
                        <th>Tanggal input</th>
                        <th>Bulan Penagihan</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($tagihanblanan as $row)
                        <tr>
                            <td>
                                {!! Form::checkbox('del-'.$row->id,1,false,['class' => 'single','data-id'=> $row->id,'data-tagihan'=>$row->total_tagihan]) !!}
                            </td>
                            <td>{{ $row->nama_petugas }}</td>
                            <td>{{ isset($row->datameteranpelanggan->nama) ? $row->datameteranpelanggan->nama : '' }}</td>
                            <td>{{ $row->awal_meteran }}</td>
                            <td>{{ $row->akhir_meteran }}</td>
                            <td>{{ $row->total_pemakaian }}</td>
                            {{-- <td>{{ $row->harga }}</td> --}}
                            <td>{{ $row->total_tagihan_bulan_ini }}</td>
                            <td>{{ $row->tunggakan_sebelumnya }}</td>
                            <td>{{ $row->diskon }}</td>
                            <td>{{ $row->total_tagihan }}</td>
                            <td>{{ $row->status_tagihan }}</td>
                            <td>{{ $row->created_at }}</td>
                            <td><?php echo date("F", strtotime($row->created_at)); ?></td>
                          
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
       
	</div>
    
    
    @if(Auth::user()->role_id <=2)
    <div class="form-group">
        {!! Form::label('', 'Total yang harus di setorkan :', array('class'=>'col-sm-2 control-label')) !!}
                <div class="col-sm-2">
                    <input name="" id="total_setor" class="form-control" readonly>
                </div>
            </div>
     <div class="row">
                <div class="col-xs-12">
                    <input class="btn btn-success" id="setorkan" value="Setorkan">
                </div>
            </div>
            {!! Form::open(['route' => 'kirimstoran', 'method' => 'post', 'id' => 'massSetor']) !!}
                <input type="hidden" id="send" name="setorkan">
                {{-- <input type="submit" value="Submit"> --}}
            {!! Form::close() !!}
    @endif
           

@endsection
@section('javascript')
    <script>
        $(document).ready(function () {
            $('.single').click(function () {
	        var toSetor = [];
                        $('.single').each(function () {
                            if ($(this).is(":checked")) {
                                toSetor.push($(this).data('tagihan'));
                            }
                        });
            var total = toSetor.reduce(function (accumulator, currentValue) {
            return accumulator + currentValue;
            }, 0);
            var formattedNumber = total.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });

                $('#total_setor')[0].value=formattedNumber;
            });
            $('#setorkan').click(function () {
                // if (window.confirm('{{ trans('quickadmin::templates.templates-view_index-are_you_sure') }}')) {
                    var send = $('#send');
                    var mass = $('.mass').is(":checked");
                    if (mass == true) {
                        send.val('mass');
                    } else {
                        var toSetor = [];
                        $('.single').each(function () {
                            if ($(this).is(":checked")) {
                                toSetor.push($(this).data('id'));
                            }
                        });
                        send.val(JSON.stringify(toSetor));
                    }
                    console.log(send);
                    $('#massSetor').submit();
                // }
            });

        });
    </script>
@endsection