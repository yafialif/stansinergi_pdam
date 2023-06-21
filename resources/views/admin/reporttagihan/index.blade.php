@extends('admin.layouts.master')
@section('css')
<link href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/datatables.min.css" rel="stylesheet"/>

@endsection
@section('content')
Start date: <input type="date" id="start_date" name="start_date"> End date: <input type="date" name="end_date" id="end_date" > <button onclick="submitdata()">Submit</button>
<br>
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
    //  $(document).ready(function() {
        // Submit form menggunakan AJAX
        var table = $('#reportTable').DataTable({
  dom: 'Bfrtip',
  buttons: [
    'copy', 'csv', 'excel', 'pdf', 'print'
  ],
  language: {
    emptyTable: "Empty"
  }
});
    //  });

        function submitdata(){
            
            var startDate = $('#start_date').val();
            var endDate = $('#end_date').val();
            var url = window.location.protocol + "//" + window.location.host+"/api/reporttagihanbydate/"+startDate+"/"+endDate;
            
table.clear().draw();
  // Mengambil data menggunakan AJAX
  $.ajax({
    url: url,
    method: 'GET',
    dataType: 'json',
    success: function(response) {
      // Mengisi DataTable dengan data yang diperoleh
      console.log(response);
    //   table.clear();
    response.forEach(function(data) {
      table.row.add([
          data.id,
          data.awal_meteran,
          data.akhir_meteran,
          data.total_pemakaian,
          data.harga,
          data.total_tagihan_bulan_ini,
          data.tunggakan_sebelumnya,
          data.total_tagihan,
          data.status_tagihan,
          data.catatan,
          data.nama_petugas,
          data.created_at,
          data.updated_at
        ]).draw();
      });
    },
    error: function(xhr, status, error) {
      console.log(xhr.responseText);
    }
  });
                
        };
    // });
</script>


@endsection