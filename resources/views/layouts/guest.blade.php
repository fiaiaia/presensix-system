<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        {{-- @vite([ 'resources/js/app.js','resources/sass/app.scss']) --}}

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	
        <!-- Global stylesheets -->
        <link href="{{ url('bs5eticket/template/assets/fonts/inter/inter.css')}}" rel="stylesheet" type="text/css">
        <link href="{{ url('bs5eticket/template/assets/icons/phosphor/styles.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{ url('bs5eticket/template/html/layout_2/full/assets/css/ltr/all.min.css')}}" id="stylesheet" rel="stylesheet" type="text/css">
        <!-- /global stylesheets -->
    
        <!-- Core JS files -->
        <script src="{{ url('bs5eticket/template/assets/demo/demo_configurator.js')}}"></script>
        <script src="{{ url('bs5eticket/template/assets/js/bootstrap/bootstrap.bundle.min.js')}}"></script>
        <!-- /core JS files -->
    
        <!-- Theme JS files -->
        <script src="{{ url('bs5eticket/template/html/layout_2/full/assets/js/app.js')}}"></script>
        <!-- /theme JS files -->
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
