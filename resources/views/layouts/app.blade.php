<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Presensix - @yield('judulmenu')</title>
        <link rel="shortcut icon" href="{{ url('assetImg/logo-judul.png') }}" type="image/x-icon">

        <!-- Scripts -->
        {{-- @vite(['resources/assets/sass/app.scss', 'resources/assets/js/app.js'])  --}}

        <!-- Global stylesheets -->
        <link href="{{ url('bs5eticket/template/assets/fonts/inter/inter.css')}}" rel="stylesheet" type="text/css">
        <link href="{{ url('bs5eticket/template/assets/icons/phosphor/styles.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{ url('bs5eticket/template/assets/icons/fontawesome/styles.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{ url('bs5eticket/template/html/layout_2/full/assets/css/ltr/all.min.css')}}" id="stylesheet" rel="stylesheet" type="text/css">
        <!-- Global stylesheets -->

        @yield('style')
        {{-- OLD CSS --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/linkifyjs@4.1.1/dist/linkify.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/linkify-html@4.1.1/dist/linkify-html.min.js"></script>
        <script type="text/javascript" src="{{url('assets/js/plugins/forms/selects/select2.min.js')}}"></script>
        <link href="{{url('https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{url('https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css')}}" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="{{url('bs5/js/jqueryvalidate.js')}}"></script>
        <script type="text/javascript" src="{{url('bs5/js/jqueryvalidateextend.js')}}"></script>
        {{-- OLD CSS --}}
        
        <!-- Core JS files -->
        <script src="{{ url('bs5eticket/template/assets/demo/demo_configurator.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <!-- Core JS files -->
        
        <!-- Theme JS files -->
        <script src="{{ url('bs5eticket/template/assets/js/vendor/forms/selects/bootstrap_multiselect.js')}}"></script>
        <script src="{{ url('bs5eticket/template/assets/js/vendor/notifications/sweet_alert.min.js')}}"></script>
        <script src="{{ url('bs5eticket/template/assets/demo/pages/extra_sweetalert.js')}}"></script>
        <script src="{{ url('bs5eticket/template/assets/js/vendor/visualization/d3/d3.min.js')}}"></script>
        <script src="{{ url('bs5eticket/template/assets/js/vendor/visualization/d3/d3_tooltip.js')}}"></script>
        <script src="{{ url('bs5eticket/template/assets/js/vendor/visualization/echarts/echarts.min.js')}}"></script>
        
        <script src="{{ url('bs5eticket/template/html/layout_2/full/assets/js/app.js')}}"></script>
        <script src="{{ url('bs5eticket/template/assets/demo/pages/dashboard.js')}}"></script>
        <!-- Theme JS files -->

        {{-- OLD JS --}}
        <script type="text/javascript" src="{{url('assets/js/plugins/loaders/blockui.min.js')}}"></script>    
        <script type="text/javascript" src="{{url('assets/js/plugins/forms/selects/select2.min.js')}}"></script>
        <script type="text/javascript" src="{{url('assets/js/pages/form_select2.js')}}"></script>
        <script type="text/javascript" src="{{url('assets/js/core/libraries/jquery_ui/interactions.min.js')}}"></script>
        <script src="{{url('bs5eticket/template/assets/js/vendor/tables/datatables/datatables.min.js')}}"></script>
        <script type="text/javascript" src="{{url('assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
        <script type="text/javascript" src="{{url('bs5/js/date.js')}}"></script>
        <script type="text/javascript" src="{{url('bs5/js/htmlson.js')}}"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
        {{-- OLD JS --}}

        {{-- JS Input Fingger --}}
        {{-- <script type="text/javascript" src="{{url('assets/js/fingger/bootboox.all.js')}}"></script> 
        <script type="text/javascript" src="{{url('assets/js/fingger/bootboox.all.min.js')}}"></script> 
        <script type="text/javascript" src="{{url('assets/js/fingger/bootboox.js')}}"></script> 
        <script type="text/javascript" src="{{url('assets/js/fingger/bootboox.locales.js')}}"></script> 
        <script type="text/javascript" src="{{url('assets/js/fingger/bootboox.locales.min.js')}}"></script> 
        <script type="text/javascript" src="{{url('assets/js/fingger/bootboox.min.js')}}"></script> 
        <script type="text/javascript" src="{{url('assets/js/fingger/dev_config.js')}}"></script> 
        <script type="text/javascript" src="{{url('assets/js/fingger/manage_user.js')}}"></script> 
        <script type="text/javascript" src="{{url('assets/js/fingger/user_log.js')}}"></script>  --}}
        {{-- JS Input Fingger --}}

        {{-- CSS Input Finger --}}
        {{-- <link href="{{ url('assets/css/fingger/device.css')}}" rel="stylesheet" type="text/css">
        <link href="{{ url('assets/css/fingger/manageusers.css')}}" rel="stylesheet" type="text/css">
        <link href="{{ url('assets/css/fingger/User.css')}}" rel="stylesheet" type="text/css">
        <link href="{{ url('assets/css/fingger/userlog.css')}}" rel="stylesheet" type="text/css"> --}}
        {{-- CSS Input Finger --}}

        <style>
            .bg-fabric{
                background-image: url('{{ url("assetImg/fabric.webp")}}');
                background-repeat: no-repeat;
                background-size: cover;
                  background-position: right;
            }
            .delete-trash{
                opacity: 0;
                transition: ease-in-out 0.2s;
            }
            .media-chat-message:hover .delete-trash{
                opacity: 1;
                transition: ease-in-out 0.2s;
                z-index: 100;
            }
            .rotated { 
                -webkit-transform: rotateZ(90deg);
                -moz-transform: rotateZ(90deg);
                -o-transform: rotateZ(90deg);
                -ms-transform: rotateZ(90deg);
                transform: rotateZ(90deg);
                margin-bottom: 15px;
                transition: 0.2s ease-in-out;
            }
            .norotated{
                transition: 0.2s ease-in-out;
            }
            .hoverbtn:hover{
                box-shadow: 3px 3px 3px rgba(75, 75, 75, 0.3);
                transform: scale(1.05);
                transition: 0.21s ease-in-out;
            }
            .bg-hover:hover{
                background-color: rgba(223, 193, 58, 0.623);
            }
            .pall{
                padding: 10px !important;
            }
            .bg-shadow-sm{
                box-shadow: 4px 4px 4px -2px rgba(0,0,0,0.44);
                -webkit-box-shadow: 4px 4px 4px -2px rgba(0,0,0,0.44);
                -moz-box-shadow: 4px 4px 4px -2px rgba(0,0,0,0.44);
            }
        </style>
        
        <script type="text/javascript">
            function alert(code,text) {
                if (code==200) {
                    Swal.fire({
                      icon: 'success',
                      title: 'Good Job . . .',
                      text: text,
                      showConfirmButton: false,
                      timer: 1500,
                      width: '50rem'
                    });
                 }else if (code==402) {
                    Swal.fire({
                      icon: 'warning',
                      title: 'Sorry . . .',
                      text: text,
                      showConfirmButton: false,
                      timer: 2000,
                      width: '50rem'
                    });
                 }else if (code==422){
                    Swal.fire({
                      icon: 'error',
                      title: 'Oopsss . . .',
                      text: text,
                      showConfirmButton: true,
                      width: '50rem'
                    });
                 }else if (code==500){
                    Swal.fire({
                      icon: 'error',
                      title: 'Oopsss . . .',
                      text: text,
                      showConfirmButton: true,
                      width: '50rem'
                    });
                 }else if (code==404){
                    Swal.fire({
                      buttonsStyling: false,
                      customClass: {
                        confirmButton: 'btn btn-primary',
                        cancelButton: 'btn btn-light',
                        denyButton: 'btn btn-light',
                        input: 'form-control'
                      },
                      icon: 'error',
                      title: 'Sorry',
                      text: text,
                      showConfirmButton: true,
                      width: '50rem',
                      confirmButtonText: '<i class="ph-check-circle"></i> OK',
                    });
                 }
    
            }
    
            function loading(){
                $.blockUI({ 
                    message: '<i class="ph-spinner spinner"></i><br><span>Processing...</span>',
                    overlayCSS: {
                        backgroundColor: '#1b2024',
                        opacity: 0.8,
                        cursor: 'wait'
                    },
                    css: {
                        border: 0,
                        color: '#fff',
                        padding: 0,
                        backgroundColor: 'transparent'
                    }
                });
            }
        </script>
    </head>

    <body>
        <!-- Page content -->
        <div class="page-content">
    
            <!-- Main sidebar -->
            <div class="sidebar sidebar-dark sidebar-main sidebar-expand-lg">
    
                <!-- Sidebar header -->
                <div class="sidebar-section bg-black bg-opacity-10 border-bottom border-bottom-white border-opacity-10">
                    <div class="sidebar-logo d-flex justify-content-center align-items-center">
                        <a href="{{ route('home') }}" class="d-inline-flex align-items-center py-1">
                            <img src="{{ url('assetImg/logo-apk3.png') }}" height="45" alt="">
                            <img src="{{ url('assetImg/logo-apk2.png') }}" height="45" alt="" class="sidebar-resize-hide" style="margin-left: -39px !important">
                            <!-- <img src="../../../assets/images/logo_text_light.svg" class="sidebar-resize-hide ms-3" height="14" alt=""> -->
                        </a>

                        <div class="sidebar-resize-hide ms-auto">
                            <button id="sidebarcontrol" type="button" class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-control sidebar-main-resize d-none d-lg-inline-flex">
                                <i class="ph-arrows-left-right"></i>
                            </button>

                            <button type="button" class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-mobile-main-toggle d-lg-none">
                                <i class="ph-x"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- /sidebar header -->
    
    
                <!-- Sidebar content -->
                <div class="sidebar-content">
    
                    <!-- Customers -->
                    <div class="p-2">
                        <div class="rounded bg-fabric text-white text-center py-2">
                            <div id="school_name">
                                <span class="h4 text-nowrap"><b> SMANSIX </b></span>
                            </div>
                        </div>
                    </div>
                    <!-- /customers -->
    
    
                    <!-- Main navigation -->
                    <div class="sidebar-section">
                        <ul class="nav nav-sidebar" data-nav-type="accordion">
                            @include('layouts.menu')
                        </ul>
                    </div>
                    <!-- /main navigation -->
    
                </div>
            </div>
            <!-- /main sidebar -->
    
    
            <!-- Main content -->
            <div class="content-wrapper">
    
                <!-- Main navbar -->
                <div class="navbar navbar-expand-lg navbar-static shadow">
                    <div class="container-fluid">
                        <div class="d-flex d-lg-none me-2">
                            <button type="button" class="navbar-toggler sidebar-mobile-main-toggle rounded-pill">
                                <i class="ph-list"></i>
                            </button>
                        </div>

                        {{-- Lonceng Notif --}}
                        {{-- <ul class="nav flex-row">
                            <li class="nav-item d-lg-none">
                                <a href="#navbar_search" class="navbar-nav-link navbar-nav-link-icon rounded-pill" data-bs-toggle="collapse">
                                    <i class="ph-magnifying-glass"></i>
                                </a>
                            </li>
            
                            <li class="nav-item nav-item-dropdown-lg dropdown ms-lg-2">
                                <a href="#" class="navbar-nav-link navbar-nav-link-icon rounded-pill border shake" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                    <i class="ph-bell"></i>
                                    <span id="countchat" class="badge bg-yellow text-black position-absolute top-0 end-0 translate-middle-top zindex-1 rounded-pill mt-1 me-1">
                                    </span>
                                </a>
                                <div class="dropdown-menu wmin-lg-400 p-0">
                                    <div class="d-flex align-items-center p-3">
                                        <h6 class="mb-0">Notification</h6>
                                    </div>
                                    <div class="dropdown-menu-scrollable pb-2" style="--dropdown-scrollable-max-height: 34rem !important;" id="content_notif">
                                    </div>
                                </div>
                            </li>
                        </ul> --}}
                        {{-- Lonceng Notif --}}

                        <div class="navbar-collapse flex-lg-1 order-2 order-lg-1 collapse" id="navbar_search">
                            <div class="navbar-search flex-fill dropdown mt-2 mt-lg-0">
                                <div class="position-static">
                                </div>
                            </div>
                        </div>
    
                        <ul class="nav hstack gap-sm-1 flex-row justify-content-end order-1 order-lg-2">
                            <li class="nav-item nav-item-dropdown-lg dropdown">
                                <a href="#" class="navbar-nav-link align-items-center rounded-pill p-1" data-bs-toggle="dropdown">
                                    <div class="status-indicator-container" style="pointer-events: auto;pointer-events: none;">
                                        @if(auth()->user()->el_profile)
                                             <img src="{{ auth()->user()->el_profile->profile }}" class="rounded-pill" style="weight: 42px;height: 42px;background-color: #fb8b3b;border: 1px solid black;">
                                        @else
                                            <img src="{{ url('assetImg/user.png')}}" class="rounded-pill" alt="" style="weight: 42px;height: 42px;">
                                         @endif
                                        <span class="status-indicator bg-success"></span>
                                    </div>
                                    @if(auth()->check())
                                        <span class="d-none d-lg-inline-block mx-lg-2">
                                            <b>{{ strtoupper(auth()->user()->name) }}</b><br>
                                            <?php $cek = 0; ?>
                                            @foreach(auth()->user()->roles as $data)
                                                @if($cek > 0)
                                                    <i>&</i>
                                                @endif
                                                <small><i>{{ ucwords($data->display_name) }}</i></small>
                                                <?php $cek++; ?>
                                            @endforeach
                                        </span>
                                    @endif
                                </a>
    
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="{{ route('changeProfile') }}" class="dropdown-item">
                                        <i class="ph-key me-2"></i>
                                        Change Password & Email
                                    </a>
                                    <a href="route('logout')" class="dropdown-item" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                        <i class="ph-sign-out me-2"></i>
                                        Logout
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /main navbar -->
    
    
                <!-- Inner content -->
                <div class="content-inner">
    
                    <div class="my-xs-5">
                        <br>
                    </div>
    
                    <!-- Content area -->
                    <div class="content pt-0">
                        @yield('content')
                    </div>
                </div>
                <!-- /inner content -->
            </div>
            <!-- /main content -->
    
        </div>
        <!-- /page content -->

    @yield('modal')
    @yield('js')

    <script>
        var current = 0;
        var checkContents;

        $("#sidebarcontrol").click(function(){
            clearInterval(checkContents);

            if(current % 2 == 0){
                $("#school_name").removeClass('norotated').addClass('rotated mb-5');
                checkContents = setInterval(function(){
                    if($('.sidebar-main-unfold').length > 0){
                        $("#school_name").removeClass('mb-5 rotated').addClass('norotated mt-2');
                        if(current > 0){
                            $("#school_name").removeClass('mt-2');
                        }
                    } else {
                        $("#school_name").removeClass('mt-2').addClass('mb-5 rotated');
                    }
                }, 500);
            } else {
                $("#school_name").removeClass('rotated mb-5').addClass('norotated');
            }

            current++;
        });
    </script>
    
    </body>
</html>
