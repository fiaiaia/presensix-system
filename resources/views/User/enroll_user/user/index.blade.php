@extends('layouts.app')
@section('enroll_user','active')
@section('judulmenu','Enrollment New User')
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
            <table class="table table-hovered table-striped table-condensed" id="enroll_table">
                <thead>
                    <tr class="bg-primary-300">
                        <th> No </th>
                        <th> NIP / NISN </th>
                        <th> Nama </th>
                        <th> Kelas </th>
                        <th> Posisi </th>
                        <th> Birthday </th>
                        <th> Status </th>
                        <th> Sidik Jari </th>
                        <th> Action </th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

{{-- Start Modal --}}
@include('user.enroll_user.user._modal_enroll')
{{-- End Modal --}}
@endsection

@section('js')
{{-- Datatable --}}
<script type="text/javascript">
    $(document).ready(function () {
        $('#enroll_table').DataTable({
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
                url: '{{ route('getDataEnroll')}}',
                data: function (d) {
                    return $.extend({}, d);
                }
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: true, searchable: false, width: '40px' },
                {data: 'credential_number', name: 'credential_number', searchable: true, visible: true, orderable: true, width: '100px' },
                {data: 'name', name: 'name', searchable: true, visible: true, orderable: true, width: '150px' },
                {data: 'class', name: 'class', searchable: true, visible: true, orderable: false, width: '100px' },
                {data: 'position', name: 'position', searchable: true, visible: true, orderable: false, width: '100px' },
                {data: 'birthdate', name: 'birthdate', searchable: true, visible: true, orderable: false, width: '120px' },
                {data: 'status', name: 'status', searchable: true, visible: true, orderable: false, width: '100px' },
                {data: 'sidik_jari', name: 'sidik_jari', searchable: true, visible: true, orderable: false, width: '100px' },
                {data: 'action', name: 'action', searchable: true, visible: true, orderable: false, width: '100px' },
            ]
        });

        var dtable = $('#enroll_table').dataTable().api();
    });

    $('#btnFiterSubmitSearch').click(function(){
         $('#enroll_table').DataTable().draw(true);
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

{{-- Select Kelas --}}
<script>
    $('#select_kelas').select2({
        placeholder: 'Pilih Kelas',
        dropdownParent: $('#modal_add_siswa'),
        allowClear: true,
        ajax: {
            url: "{{ route('selectGetKelas') }}",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    search: params.term
                };
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: `${item.device_kelas}`,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });
</script>

{{-- Get Lastest Finger ID --}}
<script type="text/javascript">
    $(document).ready(function() {
        $('#modal_add_siswa').on('show.bs.modal', function (e) {
            $.ajax({
                url: "{{ route('getFingerID') }}",
                type: 'GET',
                success: function(response) {
                    if (response.max_id !== null) {
                        var newId = response.max_id + 1;
                        $('#id_finger_auto').val(newId);
                        $('#id_finger_auto_hidden').val(newId);
                    } else {
                        $('#id_finger_auto').val(1); 
                        $('#id_finger_auto_hidden').val(1);
                    }
                }
            });
        });
    });
</script>

{{-- Scan Finggerprint --}}
<script>
    function add_finger(url) {
        $('#modal_add_fingerprint').modal('show'); 
        var intervalId;
        var startTime = new Date().getTime();
        var checkInterval = 9000; 

        function checkStatus() {
            $.ajax({
                type: 'get',
                url: url,
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
                    if (datax.status == 200) {
                        if (datax.output.add_fingerid == '0') {
                            alert(200, 'Data berhasil direkam!');
                            $('#enroll_table').DataTable().draw(true);
                            $('#modal_add_fingerprint').modal('hide'); 
                            console.log('Fingerprint ID:', datax.fingerprint_id);
                            clearInterval(intervalId); 
                            $.unblockUI();
                        } else {
                            // setTimeout(function() {
                            //     alert(500, 'Gagal mendapatkan data!');
                            // }, 3000);
                        }
                    }
                },
                error: function(response) {
                    $.unblockUI();
                }
            });
        }

        intervalId = setInterval(function() {
            var currentTime = new Date().getTime();
            if (currentTime - startTime >= 30000) {
                clearInterval(intervalId);
                $('#modal_add_fingerprint').modal('hide'); 
                alert(402, 'Cek Alat Perekam Sidik Jari!');
                $.unblockUI();
            } else {
                checkStatus();
            }
        }, checkInterval);

        checkStatus();

        $('#close_button_fg').on('click', function () {
            clearInterval(intervalId);
            $.unblockUI();
        });
    }
</script>

{{-- Validate Number Telephone --}}
<script>
    function validateInput() {
        const noTelpSiswa = document.getElementById('no_telp_siswa').value;
        const noTelpOrtu = document.getElementById('no_telp_ortu').value;
    
        if (noTelpSiswa.startsWith('0')) {
            alert(402,"Isikan sesuai format nomor!");
            document.getElementById('no_telp_siswa').value = '';
        }
    
        if (noTelpOrtu.startsWith('0')) {
            alert(402,"Isikan sesuai format nomor!");
            document.getElementById('no_telp_ortu').value = '';
        }
    }
    
    document.getElementById('no_telp_siswa').addEventListener('keyup', validateInput);
    document.getElementById('no_telp_ortu').addEventListener('keyup', validateInput);
</script>
    
{{-- Submit New Student --}}
<script>
    $('#form-add-user-siswa').submit(function(event){
        event.preventDefault();
        var form = $(this);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'post',
            url :  "{{ route('storeNewStudents') }}",
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
                    $('#enroll_table').DataTable().draw(true);
                }else{
                    alert(datax.status,datax.output);
                }
                $.unblockUI();
                $('#modal_add_siswa').modal('hide'); 
            },
            error: function(response) {
                var datax = response.data;
                alert(datax.status,datax.output);
                $('#modal_add_siswa').modal('hide');
                $.unblockUI();
                }
            });
    });
</script>

{{-- Submit New Tendik --}}
<script>
    $('#form-add-user-tendik').submit(function(event){
        event.preventDefault();
        var form = $(this);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'post',
            url :  "{{ route('storeNewTendik') }}",
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
                    $('#enroll_table').DataTable().draw(true);
                }else{
                    alert(datax.status,datax.output);
                }
                $.unblockUI();
                $('#modal_add_tendik').modal('hide'); 
            },
            error: function(response) {
                var datax = response.data;
                alert(datax.status,datax.output);
                $('#modal_add_tendik').modal('hide');
                $.unblockUI();
                }
            });
    });
</script>

@endsection