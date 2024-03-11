<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <link rel="icon" type="image/png" href="{{asset('images/logo_erp.png')}}">
  <title>ERP</title>

  @include('layouts.styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">

    @yield('content')
  
@include('layouts.scripts')
@yield('scripts')
</body>
</html>

