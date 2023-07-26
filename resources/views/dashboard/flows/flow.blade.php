@extends('layouts.app')
@section('main')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center m-3 justify-content-between">
            <h1 class="h3 mb-0 text-gray-800">Flussi</h1>
            <a href="{{ route('flow.create') }}" class="btn btn-info">
                <i class="fa-solid fa-plus"></i>
            </a>
        </div>
        @if(!$flow->isEmpty()) 
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="align-middle text-center">
                                <th> ID </th>
                                <th>Flusso</th>
                                <th>Messaggio</th>
                                <th>Actions</th>
                                <th>Steps</th>
                            </tr>
                        </thead>
                        @foreach ($flow as $flo)
                            <form method="POST">
                                @csrf
                                @php
                                    $message = $flo->message;
                                    $lenght = strlen($flo->message);
                                    // $rest = substr($message, 0, 100);  // returns "abcde"
                                @endphp
                                <tr class="align-middle text-center">
                                    <td class="col-1">{{ $flo->id }}</td>
                                    <td class="col-2">{{ $flo->name }}</td>
                                    <td class="col-5 text-justify">{{ Str::limit($message, 100) }}</td>
                                    <td class="col-1">
                                        <div class="row">
                                            <div class="col-4 text-center">
                                                <a href="{{ route('flow.edit', ['flow' => $flo->id]) }}"
                                                    class="btn btn-primary"> <i class="fa-solid fa-pen-to-square"></i> </a>
                                            </div>
                                            <div class="col-4 text-center">
                                                <a href="flow/{{ $flo->id }}/delete" class="btn btn-danger"
                                                    onclick="return confirm('Sei sicuro?')"> <i class="fa fa-trash"></i></a>
                                            </div>
                                            <div class="col-4 text-center">
                                                <a href="{{route('landing.index', ['flow' => $flo->id])}}" class="btn btn-success"><i class="fa-solid fa-play"></i> </a>
                                            </div>
                                            
                                        </div>
                                    </td>
                                    <td class="col-2">
                                        <div class="row">
                                            <div class="col-6 text-right">
                                                <a href="{{ route('steps.create', ['id' => $flo->id]) }}"
                                                    class="btn btn-info">
                                                    <i class="fa-solid fa-plus"></i>
                                                </a>
                                            </div>
                                            <div class="col-6 text-left">
                                                <a href="{{ route('steps.index', ['id' => $flo->id]) }}"
                                                    class="btn btn-success">
                                                    <i class="fa-solid fa-right-to-bracket"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </td>

                                </tr>
                            </form>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        @else
        <div class="alert alert-warning margin" role="alert">
            Nessuno flusso esistente, prego inserire nuovo flusso
        </div>
            
        @endif
    </div>
@endsection
