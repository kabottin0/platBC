@extends('template.base')
<body>
<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px; position: fixed;">
    <a href="/admin" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
      <svg class="bi me-2" width="40" height="32"><use xlink:href="/admin"></use></svg>
      <span class="fs-4">GoNativeFlows</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="/admin" class="nav-link active" aria-current="page">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="/admin"></use></svg>
          Home
        </a>
      </li>
      
      <li>
        <a href="/admin/flow"class="nav-link text-white">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="/admin/flow"></use></svg>
          Flusso
        </a>
      </li>
      <li>
        <a href="/admin/flow/create" class="nav-link text-white">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="/admin/flow/create" ></use></svg>
          Nuovo flusso
        </a>
      </li>
      <li>
        <a href="/admin/archivio/create" class="nav-link text-white">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="/admin/archivio/create"></use></svg>
          Nuovo archivio
        </a>
      </li>
      <li>
        <a href="/admin/archivio"  class="nav-link text-white">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="/admin/archivio" ></use></svg>
          Archivi
        </a>
      </li>
      <li>
        <a href="/admin/users"  class="nav-link text-white">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="/admin/users" ></use></svg>
          Users
        </a>
      </li>
      @guest
      <li>
        <a href="{{route('login')}}"  class="nav-link text-white">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="{{route('login')}}" ></use></svg>
          Login
        </a>
      </li>
      <li>
        <a href="{{route('register')}}"  class="nav-link text-white">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="{{route('register')}}"  ></use></svg>
          Register
        </a>
      </li>
      @endguest
      
    </ul>
    <hr>
   @auth   
    <div class="dropdown">
      <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"  id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="true">
        <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
        <strong>{{Auth::user()->name}}</strong>
      </a>
      <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
        <li><a class="dropdown-item" href="#">New project...</a></li>
        <li><a class="dropdown-item" href="#">Settings</a></li>
        <li><a class="dropdown-item" href="#">Profile</a></li>
        <li><hr class="dropdown-divider"></li>
        <li>
          <a class="dropdown-item"
             href="#"
             onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
             Sign out
          </a>
          <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
            {{ csrf_field() }}
          </form>
        </li>
          
      </ul>
    </div>
    @endauth
  </div>

  
  
  @section('content')
  @yield('table')
  @show
  @section('footer')
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  @show
</body>
