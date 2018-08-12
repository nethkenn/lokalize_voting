<!DOCTYPE html>
<html>
<head>
	<title>VOTING BEYBEH</title>
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
       <li class="nav-item active">
        <a class="nav-link" href="#"><i class="fa fa-comments whitefa" aria-hidden="true"></i></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#"><i class="fa fa-bell whitefa" aria-hidden="true"></i></a>
      </li>
       <li class="nav-item active livertical">
        <span class="verticalline"></span>
      </li>

       <li class="nav-item active">
         <a class="nav-link whitefa" href="#">John Doe</a>
      </li>
      
      <li class="nav-item dropdown dropdownli">
        <a class="nav-link dropdown-toggle whitefa imgdropdown" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        	<img src="https://scontent.fmnl9-1.fna.fbcdn.net/v/t1.0-1/c0.2.160.160/p160x160/31958923_2058121380883547_3049939586370240512_n.jpg?_nc_cat=0&oh=eca4abad35844c5ff96d1c9b8237315c&oe=5C07D70D">
        </a>
              	     
        <div class="dropdown-menu dropdown-menu-right dropdownlinav" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
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


<script src="/assets/js/jquery.min.js"></script>
@yield('script')
<script src="/assets/js/bootstrap.min.js"></script>
</body>
</html>