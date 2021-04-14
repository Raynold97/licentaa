<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="css/custom-style.css">

    
</head>
<body>
    
    <div id="app">
        
             @include('inc.navbar')
             
             
             <div class="container" style="padding-top:63px">
                @include('messages')
                <div style="padding-top:20px"> @yield('content')</div>
             

                
                
            
            </div>
            
           
 
    </div>
    <script>
        CKEDITOR.replace( 'article-ckeditor' );
    </script>

    
</body>
</html>
