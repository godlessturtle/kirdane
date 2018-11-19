<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="robots" content="noindex, nofollow">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Giriş Yap | Kirdane.com</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url('assets/admin/'); ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/admin/'); ?>bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/'); ?>dist/css/toastr.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/admin/'); ?>dist/css/AdminLTE.min.css">
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body style="height: auto!important" class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url('assets/images/logo1.png'); ?>"></a>
    </div>
    <div class="login-box-body">
      <form action="<?php echo base_url('panel/login/finish'); ?>" method="post">
          <!-- Kirdane CSRF Protect Start -->
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
          <!-- Kirdane CSRF Protect End -->
        <div class="form-group has-feedback">
          <input type="email" class="form-control" required="required" name="email" placeholder="e-Mail Adresi">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" name="password" required="required" class="form-control" placeholder="Şifre">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <div style="padding:0!important" class="col-md-4 col-sm-4 col-xs-4">
            <?php echo $captcha['image']; ?>
          </div>
          <div style="padding:0!important" class="col-md-7 col-sm-6 col-xs-6 pull-right">
            <input type="text" name="cap_code" minlength="6" maxlength="6" required="required" style="height: 40px!important" class="form-control col-md-8" placeholder="Doğrulama Kodu">
            <span style="line-height: 42px;" class="fa fa-qrcode fa-2x form-control-feedback"></span>
          </div>
        </div>
        <br><br><br>
        <div class="row">
          <div class="col-xs-12 col-md-6">
            <a style="margin-bottom: 10px;" href="<?php echo base_url(); ?>" class="btn btn-warning btn-block btn-flat"><i class="glyphicon glyphicon-home"></i> Anasayfaya</a>
          </div>
          <div class="col-xs-12 col-md-6">
            <button style="margin-bottom: 10px;" type="submit" class="btn btn-success btn-block btn-flat"><i class="fa fa-sign-in"></i> Giriş Yap</button>            
          </div>
        </div>
      </form>
    </div>
  </div>
  <script src="<?php echo base_url('assets/admin/'); ?>bower_components/jquery/dist/jquery.min.js"></script>
  <script src="<?php echo base_url('assets/admin/'); ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url('assets/admin/'); ?>dist/js/toastr.js"></script>
  <?php echo $this->session->flashdata('logStatus'); ?>
  <?php echo $this->session->flashdata('captchaStatus'); ?>
  <?php echo validation_errors(); ?>
</body>
</html>
