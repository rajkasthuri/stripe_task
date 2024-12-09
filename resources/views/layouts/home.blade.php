<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
      <title>STRIPE E-SHOP</title>
      <link rel="stylesheet" type="text/css" href="{{asset('/public/css/bootstrap.min.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('/public/css/font-awesome.css')}}">
      <link rel="stylesheet" href="{{asset('/public/css/style.css')}}">
      @yield('styles')
   </head>
   <body>
      @include('layouts.header')
      @yield('content')
      @include('layouts.footer')
   </body>
   <!-- jQuery -->
   <script src="{{asset('/public/js/jquery-2.1.0.min.js')}}"></script>
   <!-- Bootstrap -->
   <script src="{{asset('/public/js/bootstrap.min.js')}}"></script>
   @yield('script')
   <!-- Plugins -->
</html>