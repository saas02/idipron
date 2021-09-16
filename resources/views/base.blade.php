<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Prueba Sergio Amaya - saas02@gmail.com</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans:400,600" rel="stylesheet">
        

        <!-- Styles -->
        <link rel="stylesheet" href="/css/style.css">

        <!-- Bootstrap core CSS -->        
        <link href="/css/bootstrap.css" rel="stylesheet"/>
        <!--external css-->
        <link href="/font-awesome/css/font-awesome.css" rel="stylesheet"/>
        <link href="/css/zabuto_calendar.css" rel="stylesheet"/>
        <link href="/js/gritter/css/jquery.gritter.css" rel="stylesheet"/>
        <link href="/lineicons/style.css" rel="stylesheet"/>                  

        <!-- Custom styles for this template -->        
        <link href="/css/style.css" rel="stylesheet"/>        
        <link href="/css/style-responsive.css" rel="stylesheet"/>

        <script src="/js/chart-master/Chart.js"></script>
        
    </head>

    <body class="is-boxed has-animations">
        
        @yield('content')
        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
        <script>
            var close_url = "/cerrar";
            var users_view_url = "/ver/usuarios";
            var inventory_view_url = "/ver/productos";  
            var api_url = "/";
        </script>
    
        <script type="module" src="/js/common-functions.js"></script> 
                
        <!-- js placed at the end of the document so the pages load faster -->    
        <script src="/js/jquery.js"></script>    
        <script src="/js/jquery-1.8.3.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>

        <script class="include" type="text/javascript" src="/js/jquery.dcjqaccordion.2.7.js"></script>    
        <script src="/js/jquery.scrollTo.min.js"></script>    
        <script src="/js/jquery.nicescroll.js" type="text/javascript"></script>    
        <script src="/js/jquery.sparkline.js"></script>


        <!--common script for all pages-->    
        <script src="/js/common-scripts.js"></script>    

        <script type="text/javascript" src="/js/gritter/js/jquery.gritter.js"></script>    
        <script type="text/javascript" src="/js/gritter-conf.js"></script>    

        <!--script for this page-->    
        <script src="/js/sparkline-chart.js"></script>    
        <script src="/js/zabuto_calendar.js"></script>    	

        <script type="text/javascript">
            $(document).ready(function () {
                
            });
        </script>

        <script type="application/javascript">
            $(document).ready(function () {
            
            });


            function myNavFunction(id) {
                $("#date-popover").hide();
                var nav = $("#" + id).data("navigation");
                var to = $("#" + id).data("to");
                console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
            }
        </script>
    </body>

</html>
