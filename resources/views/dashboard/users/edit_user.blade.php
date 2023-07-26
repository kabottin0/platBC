@extends('layouts.app')
 @section('main')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center mb-4">
            <a href="{{ route('users.index') }}" class="m-4">
                <span class="icon text-gray-600">
                    <i class="fas fa-arrow-left"></i>
                </span>
            </a>
            <h1 class="h3 mb-0 text-gray-800">Aggiorna utente</h1>
        </div>
        {{{Form::open(array('route' => array('users.update', $user->id)))}}}
            @method('PATCH')
        <div class="container">
            {{Form::hidden('id', "$user->id")}}
            {{Form::label('Utente')}}
            {{Form::text('name', "$user->name", ['class' => 'form-control'])}}
            {{Form::label('Role')}}
            {{Form::select('user_role', array('user' => 'User', 'admin' => 'Admin'), $user->user_role, ['class' => 'form-control'])}}
            {{Form::label('Email')}}
            {{Form::text('email', "$user->email", ['class' => 'form-control'])}}
            {{-- {{Form::label('Password')}}
            {{Form::password('password', "$user->password", ['class' => 'form-control', 'placeholder' => 'Enter Password'])}} --}}
            <br>
            <div class="modal-footer flex-column border-top-0">
                {{Form::submit('Salva', ['class' => 'btn btn-primary'])}}
            </div>
        </div>
        {{{Form::close()}}}
    </div>

@endsection