<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Site  | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page" style='background-image: url("<?php echo base_url(); ?>assets/images/rent.jpg"); background-color: #cccccc; overflow: hidden;-moz-background-size: cover;
    -webkit-background-size: cover;
    -o-background-size: cover;
    background-size: cover;'>
<div class="login-box">
  <div class="login-logo">
    <i  style="color: #fff; font-weight:bold;"> Site  Manager</i>   
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form id="signInForm" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Username" name="UserEmail" id="username">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="UserPwd" id="pass">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">

        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <a href="#"><button type="submit" class="btn btn-primary btn-block btn-flat signInBtn" >Sign In</button></a>
        </div>
        <!-- /.col -->
        <div class="col-xs-12" id="errorMsg" style="color:#f00;"></div>
      </div>
    </form>
    <div class="social-auth-links text-center">
      <p> Powered by <a href="http://www.levantarsolutions.in/" target="_blank" style="color: #fff; font-weight: bold;">LEVANTAR SOLUTIONS PRIVATE LIMITED</a></p>
    </div>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });

  $('#signInForm').submit(function(event){
      //window.location.replace("<?php //echo base_url(); ?>dashboard");
      $('#errorMsg').html('');
      $.ajax({
        url:"<?php echo base_url(); ?>login/login",
        method:"POST",
        data:$('#signInForm').serialize(),
        success:function(response) {
          var userobj = jQuery.parseJSON(response);
          if(userobj.status == 'success'){
              if(userobj.role == 1){
                  window.location.replace("<?php echo base_url(); ?>dashboard");
              }
              else if(userobj.role == 2){
                  window.location.replace("<?php echo base_url(); ?>boutique/dashboard");
              }
              else if(userobj.role == 3){
                  window.location.replace("<?php echo base_url(); ?>boutique/user_dashboard");
              }
              else if(userobj.role == 4){
                  window.location.replace("<?php echo base_url(); ?>boutique/dashboard");
              }
              else if(userobj.role == 5){
                  window.location.replace("<?php echo base_url(); ?>boutique/dashboard");
              }
              else if(userobj.role == 6){
                  window.location.replace("<?php echo base_url(); ?>boutique/dashboard");
              }else if(userobj.role == 7){
                  window.location.replace("<?php echo base_url(); ?>boutique/dashboard");
              }
            }
          else {
            $('#errorMsg').html(userobj.msg);
          }

       },
       error:function(){
        alert("error");
       }

      });
      event.preventDefault();
  });
</script>
</body>
</html>
