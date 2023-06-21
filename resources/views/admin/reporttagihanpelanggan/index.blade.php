@extends('admin.layouts.master')

@section('css')
<link href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/datatables.min.css" rel="stylesheet"/>
 

@endsection
@section('content')

    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">{{ trans('quickadmin::templates.templates-customView_index-list') }}</div>
        </div>
        <div class="portlet-body">
            <table id="reportTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Awal Meteran</th>
            <th>Akhir Meteran</th>
            <th>Total Pemakaian</th>
            <th>Harga</th>
            <th>Total Tagihan Bulan Ini</th>
            <th>Tunggakan Sebelumnya</th>
            <th>Total Tagihan</th>
            <th>Status Tagihan</th>
            <th>Catatan</th>
            <th>Nama Petugas</th>
            <th>Created At</th>
            <th>Updated At</th>
        </tr>
    </thead>
    <tbody>
        <!-- Data akan ditambahkan melalui JavaScript -->
    </tbody>
</table>
        </div>
	</div>

@endsection

@section('javascript')
 
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/datatables.min.js"></script>
<script>
     $(document).ready(function() {
        // Submit form menggunakan AJAX
        $('#reportForm').submit(function(e) {
            e.preventDefault();

            var form = $(this);
            var url = form.attr('action');
            var startDate = $('#start_date').val();
            var endDate = $('#end_date').val();

            $.ajax({
                type: "POST",
                url: url,
                data: {
                    start_date: startDate,
                    end_date: endDate,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Clear tabel sebelumnya
                    $('#reportTable tbody').empty();

                    // Looping data dan tambahkan ke tabel
                    $.each(response, function(index, row) {
                        var newRow = "<tr>" +
                            "<td>" + row.id + "</td>" +
                            "<td>" + row.awal_meteran + "</td>" +
                            "<td>" + row.akhir_meteran + "</td>" +
                            "<td>" + row.total_pemakaian + "</td>" +
                            "<td>" + row.harga + "</td>" +
                            "<td>" + row.total_tagihan_bulan_ini + "</td>" +
                            "<td>" + row.tunggakan_sebelumnya + "</td>" +
                            "<td>" + row.total_tagihan + "</td>" +
                            "<td>" + row.status_tagihan + "</td>" +
                            "<td>" + row.catatan + "</td>" +
                            "<td>" + row.nama_petugas + "</td>" +
                            "<td>" + row.created_at + "</td>" +
                            "<td>" + row.updated_at + "</td>" +
                            "</tr>";

                        $('#reportTable tbody').append(newRow);
                    });
                }
            });
        });
    });
</script>


@endsection