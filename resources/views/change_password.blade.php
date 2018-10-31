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
  
  @yield("script")
 {{--  <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script> --}}
  <script src="/assets/js/bootstrap.min.js"></script>
</body>
</html>