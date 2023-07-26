@extends('layouts.app') 
@section('main')
@php
    $page = '/admin/request';
@endphp
<div class="d-sm-flex align-items-center mb-3 p-4">
    <h1 class="h3 mb-0 text-gray-800">Request</h1>
</div>

<div class="container-fluid">
  
  {{-- @if(!$flow->isEmpty())  --}}
  <div class="card shadow mb-6">
      <div class="card-body">
          <div class="table-responsive">
              <table class="table table-bordered">
                  <thead>
                      <tr class="align-middle text-center">
                          <th>Id</th>
                          <th>Label</th>
                          <th>Type</th>
                          <th>Value</th>
                          <th>flow_id</th>
                          <th>Data</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  @foreach ($queryjoin as $query)
                            <form method="POST">
                                @csrf
                               
                                <tr class="align-middle text-center">
                                    <td class="col-1">{{ $query->id }}</td>
                                    <td class="col-2">{{ $query->label }}</td>
                                    <td class="col-1">{{ $query->type }}</td>
                                    <td class="col-3">{{ $query->value }}</td>
                                    <td class="col-1">{{ $query->users_has_flow_id }}</td>
                                    <td class="col-2">{{ $query->created_at }}</td>
                                    <td class="col-1">
                                        <div class="row">
                                            <div class="col-4 text-center"></div>
                                            <div class="col-4 text-center">
                                                <a href="request/{{ $query->id }}/delete" class="btn btn-danger" onclick="return confirm('Sei sicuro?')"> 
                                                   <i class="fa fa-trash"></i>
                                                </a>
                                            </div>
                                            <div class="col-4 text-center"></div>
                                            
                                        </div>
                                    </td>
                                </tr>
                            </form>
                        @endforeach
              </table>
          </div>
          <div>
            {{$queryjoin->links()}}
          </div>
      </div>
  </div>
  {{-- @else --}}
  
      
  {{-- @endif --}}
</div>


@endsection