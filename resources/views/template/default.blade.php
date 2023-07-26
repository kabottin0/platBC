
  <body>
    <div class="container">
        <header class="d-flex justify-content-center py-4">
          <ul class="nav nav-pills">
            <li class="nav-item"><a href="/admin" class="nav-link " aria-current="page">Home</a></li>
            <li class="nav-item"><a href="/admin/flow" class="nav-link ">Flusso</a></li>
            <li class="nav-item"><a href="/admin/flow/create" class="nav-link ">Nuovo Flusso</a></li>
            <li class="nav-item"><a href="/admin/archivio/create" class="nav-link ">Nuovo Archivio</a></li>
            <li class="nav-item"><a href="/admin/archivio" class="nav-link ">Archivi</a></li>
            <li class="nav-item"><a href="/admin/docs" class="nav-link ">docs</a></li>
            <li class="nav-item"><a href="/admin/users" class="nav-link ">Users</a></li>
          </ul>
        </header>
    </div> 
    
    

    @section('content')
    @yield('table')
    @show
    {{$slot ?? ''}}
    @section('footer')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    @show
  </body>
