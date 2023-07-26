 @extends('layouts.app')
 @section('main')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center mb-5">
        <a href="{{route('flow.index')}}" class="m-4">
            <span class="icon text-gray-600">
                <i class="fas fa-arrow-left"></i>
            </span>
            </a>
        <h1 class="h3 mb-0 text-gray-800">Aggiorna Flusso: {{$flow->id}}</h1>
    </div>
    <form  method="POST" action="{{route('flow.update', ['flow' => $flow->id])}}">
        @method('PATCH')
        @csrf
        <div class="modal-body py-0">
            <label for="label" class="form-label"> Nome flusso </label>
            <input class="form-control" name= "name" id="name" value="{{$flow->name}}">
        </div>
        <div class="modal-body py-0">
            <label for="type" class="form-label"> Messaggio </label>
            <input class="form-control" name="message" value="{{$flow->message}}">
        </div>
        <div class="modal-footer flex-column border-top-0">
            <button  class="btn btn-primary">Aggiorna Flusso</button>
           
        </div>
    </form>    
</div>
@endsection           