<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title')</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="{{asset('css/wp.css')}}">
    </head>
    <body> 
        <h2>Australian Prime Ministers</h2>
        <h3>@yield('action')</h3>
        @yield('content')
    </body>
</html>