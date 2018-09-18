<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel ="icon" href="logo.png" size="40x40" >
    <title>Global Associations of Blockchains and Cryptocurrency</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
  </head>
  <body style="background-color: violet;">
    <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
      <div class="container">
        <a class="navbar-brand" href="index.php"><img src="/assets/images/header.png" alt="Global" width = "250"  ></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href='/results'>Results</a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link" href="contact.html">Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href='/login'>Log-in</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <br>
    <br>
    <br>
    <br>
    <div class="container">
      
      <div class="tab-content" id="pills-tabContent">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
              <th>Top</th>
              <th>Name</th>
              <th>Positions</th>
              <th>Region</th>
              <th>Percentage</th>
              <th>Vote Count</th>
            </tr>
          </thead>
          <tbody>
            @php
              $count = 1;
              @endphp
             @foreach($global_candidate as $key => $val)
              <tr>
                <th scope="row">{{$count++}}</th>
                <td>{{$val->user_first_name}} {{$val->user_last_name}}</td>
                <td>
                  @php
                  switch ($val->position_id) 
                  {
                    case 1:
                      echo "Board of Trustees";
                      break;
                    case 2:
                      echo "Global Board of Directors";
                      break;
                    case 3:
                      echo "Regional Board of Directors";
                      break;
                    case 4:
                      echo "Ambassadors";
                      break;
                  }
                  @endphp

                </td>
                <td>{{$val->user_region}}</td>
                <td></td>
                <td>{{$global_candidate_votes}}</td>
              </tr>
              @endforeach
          </tbody>
        </table>
      </div>
      
      
    </div>
  </body>
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
  <script>
  $(document).ready(function() {
  $('#example').DataTable();
  } );
  
  </script>
  </script>
</html>