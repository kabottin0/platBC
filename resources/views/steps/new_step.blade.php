@extends('template.base')
@extends('template.default')
@section('content')
@php
/**
 * @var $archivios App\Models\Archivio;
 * @var $flow App\Models\Flow;
 * @var $steps App\Models\Steps;
*/
@endphp

<div class="modal modal-sheet position-static d-block bg-secondary py-5" tabindex="-1" role="dialog" id="modalSheet">
    <div class="modal-dialog" role="document">
      <div class="modal-content rounded-4 shadow">
        <div class="modal-header border-bottom-0">
          <h5 class="modal-title">Inserisci Nuovo step</h5>
            </div>
                <form  method="POST" action="{{route('steps.store')}}">
                  @method('POST')
                   @csrf
                    <div class="modal-body py-0">
                      <label for="label" class="form-label-controll">Flow: <strong>{{$flow->name}}</strong> </label>
                      <br> 
                      <input type="hidden" class="form-controll" name="flow_id" value="{{$flow->id}}">
                      
                      <label for="label" class="form-label-controll"> Message </label>
                      <input class="form-control" name= "message" id="value">
                      <label for="archivi" class="form-label-controll"> Scegli tra gli elementi: </label>
                      @foreach ($arch as $archivio) 
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="elements[]"  value="{{$archivio->id}}" id="flexCheckDefault">
                          <label class="form-check-label" for="flexCheckDefault">
                            {{$archivio->label}}
                          </label>
                        </div>
                      @endforeach 

                    </div>
                    <div class="modal-footer flex-column border-top-0">
                        <button  class="btn btn-primary"> Inserisci Step </button>
                        <button> <a href="/admin"> Home </a> </button>
                    </div>
                </form>    
        </div>
    </div>
</div>
