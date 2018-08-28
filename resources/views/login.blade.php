<!DOCTYPE html>
<html>
<head>
<link href="/assets/css/login-style.css" rel="stylesheet">
<link href="/assets/css/loginbootstrap.min.css" rel="stylesheet">
<link href="/assets/css/all.css" rel="stylesheet">

</head>
<body class="body">
  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-xl-9 mx-auto">
        <div class="card card-signin flex-row my-5">
          <div class="card-img-left d-none d-md-flex">
             <!-- Background image for card set in CSS! -->
          </div>
         
            @if($errors->any())
              <div class="col-md-3 bg-danger">
                <h4>{{$errors->first()}}</h4>
              </div>
            @endif
          
          <div class="card-body">
            <h5 class="card-title text-center">LOGIN</h5>
            <form class="form-signin" method="post" action='/login_submit'>
              {{ csrf_field() }}
              <div class="form-label-group">
                USERNAME
                <input type="text" id="inputUserame" class="form-control" name="UserNameInput" placeholder="Username" required autofocus>
                <label for="inputUserame"></label>
              </div>

   
              <div class="form-label-group"> 
                PASSWORD
                <input type="password" id="inputPassword" name="PasswordNameInput" class="form-control" placeholder="Password" required>
                <label for="inputPassword"></label>
              </div>
              
          
              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Log-in</button>
  
              <hr class="my-4">
			     <a class="d-block text-left mt-3 small" href="#">&nbsp;&nbsp;&nbsp;Not yet a member?</a>
				 
            <button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><a style = "color:white;" href="https://www.gmail.com"> Sign up with Google Form</button></a>
              
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <script src="/assets/js/loginjquery.min.js"></script>
	<script src="/assets/js/loginbootstrap.bundle.min.js"></script>

</body>