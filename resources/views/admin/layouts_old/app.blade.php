<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>RoadStar | @yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- start css links -->
  @include('admin.layouts.partials.css')
  <!-- end css links -->
        
  <!-- yield css of a page -->
  @yield('css')
  <!-- end css of a page -->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

   <!-- start header links -->
  @include('admin.layouts.partials.header')
  <!-- end header links -->

   <!-- start sidebar links -->
  @include('admin.layouts.partials.sidebar')
  <!-- end sidebar links -->

  <!-- each page content -->
  @yield('content')
  <!-- end each page content -->
  
   <!-- start modal links -->
  @include('admin.layouts.partials.modal_popup')
  <!-- end modal links -->

   <!-- start footer links -->
  @include('admin.layouts.partials.footer')
  <!-- end footer links -->

   <!-- start setting links -->
  @include('admin.layouts.partials.setting')
  <!-- end setting links -->


</div>
<!-- ./wrapper -->

  <!-- start css links -->
  @include('admin.layouts.partials.js')
  <!-- end css links -->
        
  <!-- yield css of a page -->
  @yield('js')
  <!-- end css of a page -->
</body>
</html>