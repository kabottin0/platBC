@extends('template.base')
@extends('template.default')
@section('content')

{{{Form::open(array('route' => 'users.store'))}}}
<div class="container">
    <h2> Inserisci nuovo utente </h2>
    {{Form::label('Utente')}}
    {{Form::text('name', "", ['class' => 'form-control'])}}
    {{Form::label('Email')}}
    {{Form::text('email', "", ['class' => 'form-control'])}}
    {{Form::label('Password')}}
    {{Form::password('password', ['class' => 'form-control', 'placeholder' => 'Enter Password'])}}
    
    <br>
    {{Form::submit('Salva', ['class' => 'btn-btn-primary'])}}

</div>
{{{Form::close()}}}






@endsection