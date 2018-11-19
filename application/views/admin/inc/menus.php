<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<?php $path = base_url('assets/admin/'); ?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Menüler - Yönetim | Kirdane.Com</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $path; ?>bower_components/select2/dist/css/select2.min.css">
    <?php $this->load->view('admin/inc/header'); ?>
    <aside class="main-sidebar">
        <?php $this->load->view('admin/inc/sidebar'); ?>
    </aside>
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Menüler
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url('panel'); ?>">Anasayfa</a></li>
                <li class="active">Menüler</li>
            </ol>
        </section>
        <section class="content container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">
                                <a href="<?= base_url('panel/new/menu'); ?>" class="btn btn-primary pull-left btn-xs">
                                    <i class="fa fa-plus"></i> Menü Oluştur
                                </a><br><br><div><small>* Sıralama menü sırasına göre yapıldı.<br>** Açılır menüler silinirse sahip olduğu alt menüler de beraberinde silinir.</small></div>
                            </h3>
                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tbody>
                                <tr>
                                    <th>ID</th>
                                    <th>Başlık</th>
                                    <th>Tür</th>
                                    <th>Sıra</th>
                                    <th>Hedef</th>
                                    <th>İşlem</th>
                                </tr>
                                <?php foreach ($menus as $menu) { ?>
                                    <tr>
                                        <td><b>#<?php echo $menu->menu_id; ?></b></td>
                                        <td><?php echo $menu->menu_title; ?></td>
                                        <td>
                                            <?php $type = $menu->menu_type;
                                            if ($type == 0) {
                                                echo '<span style="padding: 5px 20px!important;" class="label label-success">Sayfa Yönlendirme</span>';
                                            }
                                            if ($type == 1) {
                                                echo '<span style="padding: 5px 20px!important;" class="label label-primary">Link Yönlendirme</span>';
                                            } elseif ($type == 2) {
                                                echo '<span style="padding: 5px 20px!important;" class="label label-warning">Mega Menü</span>';
                                            } elseif ($type == 3) {
                                                echo '<span style="padding: 5px 20px!important;" class="label label-info">Açılır Menü</span>';
                                            }
                                            ?>
                                        </td>
                                        <td><b><?php echo $menu->menu_order; ?></b></td>
                                        <td><?php echo limitChars($menu->menu_link,42, '<b>[...]</b>'); ?></td>
                                        <td>
                                            <?php if ($menu->menu_type == 3 && $menu->isMega == 0) { ?>
                                                <a class="btn btn-info btn-xs"
                                                   href="<?php echo base_url('panel/new/submenu/') . $menu->menu_id; ?>">Alt
                                                    Menü Ekle</a>
                                            <?php } ?>
                                            <a class="btn btn-primary btn-xs"
                                               href="<?php echo base_url('panel/menu/edit/') . $menu->menu_id; ?>">Düzenle</a>
                                            <a class="btn btn-danger btn-xs"
                                               href="<?php echo base_url('panel/menu/delete/') . $menu->menu_id; ?>">Sil</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">
                                <b>Alt Menüler </b><br><small>* Üst menü adına göre gruplandırıldı, sıra uygulanmadı</small>
                                </br></h3>
                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tbody>
                                <tr>
                                    <th>ID</th>
                                    <th>Başlık</th>
                                    <th>Üst Menü</th>
                                    <th>Sıra</th>
                                    <th>Hedef</th>
                                    <th>İşlem</th>
                                </tr>
                                <?php foreach ($submenus as $menu) {
                                    $toplevel = $menu->topLevel; ?>
                                    <?php if ($toplevel != 0) { ?>
                                        <tr>
                                            <td><b>#<?php echo $menu->menu_id; ?></b></td>
                                            <td><?php echo $menu->menu_title; ?></td>

                                            <td><span style="padding: 5px 20px!important;" class="label label-warning"><?php echo subMenuTitle($menu->topLevel)[0]->menu_title; ?></span></td>
                                            <td><b><?php echo $menu->menu_order; ?></b></td>
                                            <td><?php echo limitChars($menu->menu_link,55, '<b>[...]</b>'); ?></td>
                                            <td>
                                                <?php if ($menu->menu_type == 3 && $menu->isMega == 0) { ?>
                                                    <a class="btn btn-info btn-xs"
                                                       href="<?php echo base_url('panel/new/submenu/') . $menu->menu_id; ?>">Alt
                                                        Menü Ekle</a>
                                                <?php } ?>
                                                <a class="btn btn-primary btn-xs"
                                                   href="<?php echo base_url('panel/menu/edit/') . $menu->menu_id; ?>">Düzenle</a>
                                                <a class="btn btn-danger btn-xs"
                                                   href="<?php echo base_url('panel/menu/delete/') . $menu->menu_id; ?>">Sil</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
    <?php $this->load->view('admin/inc/footer'); ?>
