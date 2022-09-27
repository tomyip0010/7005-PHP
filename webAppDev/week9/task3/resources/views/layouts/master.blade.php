<html>
  <head>
    <title>@yield('title')</title>
    <link href="{{asset('app.css')}}" type="text/css" rel="stylesheet">
  </head>
  <body>
    @auth     <!--- user is logged in --->

      {{Auth::user()->name}}
      <form method="POST" action= "{{url('/logout')}}">
        {{csrf_field()}}
        <input type="submit" value="Logout">
      </form>
    @else <!--- user is not logged in --->
      <a href="{{ route('login') }}">Login</a>
      <a href="{{ route('register') }}">Register</a>           
    @endauth
    @yield('content')
  </body>
</html>