<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>@yield('title')</title>

    {{-- style --}}
    @stack('prepend-style')
    {{-- @include('includes.style') --}}
    @stack('addon-style')

    <link href="{{ asset('/style/main.css') }}" rel="stylesheet"/>
    
  </head>

  <body>

    {{-- Navbar --}}
    

    {{-- Page Content --}}
    @yield('content')


    {{-- Bootstrap core JavaScript --}}
    {{-- @stack('prepend-scripts')
    @include('includes.scripts')
    @stack('addon-scripts') --}}
    
  </body>
</html>
