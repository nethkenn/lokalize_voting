
<!DOCTYPE html>
<html>
  <head>
    <link href="/assets/css/login-style.css" rel="stylesheet">
    <link href="/assets/css/loginbootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  </head>
  <body class="body">
    <div class="container">
      <div class="row">
        <div class="col-lg-10 col-xl-9 mx-auto">
          <div class="card card-signin flex-row my-5">
            <div class="card-img-left d-none d-md-flex">
              <!-- Background image for card set in CSS! -->
            </div>
                    
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
                
                
                <button class="btn btn-lg btn-primary btn-block text-uppercase btn-violet" type="submit">Log-in</button>
                <br>
                
                 @if($errors->any())
                <div class="alert alert-danger" style="border-radius: 15px 50px 30px;height: 50px">
                  <center><h4>{{$errors->first()}}</h4></center>
                </div>
                @endif
              {{--  @if(session::has('error'))
                <div class="alert alert-danger" style="border-radius: 15px 50px 30px;height: 50px">
                  <center><h4>{{session::get('error')}}</h4></center>
                </div>
                @endif --}}
                <hr class="my-4">
{{--                 <a class="d-block text-left mt-3 small" href="#">&nbsp;&nbsp;&nbsp;Not yet a member?</a>
                
                <button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><a style = "color:white;" href="https://www.gmail.com"> Sign up with Google Form</button></a> --}}
                
              </form>
              <a href="/results" target="_blank" class="btn btn-lg btn-primary btn-block text-uppercase btn-violet resultss" style="border-radius: 5rem;font-size: 80%;letter-spacing: .1rem;font-weight: bold;padding: 1rem;transition: all 0.2s;">View Results</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <script src="/assets/js/loginjquery.min.js"></script>
    <script src="/assets/js/loginbootstrap.bundle.min.js"></script>
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    {!! Toastr::message() !!}
  </body>