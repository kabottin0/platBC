@extends('layouts.app')
@section('main')
{{-- <script> 
    function myFunction() {
        var x = document.getElementById("mySelect").value;
        if (x == "text"){                    
            document.getElementById("textvalue").classList.toggle('d-none');
        } else if (x == "select"){                    
            document.getElementById("typeselect").classList.toggle('d-none');
        } else if (x == "boolean"){                    
            document.getElementById("yesno").classList.toggle('d-none');
        }
    }   
</script> --}}
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center  mb-4">
            <a href="{{ URL::previous() }}" class="m-4">
                <span class="icon text-gray-600">
                    <i class="fas fa-arrow-left"></i>
                </span>
            </a>
            <h1 class="h3 mb-0 text-gray-800">Inserire nuovo archivio</h1>
        </div>
        <form method="POST" action="{{ route('archivio.store') }}">
            @csrf
            <div class="modal-body py-0">
                <label for="label" class="form-label"> Archivio </label>
                <input class="form-control col-lg-3 col-sm-12 col-md-6 " name="label" id="label" required>
            </div>
            
            <br>
            <div class="modal-body py-0">
                <label for="type" class="form-label"> Selezione il tipo di elemento </label>
                <br>
                <select class="form-select" name="type" id="mySelect" onchange="myFunction()">
                    <option selected>Scegli</option>
                    <option value="text"> Text </option>
                    <option value="select"> Select </option>
                    <option value="boolean"> Booleano </option>
                  </select>
            </div>
            <br>
            <div class="modal-body py-0" id="textvalue">
                <label class="form-label" for="value"> Value </label>
                <input type="text" class="form-control col-lg-3 col-sm-12 col-md-6 " name="value" id="value" >
            </div>
           
            <div class="modal-footer flex-column border-top-0">
                <button class="btn btn-primary">Inserisci in Archivio</button>
                
            </div>
        </form>
    </div>

   
@endsection
