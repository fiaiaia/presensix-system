@extends('layouts.app')
@section('monitoring_presensi','active')
@section('judulmenu','Monitoring Presensi')
@section('content')

<style>
    td, td .badge, td .bg-hover{
        font-size: 13px !important; 
    }
    .dataTables_wrapper .dataTables_processing {
    background: #FFFFCC;
    border: 1px solid black;
    border-radius: 10px;
    font-weight: bold;
    left: 63%;
    top: 125px;
    z-index: 1000;
    position: absolute;
    }
    #canhover:hover{
        transition: ease-in-out 0.15s;
        transform: scale(1.07);
        box-shadow: 2px 7px 9px -3px rgba(0,0,0,0.35);
-webkit-box-shadow: 2px 7px 9px -3px rgba(0,0,0,0.35);
-moz-box-shadow: 2px 7px 9px -3px rgba(0,0,0,0.35);
    }
    .stared a{
        color: rgb(255, 196, 0) !important;
        text-decoration: none !important;
    }

    .disabled-element {
        pointer-events: none; 
        cursor: not-allowed;
    }

    .enabled-element{
        pointer-events: auto; 
        cursor: auto;
    }
</style>

<div class="card">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col-md-6">
                <span class="h5">@yield('judulmenu')</span>
            </div>
            <div class="col-md-6 text-md-end mt-2 mt-md-0">
                <div class="row">
                    <div class="col-lg-4 col-6 mb-2 mb-lg-0">
                        <select class="w-100 form-select" id="remark_hadir">
                            <option value="ALL" selected>All</option>
                            <option value="ON_TIME">On-Time</option>
                            <option value="LATE">Late</option>
                            <option value="OVERTIME">Overtime</option>
                            <option value="ABSENT">Absent</option>
                        </select>
                    </div>
                    <div class="col-lg-4 col-6">
                        <select class="w-100 form-select" id="dyear">
                            <option value="2024" selected>2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                        </select>                    
                    </div>
                    <div class="col-lg-4 col-6">
                        <select class="w-100 form-select" id="dmonth">
                            <option value="full" selected>Full Year</option>
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>                    
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-basic table-condensed datatable-button-init-custom" width="100%" id="log_monitoring_table">
                        <thead>
                            <tr class="bg-primary-300">
                                <th> No </th>
                                <th> Name </th>
                                <th> NISN </th>
                                <th> Class </th>
                                <th> Date </th>
                                <th> Time In </th>
                                <th> Time Out </th>
                                <th> Remark </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
{{-- Rapikan Dropdown inner Datatable --}}
<script type="text/javascript">
    $('.table-responsive').on('show.bs.dropdown', function () {
         $('.table-responsive').css( "overflow-y", "inherit" );
    });
    
    $('.table-responsive').on('hide.bs.dropdown', function () {
         $('.table-responsive').css( "overflow", "auto" );
    })
</script>

{{-- Datatable --}}
<script type="text/javascript">
    var remark_hadir = $('#remark_hadir').val();

    $('#remark_hadir').on('change', function () {
        remark_hadir = $('#remark_hadir').find('option').filter(':selected').val();
        $('#log_monitoring_table').DataTable().ajax.reload();
    });
    
    $(document).ready(function () {
        $('#log_monitoring_table').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        processing: true,
        serverSide: true,
        pageLength: 25,
        scroller:true,
        lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
        oLanguage: {sProcessing: `
                <img src='{{ url('assetImg/loader.gif') }}' height='50px'>
                <span class='text-nowrap text-warning'>Processing...</span>`},
        deferRender:true,
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
        // scrollX:true,
        ajax: {
            type: 'GET',
            url: '{{ route('getDataMonitoringPresensiAll')}}',
            data: function (d) {
                return $.extend({},d,{
                    'type' : remark_hadir,
                    'dyear': $('#dyear').val(),
                    'dmonth': $('#dmonth').val(),
                });
            }
        },
        columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: true, searchable: false },
        {data: 'name',name: 'name',searchable:true,visible:true,orderable:true},
        {data: 'credential_number',name: 'credential_number',searchable:true,visible:true,orderable:true},
        {data: 'device_kelas',name: 'device_kelas',searchable:true,visible:true,orderable:false},
        {data: 'checkindate',name: 'checkindate',searchable:true,visible:true,orderable:false},
        {data: 'timein',name: 'timein',searchable:true,visible:true,orderable:false},
        {data: 'timeout',name: 'timeout',searchable:true,visible:true,orderable:false},
        {data: 'remark',name: 'remark',searchable:true,visible:true,orderable:false},
        ]
    });
    
    var dtable = $('#log_monitoring_table').dataTable().api();
    });

    $('#dyear, #dmonth').on('change', function () {
        $('#log_monitoingr_table').DataTable().ajax.reload();
        var dmonth = $('#dmonth').val();
        var dyear = $('#dyear').val();

        if (dmonth === 'full') {
            $('#log-month').val('full'); 
            $('#log-year').val(dyear);
        } else {
            $('#log-month').val(dmonth);
            $('#log-year').val(dyear);
        }
    });
    
    $('#btnFiterSubmitSearch').click(function(){
         $('#log_monitoring_table').DataTable().draw(true);
    }); 
</script>
@endsection