@extends('layouts.app')  
@section('main')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center mb-4">
            <a href="{{ URL::previous() }}" class="m-4">
                <span class="icon text-gray-600">
                    <i class="fas fa-arrow-left"></i>
                </span>
            </a>
            <h1 class="h3 mb-0 text-gray-800">Inserisci nuovo utente</h1>
        </div>
        {{{Form::open(array('route' => 'users.store'))}}}
        <div class="container">
            
            {{Form::label('Utente')}}
            {{Form::text('name', "", ['required', 'class' => 'form-control'])}}
            {{Form::label('Email')}}
            {{Form::text('email', "",['required', 'class' => 'form-control'])}}
            {{Form::label('Role')}}
            {{Form::select('user_role',array('user' => 'User', 'admin' => 'Admin'),'User', ['class' => 'form-control'])}}
            {{Form::label('Password')}}
            {{Form::password('password', ['required', 'class' => 'form-control', 'placeholder' => 'Enter Password'])}}
            <br>
            <div class="modal-footer flex-column border-top-0">
            {{Form::submit('Salva', ['class' => 'btn btn-primary'])}}
            </div>
        </div>
        {{{Form::close()}}}

    </div>
@endsection

