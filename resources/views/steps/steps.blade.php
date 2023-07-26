@extends('template.base')
@extends('template.side_bar')
@section('content')

@if (session()->has('message'))
        <div class="alert alert-info">
            {{session()->get('message')}}
        </div>
        
@endif
@if (!isset($steps))
<div class="container" style="margin-left:25%; width: 1000px;">
    <table class="table table-striped table-dark albums">
        <thead>
            <tr class="align-middle justify-content-between">
                <th> ID </th>
                <th>Flow ID </th>
                <th>Messaggio</th>
                <th>&nbsp;</th>
            </tr>
            </thead>
        @foreach ($steps as $step)
            <form method="POST">
                @csrf 
                <tr class="align-middle justify-content-between">
                    <td>{{$step->id}}</td>
                    <td>{{$step->flow_id}}</td>               
                    <td>{{$step->message}}</td>
                    <td class="justify-content-between">
                        <a href="{{route('steps.edit', ['step' => $step->id])}}" class="btn btn-primary"> Update </a> 
                        <a href="steps/{{$step->id}}/delete" class="btn btn-danger" onclick="return confirm('Sei sicuro?')"> Delete </a>
                    </td>
                </tr>
        @endforeach
            </form>
        </table>
</div>
@else
<div>
    <h1> Non c'è nessun elemento salvato, prego inserire elemento</h1>
</div>
@endif
@endsection




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