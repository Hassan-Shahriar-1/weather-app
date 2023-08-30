<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js','resources/sass/app.scss'])
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" value="{{ csrf_token() }}" />
    <!-- Latest compiled and minified CSS -->


    <title>Dashboard Weather App</title>
   
</head>
<body>
    <div id="app">
         <div>
            @yield('content')
         </div>
    </div>
    
</body>
</html>