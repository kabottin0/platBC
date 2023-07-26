@extends('template.base')
@extends('template.default')
@section('content')

<div class="modal modal-sheet position-static d-block bg-secondary py-5" tabindex="-1" role="dialog" id="modalSheet">
    <div class="modal-dialog" role="document">
      <div class="modal-content rounded-4 shadow">
        <div class="modal-header border-bottom-0">
          <h5 class="modal-title">Inserisci Nuovo Flusso</h5>
            </div>
                <form  method="POST" action="{{route('flow.store')}}">
                  @csrf
                    <div class="modal-body py-0">
                        <label for="label" class="form-label"> Nome del flusso </label>
                        <input class="form-control" name= "name" id="label">
                    </div>
                    <div class="modal-body py-0">
                        <label class="form-label" for="value"> Messaggio iniziale </label>
                         <input type="text" class="form-control" name="message" id="value">
                    </div>

                    <div class="modal-footer flex-column border-top-0">
                        <button  class="btn btn-primary">Inserisci in Flow</button>
                        <button> <a href="/admin"> Home </a> </button>
                    </div>
                </form>    
        </div>
      </div>
    </div>
  </div>