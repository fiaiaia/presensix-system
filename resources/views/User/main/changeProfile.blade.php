@extends('layouts.app')
@section('judulmenu','Change Password')
@section('content')

<style>
    #avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        overflow: hidden;
        border: 3px solid black;
    }

    #avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    #loading {
        display: none;
    }
</style>

<div class="row">
    <div class="col-lg-2 col-12 p-2 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-header">
                <span class="h5">Change Avatar</span>
            </div>
            <div class="card-body text-center">
                <br><br><br>
                <form id="uploadAvatar" action="#" enctype="multipart/form-data" method="post"
                    style="margin-bottom: 5px;">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" id="avatarData" name="avatarData">
                    <div style="position: relative;height: 150px;" class="d-flex justify-content-center mt-3">

                        <div
                            style="position: absolute;border-radius: 50%;top: 2px; z-index: 5; padding: 20px 15px; height: 116px; width: 128px;">
                            <a id="generateButton"
                                style="margin-bottom: 5px;position: absolute;left: 0px;top: 0px;  padding: 5px 5px;border: 3px solid black;"
                                class="btn btn-light rounded-circle"><i id="dice"
                                    class="ph ph-dice-three text-dark"></i></a>
                        </div>
                        <img src="{{ url('assetImg/logo-p-remove.png') }}" height="116px" width="116px" style="position: absolute;border-radius: 50%;top: 2px; z-index: 0;
                                         background-color: #fb8b3b; padding: 10px 15px;">
                        <div
                            style="position: absolute;border-radius: 50%;top: 2px; z-index: 1;
                                       background-color: #fb8b3b; padding: 20px 15px; height: 116px; width: 116px;opacity: 0.5">
                        </div>
                        <div id="avatar"
                            style="position: absolute; z-index: 2;pointer-events: auto;pointer-events: none;"></div>
                        <img id="loading" src="https://i.gifer.com/ZlXo.gif" height="116px" width="116px" alt="Loading"
                            style="position: absolute;border-radius: 50%;top: 2.03px; z-index: 3;border: 1px solid black;">
                        @if(auth()->user()->el_profile)
                        <img id="profile" src="{{ auth()->user()->el_profile->profile }}" height="116px" width="116px"
                            alt="Loading" style="position: absolute;border-radius: 50%;top: 1px; z-index: 4;">
                        @endif
                    </div>
                    <button id="submitButton" class="btn btn-warning" type="submit" disabled><i
                            class="ph ph-user-circle-plus"></i>&nbsp; Update</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-5 col-12 p-2 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-header">
                <span class="h5">Change Password</span>
            </div>
            <div class="card-body">
                <div class="panel-body tab-pane active" id="ss">
                    <form action="#" id="form-change-password" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row mb-3">
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label>Name:</label>
                                    <input type="text" class="form-control"
                                        style="font-weight: bold; background-color:rgb(238, 238, 238);"
                                        value="{{ auth()->user()->name }}" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label>NISN/NIP:</label>
                                    <input type="text" class="form-control"
                                        style="font-weight: bold; background-color:rgb(238, 238, 238);"
                                        value="{{ auth()->user()->credential_number }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label>New Password:</label>
                            <input type="password" class="form-control" id="newpassword" name="newpassword">
                        </div>
                        <div class="form-group mb-3">
                            <label>Confirm Password:</label>
                            <input type="password" class="form-control" id="confirmpassword" name="confirmpassword">
                        </div>
                        <br>
                        <div class="text-center mb-3">
                            <button class="btn btn-warning" type="submit">Save Change</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-5 col-12 p-2 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-header">
                <span class="h5">Change Email</span>
            </div>
            <div class="card-body">
                <div class="panel-body tab-pane active" id="ss">
                    <form action="#" id="form-change-email" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row mb-3">
                            <div class="col-lg-12 col-12">
                                <div class="form-group">
                                    <label>Current Email:</label>
                                    <input type="text" id="email_auth" class="form-control"
                                        style="font-weight: bold; background-color:rgb(238, 238, 238);"
                                        value="{{ auth()->user()->email }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label>New Email:</label>
                            <input autocomplete="off" onPaste="return false" onCopy="return false" type="email"
                                id="newemail" class="form-control" name="newemail">
                        </div>
                        <div class="form-group mb-3">
                            <label>Confirm Email:</label>
                            <input autocomplete="off" onPaste="return false" onCopy="return false" type="email"
                                id="confirmemail" class="form-control" name="confirmemail">
                        </div>
                        <br>
                        <div class="text-center mb-3">
                            <button class="btn btn-warning" type="submit">Save Change</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

