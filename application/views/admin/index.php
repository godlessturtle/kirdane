<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<?php $path = base_url('assets/admin/'); ?>
<html>
<head><meta name="robots" content="noindex, nofollow">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Anasayfa - Yönetim | Kirdane.Com</title>
  <?php $this->load->view('admin/inc/header'); ?>
  <aside class="main-sidebar">
    <?php $this->load->view('admin/inc/sidebar'); ?>
  </aside>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Genel Bakış
      </h1>
      <ol class="breadcrumb">
        <li class="active">Anasayfa</li>
      </ol>
    </section>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3><?php echo $getPostCount; ?></h3>

                        <p>Yazı</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-pencil"></i>
                    </div>
                    <a href="<?php echo base_url('panel/posts'); ?>" class="small-box-footer">Tümünü Gör <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?php echo $categoryCount; ?></h3>

                        <p>Kategori</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-list"></i>
                    </div>
                    <a href="<?php echo base_url('panel/categories'); ?>" class="small-box-footer">Tümünü Gör <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3><?php echo $getUsersCount; ?></h3>

                        <p>Üye</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <a href="<?php echo base_url('panel/users'); ?>" class="small-box-footer"><i class="fa fa-arrow-circle-right"></i> Tümünü Gör</a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3><?php echo $adminCount; ?></h3>

                        <p>Yönetici</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user-plus"></i>
                    </div>
                    <a href="<?php echo base_url('panel/admins'); ?>" class="small-box-footer">Tümünü Gör <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>

  </section>
</div>
<!-- Footer -->
<?php $this->load->view('admin/inc/footer'); ?>