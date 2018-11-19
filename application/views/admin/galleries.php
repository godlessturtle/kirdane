


<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<?php $path = base_url('application/assets/admin/'); ?>
<html>
<head>
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
                Galeri - Henüz Bitmedi
                <small>Düzenlemek için resme tıkla</small>
            </h1>
            <ol class="breadcrumb">
                <li class="active">Anasayfa</li>
                <li>Galeri</li>
            </ol>
        </section>
        <section class="content container-fluid">
            <div class="box">
                <div class="timeline-item">

                    <div class="timeline-body">
                        <?php foreach($gallery->result() as $img){ ?>
                        <a href=""><img style="height: 100px; width: 150px; max-width: 150px; max-height: 100px; object-fit: cover;" src="http://placehold.it/150x100" class="margin"></a>
                        <?php } ?>
                    </div>
                </div>
            </div>


        </section>
    </div>
    <!-- Footer -->
<?php $this->load->view('admin/inc/footer'); ?>