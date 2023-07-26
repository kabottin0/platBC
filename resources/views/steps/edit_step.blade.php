@extends('template.base')
@extends('template.default')
@section('content')


@if (session()->has('message'))
        <div class="alert alert-info">
            {{session()->get('message')}}
        </div>
        
@endif


<div class="modal modal-sheet position-static d-block bg-secondary py-5" tabindex="-1" role="dialog" id="modalSheet">
    <div class="modal-dialog" role="document">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title">Aggiorna Step</h5> 
            </div>


            
            <form method="POST" action="{{route('steps.update', ['step' => $step->id])}}">
                @method('PATCH')
                @csrf 
                <div class="modal-body py-0">
                    <label for="label" class="form-label-controll">Step: <strong>{{$step->id}}</strong> </label>
                    <br> 
                    <input type="hidden" class="form-controll" name="step_id" value="{{$step->id}}">
                    
                    <label for="label" class="form-label-controll"> Message </label>
                    <input class="form-control" name= "message" id="value" value="{{$step->message}}">
                    <label for="archivi" class="form-label-controll"> Scegli tra gli elementi: </label>
                    @foreach ($newData as $archivio) 
                        {{-- @php
                            $attrChecked = $archivio['checked'] ? "checked" : "";
                        @endphp --}}
                        <div class="form-check">
                            @php                                
                                $idCheck = "Check";
                                $chek = $idCheck . "-" . uniqid();
                            @endphp
                        <input class="form-check-input" type="checkbox" name="elements[]" id="{{$chek}}" value="{{$archivio['id']}}" @checked($archivio['checked'])>
                        <label class="form-check-label" for="{{$chek}}">
                            {{$archivio['label']}}
                        </label>
                        </div>
                    @endforeach 
                </div>
                <div class="modal-footer flex-column border-top-0">
                    <button  class="btn btn-primary">Aggiorna Step</button>
                    <button> <a href="/admin"> Home </a> </button>
                </div>
            </form>
        </div>
    </div>
</div>

  @section('footer')
  @parent
<script>
    $('document').ready(function () {
        $('.alert').fadeOut(5000);
        $('ul').on('click', 'a.btn-danger', function (ele) {
            ele.preventDefault();
            var urlArch = $(this).attr('href');
            var li = ele.target.parentNode.parentNode;

            $.ajax(urlArch,
                {                    
                    data:{_token:$('#_token').val()
                    },
                    complete : function (resp) {
                        console.log(resp);
                        if(resp.responseText == 1){
                         //   alert(resp.responseText)
                            li.parentNode.removeChild(li);
                            // $(li).remove();
                        } else {
                            alert('Problem contacting server');
                        }
                    }
                }
            )
        });

    });
</script> 




@endsection