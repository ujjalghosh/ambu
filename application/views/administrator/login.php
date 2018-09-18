<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
//$this->load->view('includes/header');
$error=$this->session->flashdata('login_error');
$info=array();
if(isset($dyc_email)){
$info=explode ('^',$dyc_email);
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/administrator/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/administrator/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/administrator/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/administrator/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/administrator/plugins/iCheck/square/blue.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/administrator/dist/css/validationEngine.jquery.min.css" type="text/css"/>
   

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
 <?=isset($error) ? $error : ''?>
    <p class="login-box-msg">Sign in to start your session</p>
    <form action="<?php echo site_url('administrator/Login/validate_credentials') ?>" id="my_form1" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="user Name" value="<?=(!empty($this->input->cookie('login_user')) ? $this->input->cookie('login_user') : '')?>" name="username" id="username" data-validation-engine="validate[required]">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>        
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" value="<?=(!empty($this->input->cookie('login_pass')) ? $this->input->cookie('login_pass') : '')?>" name="password"  data-validation-engine="validate[required]">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>        
      </div>

      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <label><input type="checkbox" name="rem_me" id="remember" value="1" <?=(!empty($this->input->cookie('remember_me')) && $this->input->cookie('remember_me')=='1' ? 'checked' : '')?>  /><span class="overlay"></span> Remember me</label>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" id="click_form" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <!-- /.social-auth-links -->

    <a href="#">I forgot my password</a><br>
   <!--  <a href="register.html" class="text-center">Register a new membership</a> -->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?php echo base_url();?>assets/administrator/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/administrator/dist/js/jquery.validationEngine.js"></script>
<script src="<?php echo base_url();?>assets/administrator/dist/js/jquery.validationEngine-en.js"></script>


<script>
            
    // This method is called right before the ajax form validation request
    // it is typically used to setup some visuals ("Please wait...");
    // you may return a false to stop the request 
    function beforeCall(form, options){
      if (window.console) 
      console.log("Right before the AJAX form validation call");
      return true;
    }
            
    // Called once the server replies to the ajax form validation request
    function ajaxValidationCallback(status, form, json, options){
       alert(status);
      if (window.console) 
      console.log(status);
                
      if (status === true) {
        alert("the form is valid!");
        // uncomment these lines to submit the form to form.action
        // form.validationEngine('detach');
        // form.submit();
        // or you may use AJAX again to submit the data
      }
    }
            
    jQuery(document).ready(function(){
      jQuery("#my_form1").validationEngine({
        //ajaxFormValidation: true,
         //onAjaxFormComplete: ajaxValidationCallback
      });
    });
  </script>

<style type="text/css">
.errorMessage {
    color: red;
    background-color: #FEEFB3;
}
</style>





<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url();?>assets/administrator/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url();?>assets/administrator/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
