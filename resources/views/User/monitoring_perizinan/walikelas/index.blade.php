@extends('layouts.app')
@section('monitoring_perizinan','active')
@section('showdroprn','show')
@section('showopenrn','nav-item-open')
@section('judulmenu','Monitoring Perizinan Siswa')
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
    <div class="card-header d-flex justify-content-between">
        <span class="h5">
            Input Perizinan
        </span>
        <div class="d-flex">
            <select name="monitoring" id="monitoring" class="form-select me-2">
                <option value="outstanding" selected>Outstanding</option>
                <option value="closed">Closed</option>
                <option value="all">All</option>
            </select>
            <button id="btn_create" class="btn btn-outline-success fw-bold"><i class="ph-plus me-1"></i>Create</button>
        </div>
    </div>
    <div class="card-body">
        <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-basic table-condensed datatable-button-init-custom" width="100%" id="izin_table">
                        <thead>
                            <tr class="bg-primary-300">
                                <th> No </th>
                                <th> Kode </th>
                                <th> Created By </th>
                                <th> Type </th>
                                <th> Status </th>
                                <th> Action </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Start Modal --}}
@include('user.input_izin._modal_input_izin')
{{-- End Modal --}}
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
    
    var monitoring = $('#monitoring').val();
    
    $('#monitoring').on('change', function(){
        monitoring = $('#monitoring').find('option').filter(':selected').val();
        console.log(myvech);
        console.log(monitoring);
        $('#izin_table').DataTable().ajax.reload();
    });
    $(document).ready(function () {
        $('#izin_table').DataTable({
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
            url: '{{ route('getDataMonitoringPerizinan')}}',
            data: function (d) {
                return $.extend({},d,{
                    'type' : monitoring,
                });
            }
        },
        columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: true, searchable: false },
        {data: 'kode_izin',name: 'kode_izin',searchable:true,visible:true,orderable:true},
        {data: 'created_by',name: 'created_by',searchable:true,visible:true,orderable:true},
        {data: 'status_izin',name: 'status_izin',searchable:true,visible:true,orderable:false},
        {data: 'status_dokumen',name: 'status_dokumen',searchable:true,visible:true,orderable:false},
        {data: 'action',name: 'action',searchable:true,visible:true,orderable:false},
        ]
    });
    
    var dtable = $('#izin_table').dataTable().api();
    });
    
    $('#btnFiterSubmitSearch').click(function(){
         $('#izin_table').DataTable().draw(true);
    }); 

    $("#btn_create").click(function () {
        $('#modal_add_izin').modal('show');
    });
</script>

{{-- Auto Focus Select2 --}}
<script>
	$(document).on('select2:open', () => {
	    document.querySelector('.select2-search__field').focus();
 	});
</script>

{{-- Value Kelas & Walikelas modal --}}
<script>
    $(document).ready(function() {
        // Fetch data for modal and populate fields
        $('#modal_add_izin').on('show.bs.modal', function() {
            $.ajax({
                url: '{{ route("showAddIzinModal") }}',
                type: 'GET',
                success: function(response) {
                    $('#id_kelas').val(response.id_kelas);
                    $('#kelas').val(response.kelas);
                    $('#id_walikelas').val(response.id_walikelas);
                    $('#walikelas').val(response.walikelas_name);
                    
                    // Enable fields for input
                    $('#tgl_izin').prop('disabled', false);
                    $('#description').prop('disabled', false);
                    $('#file_attachment').prop('disabled', false);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching modal data:', error);
                    // Handle error, show alert, etc.
                }
            });
        });

        // reset form after closed
        $('#modal_add_izin').on('hidden.bs.modal', function() {
            $('#form-add-izin')[0].reset();

            // Reset hidden inputs
            $('#id_kelas').val('');
            $('#id_walikelas').val('');

            // Reset other fields if necessary
            $('#kelas').val('');
            $('#walikelas').val('');
            $('#tgl_izin').prop('disabled', true);
            $('#description').prop('disabled', true);
            $('#file_attachment').prop('disabled', true);
        });
    });
</script>

{{-- Validate File Size Create --}}
<script type="text/javascript">

    jQuery.validator.setDefaults({
      debug: true,
      success: "valid"
    });
    $( "#form-add-izin" ).validate({
      rules: {
        field: {
          extension: "xls|csv"
        }
      }
    });

    $('#file_attachment').on('change', function() {
        const size = 
           (this.files[0].size / 1024).toFixed(2);
      
        if (size > 500) {
            $("#output2").html('<b>' +
               'This file size is: ' + size + " KB" + '</b>');
            $("#output1").empty();
        } else {
            $("#output1").html('<b>' +
               'This file size is: ' + size + " KB" + '</b>');
            $("#output2").empty();
        }
    });
</script>

{{-- Submit Form Create --}}
<script>
    $('#form-add-izin').submit(function(event){
            event.preventDefault();
            var form = $(this);
            // console.log(form.serialize());
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                url :  "{{ route('storeCreateIzin') }}",
                data : new FormData(this),
                dataType:'JSON',
                contentType: false,
                async:false,
                cache: false,
                processData: false,
                beforeSend: function () {
                    $.blockUI({
                        theme: true,
                        baseZ: 2000,
                        message: '<i class="ph-spinner spinner"></i><br><span>Processing...</span>',
                        overlayCSS: {
                            backgroundColor: '#fff',
                            opacity: 0.8,
                            cursor: 'wait'
                        },
                        css: {
                            border: 0,
                            padding: 0,
                            backgroundColor: 'transparent'
                        }
                    });
                },
                success: function(response) {
                    var notif = response.data;
                    if(notif.status == '200')
                    {   
                        alert(notif.status,notif.output);
                        $('#izin_table').DataTable().draw(true);
                    }else{
                        alert(notif.status,notif.output);
                    }
                    $.unblockUI();
                    $('#modal_add_izin').modal('hide'); 
                },
                error: function(response) {
                   var notif = response.data;
                   alert(notif.status,notif.output);
                   $('#modal_add_izin').modal('hide');
                   $.unblockUI();
                }
            });
    });
</script>



@endsection
