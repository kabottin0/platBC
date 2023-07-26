@extends('template.base')
@extends('template.side_bar')
@section('content')

<div class="container">
    <header class="d-flex justify-content-center py-4">
      <ul class="nav nav-pills">
        <li class="nav-item"><a href="/admin/users/create" class="nav-link " aria-current="page">Nuovo utente</a></li>        
      </ul>
    </header>
  </div>
  <div class="container" style="margin-left:25%; width: 1000px;">
    <table class="table table-striped table-dark albums">
        <thead>
            <tr class="align-middle justify-content-between">
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
                <tr class="align-middle justify-content-between">
                    <td>{{$user->id}}</td>               
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->user_role}}</td>
                    <td class="justify-content-between">
                        <a href="{{route('users.edit', ['user' => $user->id])}}" class="btn btn-primary"> Update </a> 
                        <a href="users/{{$user->id}}/delete" class="btn btn-danger" onclick="return confirm('Sei sicuro?')"> Delete </a>
                        <a href="{{route('flow.index')}}" class="btn btn-success">Start </a>
                    </td>
                </tr>
        @endforeach
            </form>
        </table>
</div>

@endsection