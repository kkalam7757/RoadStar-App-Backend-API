<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ROADSTAR | Log in</title>
  @include('admin.layouts.partials.css')
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <!-- <link rel="stylesheet" href="{{ asset('admin') }}/bower_components/bootstrap/dist/css/bootstrap.min.css"> -->
  <!-- Font Awesome -->
  <!-- <link rel="stylesheet" href="{{ asset('admin') }}/bower_components/font-awesome/css/font-awesome.min.css"> -->
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('admin') }}/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <!-- <link rel="stylesheet" href="{{ asset('admin') }}/dist/css/AdminLTE.min.css"> -->
  <!-- <link rel="stylesheet" href="{{ asset('admin') }}/dist/css/style.css"> -->
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('admin') }}/plugins/iCheck/square/blue.css">
  <!-- <link rel="icon" href="{{ asset('admin') }}/dist/img/logo/logo.330eabfd.png" type="image/gif" sizes="16x16" style="background-color: red"> -->

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page" style="background-color: white;">
<div class="login-box">
  
  <!-- /.login-logo -->
  <div class="login-box-body" style="background-color: red;">
    <div class="login-logo">
    <a><img width="250" src="{{ asset('admin') }}/dist/img/logo/logo.330eabfd.png"></a>
  </div>
    <p class="login-box-msg">Sign in to your account</p>

    <form action="{{ action('AdminController\LoginController@login') }}" method="post" id="login" name="add-form-validate">
      @csrf
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" name="email" autocomplete="off">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password" autocomplete="off">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <!-- <input type="checkbox"> Remember Me -->
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-main btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

<!--     <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div> -->
    <!-- /.social-auth-links -->

    <!-- <a href="#">I forgot my password</a><br>
    <a href="register.html" class="text-center">Register a new membership</a> -->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
@include('admin.layouts.partials.js')
<!-- jQuery 3 -->
<!-- <script src="{{ asset('admin') }}/bower_components/jquery/dist/jquery.min.js"></script> -->
<!-- Bootstrap 3.3.7 -->
<!-- <script src="{{ asset('admin') }}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script> -->
<!-- iCheck -->
<script src="{{ asset('admin') }}/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
<script>
  // login
$(document).on('submit', 'form#login', function(e) {    
      e.preventDefault();
      var data = new FormData(this);

      $.ajax({
          cache:false,
          contentType: false,
          processData: false,
          url: $(this).attr("action"),
          method: $(this).attr("method"),
          dataType: "json",
          data: data,
          success: function(response) {
            if (response.success == 200) {
                toastr.success(response.message); 
                //$('div.add_form').modal('hide');
                window.location.href = "{{ url('home') }}";
            } else {
                toastr.error(response.message);
            }
          }
      }); 
});
</script>
</body>
</html>
