  <?php 
  defined('BASEPATH') OR exit('No direct script access allowed');
  $path = base_url('assets/admin/'); ?>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo $path ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $path ?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo $path ?>bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $path ?>dist/css/toastr.min.css">
  <link rel="stylesheet" href="<?php echo $path ?>dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo $path ?>dist/css/skins/skin-blue.min.css">
  <link rel="icon" type="image/png" href="<?php echo base_url('assets/images/mini-logo-dark.png'); ?>">
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet"
href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

      <!-- Logo -->
      <a href="<?php echo base_url('panel'); ?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><img src="<?php echo base_url('assets/images/mini-logo-light.png'); ?>"></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><img style="margin-top: -10px" src="<?php echo base_url('assets/images/logo-light.png'); ?>"></span>
      </a>

      <!-- Header Navbar -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">

          
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img style="object-fit: cover;min-height: 32px;
    min-width: 32px;" src="<?php
              if($this->session->userdata('adminInfo')){
                echo base_url($this->session->userdata('adminInfo')[0]->user_img);
              }
              ?>" class="user-image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">
                <?php  
                if($this->session->userdata('adminInfo')){
                  echo $this->session->userdata('adminInfo')[0]->user_name;
                }
                ?>
              </span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img style="min-height: 48px;
    min-width: 48px;
    object-fit: cover;" src=" <?php
                if($this->session->userdata('adminInfo')){
                  echo base_url($this->session->userdata('adminInfo')[0]->user_img);
                }
                ?>" class="img-circle" >
                <p>
                 <?php  
                 if($this->session->userdata('adminInfo')){
                  echo $this->session->userdata('adminInfo')[0]->user_name;
                }
                ?>
              </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a href="<?php echo base_url('panel/profile'); ?>" class="btn btn-default btn-flat">Profilim</a>
              </div>
              <div class="pull-right">
                <a href="<?php echo base_url('panel/logout'); ?>" class="btn btn-default btn-flat">Çıkış Yap</a>
              </div>
            </li>
          </ul>
        </li>

      </ul>
    </div>
  </nav>
</header>