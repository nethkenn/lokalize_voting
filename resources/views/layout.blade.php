<!DOCTYPE html>
<html>
  <head>
    <title>GABC VOTING</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="/assets/font-awesome/css/font-awesome.min.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light navbar_top">
        <a class="navbar-brand" href="index.php"><img src="/assets/images/header-logo.svg" alt="Global" width = "150"></a>
      <button class="navbar-toggler ml-auto custom-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto ulcontent">
{{--           <li class="nav-item active">
            <a class="nav-link" href="#"><i class="fa fa-crosshairs whitefa" aria-hidden="true"></i></a>
          </li>
          <a class="nav-link" href="#"><i class="fa fa-comments whitefa" aria-hidden="true"></i></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="#"><i class="fa fa-bell whitefa" aria-hidden="true"></i></a>
        </li> --}}
        <li class="nav-item active livertical">
          <span class="verticalline"></span>
        </li>
        <li class="nav-item active">
          <a class="nav-link whitefa" href="#">{{ucfirst($fname)}} {{ucfirst($lname)}}</a>
        </li>
        
        <li class="nav-item dropdown dropdownli">
          <a class="nav-link dropdown-toggle whitefa imgdropdown" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="{{$pic}}">
          </a>
          
          <div class="dropdown-menu dropdown-menu-right dropdownlinav" aria-labelledby="navbarDropdown">
            @if($usertype == 0 || $usertype == 3)
            <center><a class="button" href='/logout' style="text-decoration: none;"><i class="fa fa-share" aria-hidden="true"></i> Logout</a></center>
            @else
            <center><a href="#" class="text" data-toggle="modal" data-target="#exampleModalCenter" style="text-decoration: none;"><i class="fa fa-upload" aria-hidden="true"></i> Import Data</a></center>
            <div class="dropdown-divider"></div>
              <center><a href="#" class="text" data-toggle="modal" data-target="#exampleModalCenterv2" style="text-decoration: none;"><i class="fa fa-upload" aria-hidden="true"></i> Import Data V2</a></center>
            <div class="dropdown-divider"></div>
            <center><a href="#" class="text" data-toggle="modal" data-target="#exampleModalSend" style="text-decoration: none;"><i class="fa fa-paper-plane" aria-hidden="true"></i> Send Accounts</a></center>
            <div class="dropdown-divider"></div>
            <center><a href="#" class="text" data-toggle="modal" data-target="#exampleModalSendv2" style="text-decoration: none;"><i class="fa fa-paper-plane" aria-hidden="true"></i> Send Accounts V2</a></center>
            <div class="dropdown-divider"></div>
            <center><a href="#" class="text" data-toggle="modal" data-target="#exampleModalSendUpdates" style="text-decoration: none;"><i class="fa fa-paper-plane" aria-hidden="true"></i> Send Updates</a></center>
            <div class="dropdown-divider"></div>
            <center><a href="#" class="text" data-toggle="modal" data-target="#exampleModalSendUpdatesv2" style="text-decoration: none;"><i class="fa fa-paper-plane" aria-hidden="true"></i> Send Updates V2</a></center>
            <div class="dropdown-divider"></div>
            <center><a href="#" class="text" data-toggle="modal" data-target="#exampleModalSendUpdatesv3" style="text-decoration: none;"><i class="fa fa-paper-plane" aria-hidden="true"></i> Email Winners</a></center>
            <div class="dropdown-divider"></div>
             <center><a href="#" class="text" data-toggle="modal" data-target="#exampleModalSendUpdatesv4" style="text-decoration: none;"><i class="fa fa-paper-plane" aria-hidden="true"></i> Send Email (Pending Voters)</a></center>
            <div class="dropdown-divider"></div>
            {{--  <a class="dropdown-item" href="#">Another action</a> --}}
            <!-- Button trigger modal -->
            <!-- Button trigger modal -->
            <!-- Modal -->
            <center><a class="button" href='/logout' style="text-decoration: none;"><i class="fa fa-share" aria-hidden="true"></i> Logout</a></center>
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
  <div class="modal fade" id="exampleModalCenterv2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <form method="POST" action="/admin/import_v2" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Import Data V2</h5>
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

    <div class="modal fade" id="exampleModalSendv2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <form method="POST" action="/admin/send_password_v2" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Send Accounts V2</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Are you sure you want to send their accounts?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="send">Send</button>
          </div>
        </div>
      </form>
    </div>
  </div>  


    <div class="modal fade" id="exampleModalSend" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <form method="POST" action="/admin/send_password" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Send Accounts</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Are you sure you want to send their accounts?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="send">Send</button>
          </div>
        </div>
      </form>
    </div>
  </div>  

      <div class="modal fade" id="exampleModalSendUpdates" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <form method="POST" action="/admin/send_updates" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Send Updates</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Are you sure you want to send their updates?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="send">Send</button>
          </div>
        </div>
      </form>
    </div>
  </div>  

        <div class="modal fade" id="exampleModalSendUpdatesv2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <form method="POST" action="/admin/send_updates_v2" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Send Updates V2</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Are you sure you want to send their updates?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="send">Send</button>
          </div>
        </div>
      </form>
    </div>
  </div>  

          <div class="modal fade" id="exampleModalSendUpdatesv3" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <form method="POST" action="/admin/send_updates_v3" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Send Updates V3</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Are you sure you want to send their updates?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="send">Send</button>
          </div>
        </div>
      </form>
    </div>
  </div>  

     <div class="modal fade" id="exampleModalSendUpdatesv4" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <form method="POST" action="/admin/send_updates_v4" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Send Updates (Pending Voters)</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Are you sure you want to send email to the pending voters?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="send">Send</button>
          </div>
        </div>
      </form>
    </div>
  </div>  
  @yield("script")
 {{--  <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script> --}}
  <script src="/assets/js/bootstrap.min.js"></script>
  {{-- @include('sweetalert::alert') --}}
  {{-- {!! Toastr::message() !!} --}}

</body>
</html>