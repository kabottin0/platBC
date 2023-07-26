@extends('layouts.app') 
@section('main')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center mb-4">
        <a href="{{ URL::previous() }}" class="m-4">
            <span class="icon text-gray-600">
                <i class="fas fa-arrow-left"></i>
            </span>
        </a>
        <h1 class="h3 mb-0 text-gray-800">Inserisci nuovo Flusso</h1>
    </div>
    <form  method="POST" action="{{route('flow.store')}}">
        @csrf
        <div class="modal-body py-0">
            <label for="label" class="form-label"> Nome del flusso </label>
            <input class="form-control" name= "name" id="label" required>
        </div>
        <div class="modal-body py-0">
            <label class="form-label" for="value"> Messaggio iniziale </label>
                <input type="text" class="form-control" name="message" id="value" required>
        </div>

        <div class="modal-footer flex-column border-top-0">
            <button  class="btn btn-primary">Inserisci Flusso</button>
            
        </div>
    </form>    
</div>
@endsection

