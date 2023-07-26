@extends('layouts.app') 
@section('main')
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center m-3 justify-content-between">
                        <h1 class="h3 mb-0 text-gray-800">Utenti</h1>
                        <a href="{{ route('users.create') }}" class="btn btn-info">
                            <i class="fa-solid fa-plus"></i>
                        </a>
                    </div>
                    
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                  <thead>
                                    <tr class="align-middle text-center">
                                        <th>id</th>
                                        <th>Name</th>
                                        <th>Email</th>  
                                        <th>Role</th> 
                                        <th>Link/docs</th>
                                    </tr>
                                    </thead>
                                    @foreach ($users as $user)
                                    <form method="POST">
                                        @csrf 
                                        <tr class="align-middle text-center">
                                            <td class="col-1">{{$user->id}}</td>               
                                            <td class="col-2">{{$user->name}}</td>
                                            <td class="col-4">{{$user->email}}</td>
                                            <td class="col-2">{{$user->user_role}}</td>
                                            <td class="col-2">
                                                <div class="row">
                                                    <div class="col-6 text-right">
                                                        <a href="{{route('users.edit', ['user' => $user->id])}}" class="btn btn-primary"> <i class="fa-solid fa-pen-to-square"></i> </a>
                                                    </div>
                                                    <div class="col-6 text-left">
                                                        <a href="users/{{$user->id}}/delete" class="btn btn-danger" onclick="return confirm('Sei sicuro?')"> <i class="fa fa-trash"></i></a>
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
                </div>
@endsection