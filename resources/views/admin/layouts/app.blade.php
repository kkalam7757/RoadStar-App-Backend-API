<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>ROADSTAR | @yield('title')</title>
  


 <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- start css links -->
        @include('admin.layouts.partials.css')
        <!-- end css links -->
        
        <!-- yield css of a page -->
        @yield('css')
        <!-- end css of a page -->

</head>
<body class="hold-transition skin-blue sidebar-mini fixed">
    <div class="wrapper">

        <!-- start header -->
        @include('admin.layouts.partials.header')
		<!-- end header -->	


		<!-- start sidebar menu -->
         @include('admin.layouts.partials.sidebar')
		<!-- end sidebar menu -->
        
        <!-- start Content of a page -->
	    @yield('content')
        <!-- end Content of a page -->
	    
        <!-----------------modal--------------------->
        @include('admin.layouts.partials.modal_popup')
        <!--------end---------->
		
		<!-- start footer -->
		 @include('admin.layouts.partials.footer')
		<!-- end footer -->

	    <!-- start js include path -->
	    @include('admin.layouts.partials.js')
	    <!-- end js include path -->

	    <!-- yield js of a page -->
        @yield('js')
        <!-- end js of a page -->


</div>
</body>

</html>

