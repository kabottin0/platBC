@extends('dashboard.template.top')

@if (session()->has('message'))
  <div class="alert alert-info">
    {{session()->get('message')}}
  </div>  
@endif

<body id="page-top">

    <div id="wrapper">
        @include('dashboard.template.sideBarDash')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
            @include('dashboard.template.topnav')  
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Inserire nome pagina</h1>
                    </div>
                </div>

            </div>
            @include('dashboard.template.footer') 
        </div> 
         
    </div>


@include('dashboard.template.script')
</body>