@include('sweetalert::alert')
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel ="icon" href="logo.png" size="40x40">
    <title>Global Associations of Blockchains and Cryptocurrency</title>
    <!-- Bootstrap core CSS -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/main.css" rel="stylesheet">
    <!-- Custom fonts for this template -->
    <link href="/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/login-style.css" rel="stylesheet">
    <link href="/assets/css/loginbootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
  </head>
  <body class="body">
    <div class="container">
      <div class="mx-auto text-center col-md-6 col-sm-12 card card-signin my-5 col-md-offset-3">

          <div class="card-body col-md-6 col-lg-12">
            <div class="col-md-12">
              <img src="/assets/images/5th logo.png" alt="gabc logo" width="200">
            </div>

            <hr>

            <form class="form-signin" method="post" action="/login_submit">
              <input type="hidden" name="_token" value="wuwMrrOxdruSe7lK18eAcFx95i2DcnL7QI8ltYDS">
              <div class="form-label-group">
                USERNAME
                <input type="text" id="inputUserame" class="form-control" name="UserNameInput" placeholder="Username" required="" autofocus="">
                <label for="inputUserame"></label>
              </div>

              <div class="form-label-group">
                PASSWORD
                <input type="password" id="inputPassword" name="PasswordNameInput" class="form-control" placeholder="Password" required="">
                <label for="inputPassword"></label>
              </div>

              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Log-in</button>
              <br>

              <hr class="my-4">
              <a class="d-block text-right mt-3 small" href="#"><i>Not yet a member?</i></a>
              <br>

              <button class="btn btn-lg btn btn-danger btn-block text-uppercase" type="submit"><a style="color:white;" href="https://www.gmail.com">Sign up with Google Form</a></button>

            </form>
          </div>

      </div>
    </div>

    <script src="/assets/js/loginjquery.min.js"></script>
    <script src="/assets/js/loginbootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>
    <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    <script type="text/javascript"></script>

  </body>
</html>
