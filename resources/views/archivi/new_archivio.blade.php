@extends('template.base')
@extends('template.default')
@section('content')

  <div class="modal modal-sheet position-static d-block bg-secondary py-5" tabindex="-1" role="dialog" id="modalSheet">
    <div class="modal-dialog" role="document">
      <div class="modal-content rounded-4 shadow">
        <div class="modal-header border-bottom-0">
          <h5 class="modal-title">Inserisci Archivio</h5>
            </div>
                <form  method="POST" action="{{route('archivio.store')}}">
                  @csrf
                    <div class="modal-body py-0">
                        <label for="label" class="form-label"> Archivio </label>
                        <input class="form-control" name= "label" id="label" required>
                    </div>
                    <div class="modal-body py-0">
                        <label for="type" class="form-label"> Selezione il tipo di elemento </label>
                          <select class="form-select" name="type" >
                            <option value="text"> Text </option>
                            <option value="select"> Select </option>
                            <option value="boolean"> Booleano </option>
                          </select>
                    </div>
                    <div class="modal-body py-0">
                        <label class="form-label" for="value"> Value </label>
                         <input type="text" class="form-control" name="value" id="value" required>
                    </div>

                    <div class="modal-footer flex-column border-top-0">
                        <button  class="btn btn-primary">Inserisci in Archivio</button>
                        <button> <a href="/admin"> Home </a> </button>
                    </div>
                </form>    
        </div>
      </div>
    </div>
  </div>
       
        