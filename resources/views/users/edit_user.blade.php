@extends('template.base')
@extends('template.default')
@section('content')

{{{Form::open(array('route' => array('users.update', $user->id)))}}}
    @method('PATCH')
<div class="container">
    <a href="{{ URL::previous() }}" class="m-4">
        <span class="icon text-gray-600">
            <i class="fas fa-arrow-left"></i>
        </span>
    </a>
    <h2> Aggiorna utente </h2>
    {{Form::hidden('id', "$user->id")}}
    {{Form::label('Utente')}}
    {{Form::text('name', "$user->name", ['class' => 'form-control'])}}
    {{Form::label('Email')}}
    {{Form::text('email', "$user->email", ['class' => 'form-control'])}}
    {{-- {{Form::label('Password')}}
    {{Form::password('password', "$user->password", ['class' => 'form-control', 'placeholder' => 'Enter Password'])}} --}}
    <br>
    {{Form::submit('Aggiorna', ['class' => 'btn-btn-primary'])}}

</div>
{{{Form::close()}}}

@endsection