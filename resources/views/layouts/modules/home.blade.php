<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <link rel="icon" href="../../favicon.ico">

    
    <meta name="description" content="{{$data['description']}}">        
    <meta name="keywords" content="{{$data['keywords']}}">
    <title>{{$data['title']}}</title>

    

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
  </head>

  <body>

    <nav class="navbar navbar-inverse ">
      <div class="container">
        <div class="navbar-header">
          
          <a class="navbar-brand" href="#">{{ config('app.name', 'Laravel') }}</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
          <!--
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
        -->
          </ul>
        </div>
      </div>
    </nav>

    <div class="container">
      {{$data['content']}}

      
    </div>


    <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script src="/js/bootstrap.min.js"></script>

  </body>
</html>
