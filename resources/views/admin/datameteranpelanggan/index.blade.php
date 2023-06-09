@extends('admin.layouts.master')

@section('content')

<p>{!! link_to_route(config('quickadmin.route').'.datameteranpelanggan.create', trans('quickadmin::templates.templates-view_index-add_new') , null, array('class' => 'btn btn-success')) !!}</p>

@if ($datameteranpelanggan->count())
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">{{ trans('quickadmin::templates.templates-view_index-list') }}</div>
        </div>
        <div class="portlet-body">
            <table class="table table-striped table-hover table-responsive datatable" id="datatable">
                <thead>
                    <tr>
                        <th>
                            {!! Form::checkbox('delete_all',1,false,['class' => 'mass']) !!}
                        </th>
                        <th>Nama Pemilik</th>
<th>Nomor Meteran</th>
<th>Start Meteran</th>
<th>RT</th>
<th>RW</th>
<th>No Rumah/Alamat</th>
<th>dusun</th>
<th>Jenis Saluran</th>
<th>desa</th>
<th>WA</th>

                        <th>&nbsp;</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($datameteranpelanggan as $row)
                        <tr>
                            <td>
                                {!! Form::checkbox('del-'.$row->id,1,false,['class' => 'single','data-id'=> $row->id]) !!}
                            </td>
                            <td>{{ $row->nama }}</td>
<td>{{ $row->no_meteran }}</td>
<td>{{ $row->start_meteran }}</td>
<td>{{ $row->rt }}</td>
<td>{{ $row->rw }}</td>
<td>{{ $row->alamat }}</td>
<td>{{ $row->dusun }}</td>
<td>{{ $row->jenis_saluran }}</td>
<td>{{ $row->desa }}</td>
<?php
$phone_number = preg_replace('/\D/', '', $row->wa);
if (substr($phone_number, 0, 1) === '0') {
    $phone_number = '62' . substr($phone_number, 1);
} elseif (substr($phone_number, 0, 3) === '+62') {
    $phone_number = '62' . substr($phone_number, 3);
}
?>
<td><a href="https://api.whatsapp.com/send?phone={{ $phone_number }}" target="_blank">{!! $row->wa !!}</a></td>
                            <td>
                                {!! link_to_route(config('quickadmin.route').'.datameteranpelanggan.edit', trans('quickadmin::templates.templates-view_index-edit'), array($row->id), array('class' => 'btn btn-xs btn-info')) !!}
                                {!! Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'onsubmit' => "return confirm('".trans("quickadmin::templates.templates-view_index-are_you_sure")."');",  'route' => array(config('quickadmin.route').'.datameteranpelanggan.destroy', $row->id))) !!}
                                {!! Form::submit(trans('quickadmin::templates.templates-view_index-delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="col-xs-12">
                    <button class="btn btn-danger" id="delete">
                        {{ trans('quickadmin::templates.templates-view_index-delete_checked') }}
                    </button>
                </div>
            </div>
            {!! Form::open(['route' => config('quickadmin.route').'.datameteranpelanggan.massDelete', 'method' => 'post', 'id' => 'massDelete']) !!}
                <input type="hidden" id="send" name="toDelete">
            {!! Form::close() !!}
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