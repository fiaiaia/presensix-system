@extends('layouts.app')
@section('useracount','active')
@section('judulmenu','User')
@section('content')

<style>
    td, td .badge, td .bg-hover {
        font-size: 13px !important; 
    }

    table th, table td {
        white-space: nowrap;
    }
</style>

<div class="card">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="card-header d-flex justify-content-between">
        <span class="h5">
            @yield('judulmenu')
        </span>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hovered table-striped table-condensed" id="enroll_user">
                <thead>
                    <tr class="bg-primary-300">
                        <th> No </th>
                        <th> NIP / NISN </th>
                        <th> Nama </th>
                        <th> Email </th>
                        <th> Kelas </th>
                        <th> Posisi </th>
                        <th> Jenis Kelamin </th>
                        <th> No. Telepon </th>
                        <th> Nama Ortu </th>
                        <th> No. Telepon Ortu</th>
                        <th> Roles </th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@endsection

@section('js')
{{-- Datatable --}}
<script type="text/javascript">
    $(document).ready(function () {
        $('#enroll_user').DataTable({
            dom: 'Bfrtip',
            responsive: true,
            processing: true,
            serverSide: true,
            pageLength: 25,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            deferRender: true,
            scrollX: true,
            oLanguage: {sProcessing: `
                    <img src='{{ url('assetImg/loader.gif') }}' height='50px'>
                    <span class='text-nowrap text-warning'>Processing...</span>`},
            buttons: ['pageLength',
                {
                    extend: 'copy',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                    }
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                    }
                },
                'colvis'
            ],
            ajax: {
                type: 'GET',
                url: '{{ route('getDataUser')}}',
                data: function (d) {
                    return $.extend({}, d);
                }
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: true, searchable: false, width: '40px' },
                {data: 'credential_number', name: 'credential_number', searchable: true, visible: true, orderable: true, width: '100px' },
                {data: 'name', name: 'name', searchable: true, visible: true, orderable: true, width: '150px' },
                {data: 'email', name: 'email', searchable: true, visible: true, orderable: false, width: '100px' },
                {data: 'kelas', name: 'kelas', searchable: true, visible: true, orderable: false, width: '100px' },
                {data: 'position', name: 'position', searchable: true, visible: true, orderable: false, width: '100px' },
                {data: 'jenis_kelamin', name: 'jenis_kelamin', searchable: true, visible: true, orderable: false, width: '120px' },
                {data: 'no_telp', name: 'no_telp', searchable: true, visible: true, orderable: false, width: '100px' },
                {data: 'nama_ortu_siswa', name: 'nama_ortu_siswa', searchable: true, visible: true, orderable: false, width: '100px' },
                {data: 'no_telp_ortu', name: 'no_telp_ortu', searchable: true, visible: true, orderable: false, width: '100px' },
                {data: 'roles', name: 'roles', searchable: true, visible: true, orderable: false, width: '100px' },
            ]
        });

        var dtable = $('#enroll_user').dataTable().api();
    });

    $('#btnFiterSubmitSearch').click(function(){
         $('#enroll_user').DataTable().draw(true);
    }); 

    $("#btn_create").click(function () {
        $('#modal_choice_user').modal('show');
    });

</script>

{{-- Auto Focus Select2 --}}
<script>
	$(document).on('select2:open', () => {
	    document.querySelector('.select2-search__field').focus();
 	});
</script>
@endsection