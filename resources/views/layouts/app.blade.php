<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Info-Sport</title>

    <!-- Bootstrap core CSS -->
    <link href="{!! asset('assets/css/bootstrap.css') !!}" rel="stylesheet">
    <!--external css-->
    <link href="{!! asset('assets/font-awesome/css/font-awesome.css')!!}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{!! asset('assets/css/zabuto_calendar.css')!!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('assets/js/gritter/css/jquery.gritter.css')!!}" />
    <link rel="stylesheet" type="text/css" href="{!! asset('assets/lineicons/style.css')!!}">    
    
    <!-- Custom styles for this template -->
    <link href="{!! asset('assets/css/style.css') !!}" rel="stylesheet">
    <link href="{!! asset('assets/css/style-responsive.css') !!}" rel="stylesheet">

    <script src="{!! asset('assets/js/chart-master/Chart.js') !!}"></script>
    <script src="{!! asset('assets/js/custom.js') !!}"></script>
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body onload="nobackbutton();">

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      @include('layouts.header')
      <!--header end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      @include('layouts.sidebar')
      <!--sidebar end-->


      {{-- Content --}}
      <section id="main-content">
        <section class="wrapper">
          @yield('content')    
        </section>
      </section>              

      {{-- Content end --}}

      <!--footer start-->
      @include('layouts.footer')
      <!--footer end-->
  </section>

    
    <!-- js placed at the end of the document so the pages load faster -->
    <script src="{!! asset('assets/js/jquery.js')!!}"></script>
    <script src="{!! asset('assets/js/jquery-1.8.3.min.js')!!}"></script>
    <script src="{!! asset('assets/js/bootstrap.min.js')!!}"></script>
    <script class="include" type="text/javascript" src="{!! asset('assets/js/jquery.dcjqaccordion.2.7.js')!!}"></script>
    <script src="{!! asset('assets/js/jquery.scrollTo.min.js')!!}"></script>
    <script src="{!! asset('assets/js/jquery.nicescroll.js')!!}" type="text/javascript"></script>
    <script src="{!! asset('assets/js/jquery.sparkline.js')!!}"></script>


    <!--common script for all pages-->
    <script src="{!! asset('assets/js/common-scripts.js')!!}"></script>
    
    <script type="text/javascript" src="{!! asset('assets/js/gritter/js/jquery.gritter.js')!!}"></script>
    <script type="text/javascript" src="{!! asset('assets/js/gritter-conf.js')!!}"></script>

    <!--script for this page-->
    <script src="{!! asset('assets/js/sparkline-chart.js')!!}"></script>    
    <script src="{!! asset('assets/js/zabuto_calendar.js')!!}"></script>    
    
    {{-- Welcome/Notificacion flotante --}}    
    @yield('header')
    {{-- Welcome/Notificacion flotante --}}
    
    <script type="application/javascript">
        $(document).ready(function () {
            $("#date-popover").popover({html: true, trigger: "manual"});
            $("#date-popover").hide();
            $("#date-popover").click(function (e) {
                $(this).hide();
            });
        
            $("#my-calendar").zabuto_calendar({
                action: function () {
                    return myDateFunction(this.id, false);
                },
                action_nav: function () {
                    return myNavFunction(this.id);
                },
                ajax: {
                    url: "show_data.php?action=1",
                    modal: true
                },
                legend: [
                    {type: "text", label: "Special event", badge: "00"},
                    {type: "block", label: "Regular event", }
                ]
            });
        });
        
        
        function myNavFunction(id) {
            $("#date-popover").hide();
            var nav = $("#" + id).data("navigation");
            var to = $("#" + id).data("to");
            console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
        }
    </script>
    @section('script')
    @show
  
  </body>
</html>
<style>
  {{-- Para los bordes de los formularios --}}
    .formi{
        padding-top:25px;
        padding-left:25px;
        padding-right:25px; 
        padding-bottom: 10px; 
    }
    /*para remarcar los * como campo requerido*/
    .req{
        color:red;
    }
</style>
