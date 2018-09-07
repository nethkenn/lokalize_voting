<!DOCTYPE html>
<html>
  <head>
    <title>GABC VOTING</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="/assets/font-awesome/css/font-awesome.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light navbar_top">
      <button class="navbar-toggler ml-auto custom-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto ulcontent">
          <li class="nav-item active">
            <a class="nav-link" href="#"><i class="fa fa-crosshairs whitefa" aria-hidden="true"></i></a>
          </li>
          <a class="nav-link" href="#"><i class="fa fa-comments whitefa" aria-hidden="true"></i></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="#"><i class="fa fa-bell whitefa" aria-hidden="true"></i></a>
        </li>
        <li class="nav-item active livertical">
          <span class="verticalline"></span>
        </li>
        <li class="nav-item active">
          <a class="nav-link whitefa" href="#">{{$fname}} {{$lname}}</a>
        </li>
        
        <li class="nav-item dropdown dropdownli">
          <a class="nav-link dropdown-toggle whitefa imgdropdown" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="{{$pic}}">
          </a>
          
          <div class="dropdown-menu dropdown-menu-right dropdownlinav" aria-labelledby="navbarDropdown">
            @if($usertype == 0)
            <div class="dropdown-divider"></div>
            <a class="button" href='/login'>Logout</a>
            @else
            <a href="#" class="text" data-toggle="modal" data-target="#exampleModalCenter">Import Data</a>
            {{--  <a class="dropdown-item" href="#">Another action</a> --}}
            <!-- Button trigger modal -->
            <!-- Button trigger modal -->
            <!-- Modal -->
            <div class="dropdown-divider"></div>
            <a class="button" href='/logout'>Logout</a>
            @endif
          </div>
        </li>
      </ul>
    </div>
  </nav>
  <div class="container">
    <div class="row main_button_positions">
      @yield('content')
    </div>
  </div>
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <form method="POST" action="/admin/import" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Import Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            {{--upload file--}}
            <input type="file" class="choosefile" name="file">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="uploadfile">Upload</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <script src="/assets/js/bootstrap.min.js"></script>
  <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>
  @include('sweetalert::alert')
</body>
</html>