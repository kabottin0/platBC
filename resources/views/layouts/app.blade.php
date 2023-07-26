<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- <title>{{ config('app.name', 'Dashboard') }}</title> --}}
        <title>Dashboard</title>
        <!-- Fonts -->
        <!--<link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">-->

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Custom fonts for this template-->
        
        <link href="/themes/sbAdmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="/themes/sbAdmin/css/sb-admin-2.min.css" rel="stylesheet">
        <script src="https://kit.fontawesome.com/e282c70904.js" crossorigin="anonymous"></script>
    </head>

    <style>
        .margin{
            margin: 24px;
        }
    </style>

   
    <body id="page-top">
        <div id="wrapper">
            @include('dashboard.template.sideBarDash')
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    @include('dashboard.template.topnav') 
                    
                    <!-- Page Content -->
                    <main>
                        @if (session()->has('message'))
                            <div class="alert alert-info">
                                {{session()->get('message')}}
                            </div>  
                        @endif
                        @yield('main')
                        
                    </main>
                    
                </div>
            </div>
        </div>
           
@include('dashboard.template.script')

    </body>
</html>
