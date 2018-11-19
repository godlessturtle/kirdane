 <section class="sidebar">
  <?php 
  defined('BASEPATH') OR exit('No direct script access allowed');
  $path = base_url('assets/admin/'); ?>
  <div class="user-panel">
    <div class="pull-left image">
      <img style="height: 100%;min-height: 48px;object-fit: cover;" src="<?php
        if($this->session->userdata('adminInfo')){
          echo base_url($this->session->userdata('adminInfo')[0]->user_img);
        }
        ?>" class="img-circle">
    </div>
    <div class="pull-left info">
      <p>
        <?php  
        if($this->session->userdata('adminInfo')){
          echo $this->session->userdata('adminInfo')[0]->user_name;
        }
        ?>
      </p>
      <!-- Status -->
      <a href="javascript:void(0);"><i class="fa fa-circle text-success"></i>
        <?php  
        if($this->session->userdata('adminInfo')[0]->user_permission){
          if($this->session->userdata('adminInfo')[0]->user_permission == 121){
            echo "Yönetici";
          }
        }
        ?>
      </a>
    </div>
  </div>

  <!-- search form (Optional) -->

  <!-- /.search form -->

  <!-- Sidebar Menu -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header">Menü</li>
    <!-- Optionally, you can add icons to the links -->
    <li class="active"><a href="<?php echo base_url('panel') ?>"><i class="fa fa-home text-red"></i> <span>Anasayfa</span></a></li>
     <li class="treeview">
      <a href="#"><i class="fa fa-file-text text-green"></i> <span>Yazılar</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="<?php echo base_url('panel/posts'); ?>"> <i class="fa fa-circle-o text-blue"></i>Tümünü Görüntüle</a></li>
        <li><a href="<?php echo base_url('panel/create/post'); ?>"> <i class="fa fa-circle-o text-yellow"></i>Yeni Oluştur</a></li>
      </ul>
    </li>
    <li><a href="<?php echo base_url('panel/categories'); ?>"><i class="fa fa-list text-light-blue"></i> <span>Kategoriler</span></a></li>
    <li><a href="<?php echo base_url('panel/menus'); ?>"><i class="fa fa-bars text-green"></i> <span>Menüler</span></a></li>
    <li class="treeview">
      <a href="#"><i class="fa fa-file text-light-blue"></i> <span>Sayfalar</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="<?php echo base_url('panel/new/page'); ?>"><i class="fa fa-circle-o text-blue"></i>Yeni Oluştur</a></li>
        <li><a href="<?php echo base_url('panel/pages'); ?>"><i class="fa fa-circle-o text-green"></i>Tümünü Görüntüle</a></li>
      </ul>
    </li>
      <li class="treeview">
          <a href="#"><i class="fa fa-comments text-green"></i> <span>Yorumlar</span>
              <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
          </a>
          <ul class="treeview-menu">
              <li><a href="<?php echo base_url('panel/comments/approved'); ?>"><i class="fa fa-circle-o text-blue"></i>Yayınlananlar</a></li>
              <li><a href="<?php echo base_url('panel/comments/waiting'); ?>"><i class="fa fa-circle-o text-green"></i>Onay Bekleyenler <span class="label label-warning pull-right"><?php echo unApprovedComments(); ?></span></a></li>
          </ul>
      </li>
      <li><a href="<?php echo base_url('panel/sidebar/videos') ?>"><i class="fa fa-file-video-o text-light-blue"></i> <span>Videolar</span></a></li>
      <li><a href="<?php echo base_url('panel/users') ?>"><i class="fa fa-users text-green"></i> <span>Üyeler</span></a></li>
      <li><a href="<?php echo base_url('panel/admins') ?>"><i class="fa fa-user-plus text-light-blue"></i> <span>Yöneticiler</span></a></li>





    <li class="treeview">
      <a href="#"><i class="fa fa-cogs text-yellow fa-spin"></i> <span>Ayarlar</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="<?php echo base_url('panel/settings'); ?>"><i class="fa fa-circle-o text-blue"></i>Genel Ayarlar</a></li>
        <li><a href="<?php echo base_url('panel/settings/footer'); ?>"><i class="fa fa-circle-o text-green"></i>Footer Ayarları</a></li>
          <li><a href="<?php echo base_url('panel/settings/homepage'); ?>"><i class="fa fa-circle-o text-yellow"></i>Anasayfa Ayarları</a></li>
      </ul>
    </li>
  </ul>
  <!-- /.sidebar-menu -->
</section>