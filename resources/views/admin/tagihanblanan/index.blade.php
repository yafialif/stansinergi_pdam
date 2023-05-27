@extends('admin.layouts.master')

@section('content')

<p>{!! link_to_route(config('quickadmin.route').'.tagihanblanan.create', 'Tambah tagihan baru' , null, array('class' => 'btn btn-success')) !!}</p>

@if ($tagihanblanan->count())
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">{{ trans('quickadmin::templates.templates-view_index-list') }}</div>
        </div>
        <div class="portlet-body">
            <div class="table-responsive">
            <table class="table table-striped table-hover table-responsive datatable" id="datatable">
                <thead>
                    <tr>
                        <th>
                            {!! Form::checkbox('delete_all',1,false,['class' => 'mass']) !!}
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

                        <th>&nbsp;</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($tagihanblanan as $row)
                        <tr>
                            <td>
                                {!! Form::checkbox('del-'.$row->id,1,false,['class' => 'single','data-id'=> $row->id]) !!}
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
                            <td>
                                {!! link_to_route('cetakresi', 'Cetak', array($row->id), array('class' => 'btn btn-xs btn-info','target'=>'_blank')) !!}
                                <?php
                                    if(Auth::user()->role_id <=2){
                                ?>
                                {!! link_to_route(config('quickadmin.route').'.tagihanblanan.edit', trans('quickadmin::templates.templates-view_index-edit'), array($row->id), array('class' => 'btn btn-xs btn-info')) !!}
                                {!! Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'onsubmit' => "return confirm('".trans("quickadmin::templates.templates-view_index-are_you_sure")."');",  'route' => array(config('quickadmin.route').'.tagihanblanan.destroy', $row->id))) !!}
                                {!! Form::submit(trans('quickadmin::templates.templates-view_index-delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                {!! Form::close() !!}

                                <?php
                                }
                                ?>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <button class="btn btn-danger" id="delete">
                        {{ trans('quickadmin::templates.templates-view_index-delete_checked') }}
                    </button>
                </div>
            </div>
            <?php
            if(Auth::user()->role_id <=2){
             ?>
            {!! Form::open(['route' => config('quickadmin.route').'.tagihanblanan.massDelete', 'method' => 'post', 'id' => 'massDelete']) !!}
                <input type="hidden" id="send" name="toDelete">
            {!! Form::close() !!}
            <?php
            }
            ?>

        </div>
	</div>
@else
    {{ trans('quickadmin::templates.templates-view_index-no_entries_found') }}
@endif

@endsection

@section('javascript')
    <script>
        $(document).ready(function () {
            $('#delete').click(function () {
                if (window.confirm('{{ trans('quickadmin::templates.templates-view_index-are_you_sure') }}')) {
                    var send = $('#send');
                    var mass = $('.mass').is(":checked");
                    if (mass == true) {
                        send.val('mass');
                    } else {
                        var toDelete = [];
                        $('.single').each(function () {
                            if ($(this).is(":checked")) {
                                toDelete.push($(this).data('id'));
                            }
                        });
                        send.val(JSON.stringify(toDelete));
                    }
                    $('#massDelete').submit();
                }
            });
        });
    </script>
@stop