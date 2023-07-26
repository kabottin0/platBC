@extends('layouts.app')
@section('main')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center m-2 justify-content-between">
            <div class="d-sm-flex align-items-center mb-3">
                <a href="{{route('flow.index')}}" class="m-3">
                    <span class="icon text-gray-600">
                        <i class="fas fa-arrow-left"></i>
                    </span>
                    </a>  
            <h1 class="h3 mb-0 text-gray-800">Steps</h1>
            </div>   
            <a href="{{ route('steps.create', ['id' => $flow->id]) }}" class="btn btn-info">
                <i class="fa-solid fa-plus"></i>
            </a>
        </div>
        @if (!$steps->isEmpty())
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="align-middle text-center">
                                    <th> ID </th>
                                    <th>Flow ID </th>
                                    <th>Messaggio</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            @foreach ($steps as $step)
                                <form method="POST">
                                    @csrf
                                    <tr class="align-middle text-center">
                                        <td class="col-1">{{ $step->id }}</td>
                                        <td class="col-1">{{ $step->flow_id }}</td>
                                        <td class="col-6 text-justify">{{ $step->message }}</td>
                                        <td class="col-2">
                                            <div class="row">
                                                <div class="col-6 text-right">
                                                    <a href="{{ route('steps.edit', ['step' => $step->id]) }}"
                                                        class="btn btn-primary"> <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>
                                                </div>
                                                <div class="col-6 text-left">
                                                    <a href="steps/{{ $step->id }}/delete" class="btn btn-danger"
                                                        onclick="return confirm('Sei sicuro?')"> <i
                                                            class="fa fa-trash"></i></a>
                                                </div>
                                                {{-- <a href="{{route('landing.index', ['flow' => $flo->id])}}" class="btn btn-success">Start </a> --}}
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
                Nessun step esistente, prego inserire nuovo step
            </div>
        @endif
    </div>
@endsection
