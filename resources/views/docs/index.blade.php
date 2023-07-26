@extends('template.default')
@section('content')

{{-- {{ Form::open(array('url' => 'foo/bar')) }}

{{Form::token()}}

{{Form::label('email', 'E-Mail Address')}}
{{Form::text('username', "blblblbl", ['class' => 'form-control'])}}
<br>
{{Form::label('password')}}
{{Form::password('password')}}
{{ Form::close() }} --}}

{{-- array('route' => 'Index.store') --}}

{{-- {{Form::open(array('action' => 'IndexController@store'))}} non funziona --}}
{{Form::open(array('route' => 'docs.store'))}}

    <div class="container">
       
        @foreach ($elements as $item )
            @switch($item)
            @case($item->type === "text")
                    <ul>
                        <li> 
                            {{Form::label("Type: $item->label")}}
                            {{Form::text('text', " ", ['class' => 'form-control'])}}
                        </li>
                    </ul>
                        <br>
                        @break
                @case($item->type === "select")
                    <ul>
                        <li> 
                            {{Form::label("Type: $item->label")}}
                            {{Form::select('select', array('text', 'select','boolean') , ['class' => 'form-control'])}}
                        </li>
                    </ul>
                        <br>
                        @break
                @case($item->type === "boolean")
                    <ul>
                        <li> 
                            {{Form::label("Type: $item->label")}}
                            {{Form::checkbox('boolean', 'value', false)}}
                        </li>
                    </ul>
                        <br>
                        @break
            @endswitch
        @endforeach 
        <button  class="btn btn-primary">Salva</button> 
    </div>   
{{Form::close()}}



@endsection
