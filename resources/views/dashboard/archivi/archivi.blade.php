@extends('layouts.app')
@section('main')
            <div class="container-fluid">
                <div class="d-sm-flex align-items-center m-3 justify-content-between">
                    <h1 class="h3 mb-0 text-gray-800">Archivi</h1>
                    <a href="{{ route('archivio.create') }}" class="btn btn-info">
                        <i class="fa-solid fa-plus"></i>
                        
                    </a>
                </div>
                @if(!$archivios->isEmpty())               
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="align-middle text-center">
                                        <th>Archivio</th>
                                        <th>Type</th>
                                        <th>Value</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                @foreach ($archivios as $arch)
                                    <form method="POST">
                                        @csrf
                                        <tr class="align-middle text-center">
                                            <td class="col-1">{{ $arch->label }}</td>
                                            <td class="col-1">{{ $arch->type }}</td>
                                            <td class="col-4">{{ $arch->value }}</td>
                                            <td class="col-1">
                                            <div class="row">
                                                <div class="col-6 text-right">
                                                    <a href="{{ route('archivio.edit', ['archivio' => $arch->id]) }}"
                                                        class="btn btn-primary"> <i class="fa-solid fa-pen-to-square"></i> </a>
                                                </div>
                                                <div class="col-6 text-left">
                                                    <a href="archivio/{{ $arch->id }}/delete" class="btn btn-danger"
                                                        onclick="return confirm('Sei sicuro?')"> <i class="fa fa-trash"></i></a>
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
                    Nessuno elemento esistente, prego inserire nuovo elemento
                </div>
                @endif
            </div>
@endsection
