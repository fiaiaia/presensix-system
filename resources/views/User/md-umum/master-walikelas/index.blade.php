@extends('layouts.app')
@section('masterWalikelas','active')
@section('judulmenu','Master Walikelas')
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
        <div class="d-flex">
            <button id="btn_create" class="btn btn-outline-success fw-bold"><i class="ph-plus me-1"></i>Add</button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hovered table-striped table-condensed" id="walikelas_table">
                <thead>
                    <tr class="bg-primary-300">
                        <th> No </th>
                        <th> ID Wali Kelas </th>
                        <th> ID Kelas </th>
                        <th> Status </th>
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
        $('#walikelas_table').DataTable({
            dom: 'Bfrtip',
            responsive: true,
            processing: true,
            serverSide: true,
            pageLength: 25,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            deferRender: true,
            scrollX: false,
            oLanguage: {sProcessing: `
                    <img src='{{ url('assetImg/loader.gif') }}' height='50px'>
                    <span class='text-nowrap text-warning'>Processing...</span>`},
            buttons: ['pageLength',
                {
                    extend: 'copy',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3 ]
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3 ]
                    }
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3 ]
                    }
                },
                'colvis'
            ],
            ajax: {
                type: 'GET',
                url: '{{ route('getDataWalikelas')}}',
                data: function (d) {
                    return $.extend({}, d);
                }
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: true, searchable: false, width: '40px' },
                {data: 'id_walikelas', name: 'id_walikelas', searchable: true, visible: true, orderable: true, width: '100px' },
                {data: 'id_kelas', name: 'id_kelas', searchable: true, visible: true, orderable: true, width: '150px' },
                {data: 'is_active', name: 'is_active', searchable: true, visible: true, orderable: false, width: '100px' },
            ]
        });

        var dtable = $('#walikelas_table').dataTable().api();
    });

    $('#btnFiterSubmitSearch').click(function(){
         $('#walikelas_table').DataTable().draw(true);
    }); 
</script>

{{-- Auto Focus Select2 --}}
<script>
    $(document).on('select2:open', () => {
        document.querySelector('.select2-search__field').focus();
    });
</script>

@endsection
