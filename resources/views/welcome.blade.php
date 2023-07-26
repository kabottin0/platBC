@extends('template.base')

@section('content')



@endsection



@yield('content')
{{$slot ?? ''}}