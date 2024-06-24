@extends('layouts.app')
@section('enroll_device','active')
@section('showdroprn','show')
@section('showopenrn','nav-item-open')
@section('judulmenu','Enroll Device')

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
            @yield('judulmenu')
        </span>
        <div class="d-flex">
            <select name="monitoring" id="monitoring" class="form-select me-2">
                <option value="active" selected>Active</option>
                <option value="non-active">Non-Active</option>
            </select>
            <button id="btn_create" class="btn btn-outline-success fw-bold"><i class="ph-plus me-1"></i>Create</button>
        </div>
    </div>
    <div class="card-body">
        <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-basic table-condensed datatable-button-init-custom" width="100%" id="device_table">
                        <thead>
                            <tr class="bg-primary-300">
                                <th> No </th>
                                <th> De.Name </th>
                                <th> De.Kelas </th>
                                <th> De.UID </th>
                                <th> De.Date </th>
								<th> De.Mode </th>
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
@include('user.enroll_user.device._modal_enroll_device')
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
    
    $(document).ready(function () {
        $('#device_table').DataTable({
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
            url: '{{ route('getDataDevice')}}',
            data: function (d) {
                return $.extend({},d,{
                    
                });
            }
        },
        columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: true, searchable: false },
        {data: 'device_name',name: 'device_name',searchable:true,visible:true,orderable:true},
        {data: 'device_kelas',name: 'device_kelas',searchable:true,visible:true,orderable:true},
        {data: 'device_uid',name: 'device_uid',searchable:true,visible:true,orderable:false},
        {data: 'device_date',name: 'device_date',searchable:true,visible:true,orderable:false},
        {data: 'de_mode',name: 'de_mode',searchable:true,visible:true,orderable:false},
        {data: 'is_active',name: 'is_active',searchable:true,visible:true,orderable:false},
		{data: 'action',name: 'action',searchable:true,visible:true,orderable:false},
        ]
    });
    
    var dtable = $('#device_table').dataTable().api();
    });
    
    $('#btnFiterSubmitSearch').click(function(){
         $('#device_table').DataTable().draw(true);
    }); 

    $("#btn_create").click(function () {
        $('#modal_add_device').modal('show');
    });

</script>

{{-- Add Device--}}
<script>
    $('#form-add-device').submit(function(event){
        event.preventDefault();
        var form = $(this);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'post',
            url :  "{{ route('storeDevice') }}",
            data : new FormData(this),
            dataType:'JSON',
            contentType: false,
            async:false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $.blockUI({
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
                console.log(response);
                var datax = response.data;
                if(datax.status == '200')
                {   
                    alert(datax.status,datax.output);
                    $('#device_table').DataTable().draw(true);
                }else{
                    alert(datax.status,datax.output);
                }
                $.unblockUI();
                $('#modal_add_device').modal('hide'); 
            },
            error: function(response) {
                var datax = response.data;
                alert(datax.status,datax.output);
                $('#modal_add_device').modal('hide');
                $.unblockUI();
                }
            });
    });
</script>

{{-- Show Modal Edit --}}
<script>
    function edit_device(url)
        {
            $.ajax({
                type: 'get',
                url :  url,
                beforeSend: function () {
                    $.blockUI({
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
                    var datax = response.data;
                    // console.log(datax);
                    if(datax.status == 200)
                    {
                        $('#edt_de_id').val(datax.output.id);
                        $('#edt_de_name').val(datax.output.device_name);
                        $('#edt_de_kelas').val(datax.output.device_kelas);
                        
                        if (datax.output.device_mode === 0) {
                            document.getElementById("edt_de_mode0").checked = true; 
                            document.getElementById("edt_de_mode1").checked = false;
                        } else if (datax.output.device_mode === 1) {
                            document.getElementById("edt_de_mode0").checked = false;
                            document.getElementById("edt_de_mode1").checked = true; 
                        }

                       
                        if (datax.output.is_active === 0) {
                            document.getElementById("edt_de_active0").checked = true; 
                            document.getElementById("edt_de_active1").checked = false;
                        } else if (datax.output.is_active === 1) {
                            document.getElementById("edt_de_active0").checked = false;
                            document.getElementById("edt_de_active1").checked = true;
                        }

                        $('#modal_edit_device').modal('show');
                    }
                    $.unblockUI();
        
                },
                error: function(response) {
                    $.unblockUI();
                    
                }
            });  
        }
</script>

{{-- Store Value After Edit --}}
<script>
    $('#form-edit-device').submit(function(event){
        event.preventDefault();
        var form = $(this);
        var dataprod = new FormData(this)
        Swal.fire({
          buttonsStyling: false,
          customClass: {
            cancelButton: 'order-1 btn btn-light',
            denyButton: 'order-2 btn btn-light',
            confirmButton: 'order-3 ms-2 btn btn-primary',
            input: 'form-control'
          },
            icon: 'warning',
            title: 'Confirm',
            text: 'Do you want to Save the Changes?',
            showCancelButton: true,
            cancelButtonText: '<i class="ph-x-circle"></i> Cancel',
            confirmButtonText: '<i class="ph-check-circle"></i> Save',
        }).then((result) => {
          if (result.isConfirmed) {
            console.log(form.serialize());
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                url :  "{{ route('storeEditDevice') }}",
                data : dataprod,
                dataType:'JSON',
                contentType: false,
                async:false,
                cache: false,
                processData: false,
                beforeSend: function () {
                    $.blockUI({
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
                    var datax = response.data;
                    // console.log(datax.value);
                    if(datax.status == '200')
                    {   
                        alert(datax.status,datax.output);
                        $('#device_table').DataTable().draw(true);
                    }else{
                        alert(datax.status,datax.output);
                    }
                    $.unblockUI();
                    $('#modal_edit_device').modal('hide'); 
                },
                error: function(response) {
                   var datax = response.data;
                   alert(datax.status,datax.output);
                   $('#modal_edit_device').modal('hide');
                   $.unblockUI();
                }
            });
          }
        })
    });
</script>

{{-- Hapus device --}}
<script>
    function delete_device(url)
        {   
            Swal.fire({
            buttonsStyling: false,
            customClass: {
                cancelButton: 'order-1 btn btn-light',
                denyButton: 'order-2 btn btn-light',
                confirmButton: 'order-3 ms-2 btn btn-primary',
                input: 'form-control'
            },
                icon: 'warning',
                title: 'Confirm',
                text: 'Do you want to Delete device Item?',
                showCancelButton: true,
                cancelButtonText: '<i class="ph-x-circle"></i> Cancel',
                confirmButtonText: '<i class="ph-check-circle"></i> Save',
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                    $.ajax({
                    type: 'get',
                    url :  url,
                    beforeSend: function () {
                        $.blockUI({
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
                        var datax = response.data;
                        console.log(datax.output);
                        if(datax.status == 200)
                        {
                            alert(datax.status,datax.output);
                            $('#device_table').DataTable().draw(true);
                        }
                        else
                        {
                            alert(datax.status,datax.output);
                        }
                        $.unblockUI();
                    },
                    error: function(response) {
                        var datax = response.data;
                        alert(datax.status,datax.output);
                        $.unblockUI();
                    }
                }); 
            }
            }); 
        }
</script>

@endsection