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
    <link rel="stylesheet" type="text/css" href="assets/css/results.css">
    <!-- Bootstrap core CSS -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="/assets/css/stylish-portfolio.min.css" rel="stylesheet">
  </head>
  <body>

      <nav class="navbar navbar-expand-lg navbar-light" id="mainNav" style="padding: 0px 300px;background-color: #1b2d90;">
        <a class="navbar-brand" href="index.php"><img src="/assets/images/header-logo.svg" alt="Global" width = "150"></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto" >
        
            
            <li class="nav-item">
              <a class="nav-link" href='/login'>Log-in</a>
            </li>
          </ul>
        </div>
      </nav>

    <br>
  <div class="container col-md-10">
    <br>
    <br>
    <h3 align="center">  Poll Results </h3>
    <br>
  </div>

    <div class="container">
      <div class="tab">
        <button class="tablinks active" onclick="openCity(event, 'BOT')">Board of Trustees</button>
        <button class="tablinks" onclick="openCity(event, 'GBD')">Global Board of Directors</button>
        <button class="tablinks" onclick="openCity(event, 'RBD')">Regional Board of Directors</button>
        <button class="tablinks" onclick="openCity(event, 'AMB')">Ambassadors</button>
      </div>
      {{-- Board of Trustees --}}
      <div id="BOT" class="tabcontent" style="display:block">
        <div class="tab-content" id="pills-tabContent">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
              <th>Name</th>
              <th>Region</th>
              <th>Percentage</th>
              <th>Vote Count</th>
            </tr>
          </thead>
          <tbody>
             @foreach($board as $key => $val)
              <tr>
                <td>{{ucfirst(strtolower($val->user_first_name))}} {{ucfirst(strtolower($val->user_last_name))}}</td>
                <td>{{$val->user_region}}</td>
                <td>{{ number_format(($val->votes_count / $total_board_vote_count) * 100,2) }} % </td>
                <td>{{$val->votes_count}}</td>
              </tr>
              @endforeach
          </tbody>
        </table>
      </div>
      </div>
      {{-- Global Boards of Directors --}}
      <div id="GBD" class="tabcontent">
        <div class="tab-content" id="pills-tabContent">
        <table id="example1" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
              <th>Name</th>
              <th>Region</th>
              <th>Percentage</th>
              <th>Vote Count</th>
            </tr>
          </thead>
          <tbody>
             @foreach($global as $key => $val)
              <tr>
                <td>{{ucfirst(strtolower($val->user_first_name))}} {{ucfirst(strtolower($val->user_last_name))}}</td>
                <td>{{$val->user_region}}</td>
                <td>{{ number_format(($val->votes_count / $total_global_vote_count) * 100,2) }} % </td>
                <td>{{$val->votes_count}}</td>
              </tr>
              @endforeach
          </tbody>
        </table>
      </div>
      </div>
      {{-- Regional Board of Directors --}}
      <div id="RBD" class="tabcontent">
        <div class="tab-content" id="pills-tabContent">
        <table id="example2" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
              <th>Name</th>
              <th>Region</th>
              <th>Percentage</th>
              <th>Vote Count</th>
            </tr>
          </thead>
          <tbody>
             @foreach($regional as $key => $val)
              <tr>
                <td>{{ucfirst(strtolower($val->user_first_name))}} {{ucfirst(strtolower($val->user_last_name))}}</td>
                <td>{{$val->user_region}}</td>
                <td>{{ number_format(($val->votes_count / $total_regional_vote_count) * 100,2) }} % </td>
                <td>{{$val->votes_count}}</td>
              </tr>
              @endforeach
          </tbody>
        </table>
      </div>
      </div>
      {{-- Ambassador --}}
      <div id="AMB" class="tabcontent">
        <div class="tab-content" id="pills-tabContent">
        <table id="example3" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
              <th>Name</th>
              <th>Region</th>
              <th>Country</th>
              <th>Percentage</th>
              <th>Vote Count</th>
            </tr>
          </thead>
          <tbody>
             @foreach($ambas as $key => $val)
              <tr>
                <td>{{ucfirst(strtolower($val->user_first_name))}} {{ucfirst(strtolower($val->user_last_name))}}</td>
                <td>{{$val->user_region}}</td>
                <td>{{ $val->user_country }}</td> 
                <td>{{ number_format(($val->votes_count / $total_ambas_vote_count[$val->user_country]["totalvotes"]) * 100,2) }} % </td>
                <td>{{$val->votes_count}}</td>
              </tr>
              @endforeach
          </tbody>
        </table>
      </div>
      </div>
      
      
      
    </div>
  </body>
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>+
  <script>
  $(document).ready(function() {
      $('#example').DataTable( {
        "order": [[ 3, "desc" ]]
    });
  });
  </script>
  <script>
  $(document).ready(function() {
  $('#example1').DataTable({
    "order": [[ 3, "desc" ]]
  });
  } );
  </script>
  <script>
  $(document).ready(function() {
  $('#example2').DataTable({
    "order": [[ 3, "desc" ]]
  });
  } );
  </script>
  <script>
  $(document).ready(function() {
  $('#example3').DataTable({
    "order": [[ 4, "desc" ]]
  });
  } );
  </script>
  <script src="assets/js/results.js"></script>
</html>