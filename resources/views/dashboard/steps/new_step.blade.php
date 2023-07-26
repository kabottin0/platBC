@extends('layouts.app')
@section('main')
                <div class="container-fluid">
                  <div class="d-sm-flex align-items-center  mb-4">
                    <a href="{{ URL::previous() }}" class="m-4">
                        <span class="icon text-gray-600">
                            <i class="fas fa-arrow-left"></i>
                        </span>
                    </a>
                        <h1 class="h3 mb-0 text-gray-800">Inserisci nuovo step</h1>
                    </div>
                    <form  method="POST" action="{{route('steps.store')}}">
                      @method('POST')
                       @csrf
                        <div class="modal-body py-0">
                          <label for="label" class="form-label-controll">Flow: <strong>{{$flow->name}}</strong> </label>
                          <br> 
                          <input type="hidden" class="form-controll" name="flow_id" value="{{$flow->id}}">
                          
                          <label for="label" class="form-label-controll"> Message </label>
                          <input class="form-control" name= "message" id="value" required>
                          <label for="archivi" class="form-label-controll"> Scegli tra gli elementi: </label>
                          @foreach ($arch as $archivio) 
                            <div class="form-check">
                                @php                                
                                $idCheck = "Check";
                                $chek = $idCheck . "-" . uniqid();
                                @endphp
                              <input class="form-check-input" type="checkbox" name="elements[]"  value="{{$archivio->id}}" id="{{$chek}}">
                              <label class="form-check-label" for="{{$chek}}">
                                {{$archivio->label}}
                              </label>
                            </div>
                          @endforeach 
    
                        </div>
                        <div class="modal-footer flex-column border-top-0">
                            <button  class="btn btn-primary"> Inserisci Step </button>
                           
                        </div>
                    </form>    
                </div>
@endsection