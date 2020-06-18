<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Info-Sport</title>
    <!-- new -->
    <link rel="stylesheet" href="{!! asset('assets/login/vendors/mdi/css/materialdesignicons.min.css')!!}">
    <link rel="stylesheet" href="{!! asset('assets/login/vendors/base/vendor.bundle.base.css')!!}">
    <link rel="stylesheet" href="{!! asset('assets/login/css/vertical-layout-light/style.css')!!}">


    <script  type="text/javascript" src="{!! asset('assets/jquery/jquery-3.4.1.min.js') !!}"></script>
    <script src="https://kit.fontawesome.com/ee1b102e31.js" crossorigin="anonymous"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

	  	
    @yield('principal')  	
	  	

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="{!! asset('assets/js/jquery.js')!!}"></script>
    <script src="{!! asset('assets/js/bootstrap.min.js')!!}"></script>
    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="{!! asset('assets/js/jquery.backstretch.min.js')!!}"></script>
    <!-- new -->
    <script src="{!! asset('assets/login/vendors/base/vendor.bundle.base.js')!!}"></script>
    <script src="{!! asset('assets/login/js/off-canvas.js')!!}"></script>
    <script src="{!! asset('assets/login/js/hoverable-collapse.js')!!}"></script>
    <script src="{!! asset('assets/login/js/template.js')!!}"></script>
    <script src="{!! asset('assets/login/js/settings.js')!!}"></script>
    <script src="{!! asset('assets/login/js/todolist.js')!!}"></script>
    
    <script>
        $.backstretch("../assets/img/login-bg.jpg", {speed: 500});
    </script>


  </body>
</html>
