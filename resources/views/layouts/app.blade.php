<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
   <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{env('APP_NAME')}}</title>
   <!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="loginfolder/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="loginfolder/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="loginfolder/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="loginfolder/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="loginfolder/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="loginfolder/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="loginfolder/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="loginfolder/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="loginfolder/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="loginfolder/css/util.css">

  <link href="css/mycss.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="loginfolder/css/main.css?version='{{env('APP_VERS')}}'">
<!--===============================================================================================-->
  <style>
	  #loading{
		  top:50%;
    }
    
    
	</style>
    
</head>
<body>
    <div id="app">
   
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="images/logo.png" alt="" >
                  <?php /*echo env('APP_NAME');*/?>
                        <!--{{ config('app.name', 'Supabitcoin') }}-->
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                 
                    
                          
                          
                        
                      
                    </ul>
                </div>
                <form class="form-inline">
              
                @if(Auth::guard('Admin')->check())

                <li class="nav-item">
              
              <a class="nav-link" href="#"><i class="fa fa-user" aria-hidden="true"></i> {{Auth::guard('Admin')->user()->name}}</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="logout"><i class="fa fa-power-off text-danger" aria-hidden="true"></i> Logout</a>
            </li>
            @elseif(Auth::check())
                <li class="nav-item">
              
              <a class="nav-link" href="#"><i class="fa fa-user" aria-hidden="true"></i> {{Auth::user()->name}}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="logout"><i class="fa fa-power-off text-danger" aria-hidden="true"></i> Logout</a>
            </li>
            @else
            <li class="nav-item">
              
              <a class="nav-link" href="registerpage">Register</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="loginpage">Login</a>
            </li>

                @endif
                
              
  </form>
            </div>
            
        </nav>

        @yield('content')
    </div>
  <!-- Vendor JS Files -->
  <script src="{{mix('js/app.js')}}"></script>
    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script>
   $(".validate-form").submit(function(e) {
     
     $('.limiter').append(`<div class="cover-spin"></div>`);
 
})



  
  </script>
</body>
</html>