{{-- <script>
    // Change Password
    $('#form-change-password').submit(function (event) {
        event.preventDefault();
        var form = $(this);
        var datapass = new FormData(this)
        Swal.fire({
            icon: 'info',
            text: 'Do you want to save the Changes Password?',
            title: 'Confirm',
            showCancelButton: true,
            confirmButtonText: 'Save',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'post',
                    url: "{{ route('changePasswordStore') }}",
                    data: datapass,
                    dataType: 'JSON',
                    contentType: false,
                    async: false,
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
                    success: function (response) {
                        var notif = response.data;
                        if (notif.status == '200') {
                            $('#confirmpassword').val('');
                            $('#newpassword').val('');
                            $('#password').val('');
                            alert(notif.status, notif.output);
                        } else {
                            alert(notif.status, notif.output);
                        }
                        $.unblockUI();
                    },
                    error: function (response) {
                        var notif = response.data;
                        alert(notif.status, notif.output);
                        $.unblockUI();
                    }
                });
            }
        })
    });

    // Change Email
    $('#form-change-email').submit(function (event) {
        event.preventDefault();
        var form = $(this);
        var datapass = new FormData(this)
        Swal.fire({
            icon: 'info',
            text: 'Do you want to save the Changes Password?',
            title: 'Confirm',
            showCancelButton: true,
            confirmButtonText: 'Save',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'post',
                    url: "{{ route('changeEmailStore') }}",
                    data: datapass,
                    dataType: 'JSON',
                    contentType: false,
                    async: false,
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
                    success: function (response) {
                        var notif = response.data;
                        var email = response.data.email;

                        if (notif.status == '200') {
                            $('#confirmemail').val('');
                            $('#newemail').val('');
                            $('#email_auth').val(email);
                            alert(notif.status, notif.output);
                        } else {
                            alert(notif.status, notif.output);
                        }
                        $.unblockUI();
                    },
                    error: function (response) {
                        var notif = response.data;
                        alert(notif.status, notif.output);
                        $.unblockUI();
                    }
                });
            }
        })
    });
</script> --}}

<script>
    // CHANGE AVATAR
    $(document).ready(function () {
        $('#generateButton').click(function () {
            $('#profile').hide();
            generateRandomSeed();
            $('#dice').addClass('spinner');
        });

        $('#uploadAvatar').submit(function (e) {
            e.preventDefault();

            var avatarData = $('#avatarData').val();

            var form = $(this);
            var datapass = new FormData(this)

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                url: "{{ route('updateProfile') }}",
                dataType: 'JSON',
                data: datapass,
                contentType: false,
                async: false,
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
                success: function (response) {
                    var datax = response.data;
                    if (datax.status == 200) {
                        $.unblockUI();
                        alert(datax.status, datax.output);
                        setTimeout(location.reload.bind(location), 600);
                    } else {
                        alert(datax.status, datax.output);
                    }
                    $.unblockUI();
                },
                error: function (response) {
                    var datax = response.data;
                    alert(datax.status, datax.output);
                    $.unblockUI();
                }
            });
        });

        function convertImageToBase64(url, callback) {
            var canvas = document.createElement('canvas');
            var ctx = canvas.getContext('2d');
            var image = new Image();
            image.crossOrigin = 'Anonymous';

            image.onload = function () {
                canvas.width = image.width;
                canvas.height = image.height;
                ctx.drawImage(image, 0, 0);
                var base64Data = canvas.toDataURL('image/png');

                callback(base64Data);
            };

            image.src = url;
        }

        function generateRandomSeed() {
            $('#loading').show();

            var randomSeed = Math.random().toString(36).substring(7);

            var randomFlip = Math.random() < 0.5 ? 'true' : 'false';

            var img = new Image();
            img.onload = function () {
                $('#loading').hide();
                $('#dice').removeClass('spinner');
                $('#submitButton').prop('disabled', false);
            };
            img.src = 'https://api.dicebear.com/6.x/notionists/svg?seed=' + randomSeed + '&flip=' + randomFlip;
            img.id = 'dzikri';
            $('#avatar').empty();

            $('#avatar').append(img);
            convertImageToBase64(img.src, function (base64Data) {
                $('#avatarData').val(base64Data);
            });
        }
    });
</script>

@endsection