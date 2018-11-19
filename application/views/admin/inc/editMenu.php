<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<?php $path = base_url('assets/admin/'); ?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="<?php echo $path; ?>bower_components/select2/dist/css/select2.min.css">
    <title>Menü Düzenle - Yönetim | Kirdane.Com</title>
    <?php $this->load->view('admin/inc/header'); ?>
    <aside class="main-sidebar">
        <?php $this->load->view('admin/inc/sidebar'); ?>
    </aside>
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Menü Düzenle
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url('panel'); ?>">Anasayfa</a></li>
                <li class="active">Menü Düzenle</li>
            </ol>
        </section>
        <br>
        <section style="padding-top: 0!important" class="content container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <form action="<?php echo base_url('panel/menu/update'); ?>" method="POST"
                              enctype="multipart/form-data">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <div class="box-body">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="#inputEmail3">Menü Başlığı</label>
                                        <input type="text" name="menu_title" required="required" class="form-control" id="inputEmail3"
                                               value="<?php echo $edit[0]->menu_title; ?>">
                                    </div>
                                </div>
                                <input style="display:none;" type="text" name="menu_id"  class="form-control" id="inputEmail3"
                                       value="<?php echo $edit[0]->menu_id; ?>">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="#inputEmail3">Menü Sıra</label>
                                        <input type="number" max="24" min="0" required="required" name="menu_order" class="form-control"
                                               id="inputEmail3" value="<?php echo  $edit[0]->menu_order; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Menü Türü</label>
                                        <select id="selBox" disabled="disabled" class="form-control select2 mega" style="width: 100%;">
                                            <option selected="selected">Menü Türü</option>
                                            <option>Sayfa Yönlendirme</option>
                                            <option>Link Yönlendirme</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-success pull-right col-md-4">Kaydet</button>
                                <a style="margin-right: 10px" href="<?php echo base_url('panel/menus'); ?>"
                                   class="btn btn-danger pull-right">İptal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php $this->load->view('admin/inc/footer'); ?>