@extends('template.base')
@extends('template.side_bar')
@if (session()->has('message'))
        <div class="alert alert-info">
            {{session()->get('message')}}
        </div>
        
@endif
<div class="container" style="margin-left:25%; width: 1000px;">
    <table class="table table-striped table-dark albums">
        <thead>
            <tr class="align-middle justify-content-between">
                <th> ID </th>
                <th>Nome Flusso</th>
                <th>Messaggio</th>
                <th>&nbsp;</th>
                <th>Steps</th>
            </tr>
            </thead>
        @foreach ($flow as $flo)
            <form method="POST">
                @csrf 
                <tr class="align-middle justify-content-between">
                    <td>{{$flo->id}}</td>
                    <td>{{$flo->name}}</td>               
                    <td>{{$flo->message}}</td>
                    <td class="justify-content-between">
                        <a href="{{route('flow.edit', ['flow' => $flo->id])}}" class="btn btn-primary"> Update </a> 
                        <a href="flow/{{$flo->id}}/delete" class="btn btn-danger" onclick="return confirm('Sei sicuro?')"> Delete </a>
                        <a href="{{route('landing.index', ['flow' => $flo->id])}}" class="btn btn-success">Start </a>
                    </td>
                    <td class="justify-content-between">
                        <a href="{{route('steps.create', ['id' => $flo->id])}}" class="btn btn-info">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                            </svg>
                        </a>
                        <a href="{{route('steps.index', ['id'=> $flo->id])}}" class="btn btn-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                            </svg>
                        </a>    
                    </td>

                </tr>
            </form>
        @endforeach
            
        </table>
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