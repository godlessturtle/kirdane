<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<?php $path = base_url('assets/admin/'); ?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="<?php echo $path; ?>bower_components/select2/dist/css/select2.min.css">
    <title>Alt Menü Oluştur - Yönetim | Kirdane.Com</title>
    <?php $this->load->view('admin/inc/header'); ?>
    <aside class="main-sidebar">
        <?php $this->load->view('admin/inc/sidebar'); ?>
    </aside>
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Alt Menü Oluştur
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url('panel'); ?>">Anasayfa</a></li>
                <li class="active">Alt Menü Oluştur</li>
            </ol>
        </section>
        <br>
        <section style="padding-top: 0!important" class="content container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form action="<?php echo base_url('panel/submenu/submit'); ?>" method="POST"
                              enctype="multipart/form-data">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <div class="box-body">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="#inputEmail3">Menü Başlığı</label>
                                        <input type="text" name="menu_baslik" class="form-control" id="inputEmail3"
                                               placeholder="Kullanıcının göreceği başlık">
                                    </div>
                                </div>
                                <input style="display:none;" type="text" name="topLevel" class="form-control" id="inputEmail3"
                                       value="<?php echo $this->uri->segment(4); ?>">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="#inputEmail3">Menü Sıra</label>
                                        <input type="number" max="24" min="0" name="menu_sira" class="form-control"
                                               id="inputEmail3" placeholder="1,2,3....">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Menü Türü</label>
                                        <select id="selBox" name="menuTuru" class="form-control select2 mega" style="width: 100%;">
                                            <option selected="selected">Menü Türü</option>
                                            <option>Sayfa Yönlendirme</option>
                                            <option>Link Yönlendirme</option>
                                        </select>
                                    </div>
                                </div>
                                <div id="ttes" style="display:none;" class="col-md-6 form-group kategori">
                                    <label>Sayfalar</label>
                                    <select name="sayfalar" class="form-control select2" style="width: 100%;">
                                        <option class="selected"></option>
                                        <?php foreach ($pages as $page) { ?>
                                            <option id="<?php echo $page->page_id; ?>"><?php echo $page->page_title; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div id="linkYonlendirme" style="display:none;" class="col-md-6 form-group kategori">
                                    <label>Link Yönlendirme</label>
                                    <input type="text" name="linkyonlendirme" class="form-control" id="inputEmail3"
                                           placeholder="http:// ile başlayan bir link belirtin.">
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
    <script>
        $("#selBox").change(function () {

            var inputVal = $(this).val();
            if (inputVal == "Sayfa Yönlendirme") {
                $("#linkYonlendirme").css('display', 'none');
                $("#linkYonlendirme").val("");
                $("#ttes").css('display', 'block');
                $("#megaMenu").css('display', 'none');
                $("#megaMenu").val("");
            }
            if (inputVal == "Link Yönlendirme") {
                $("#linkYonlendirme").css('display', 'block');
                $("#ttes").css('display', 'none');
                $("#ttes").val("");
                $("#megaMenu").css('display', 'none');
                $("#megaMenu").val("");
            }
            if (inputVal == "Mega Menü") {
                $("#linkYonlendirme").css('display', 'none');
                $("#linkYonlendirme").val("");
                $("#ttes").css('display', 'none');
                $("#ttes").val("");
                $("#megaMenu").css('display', 'block');

            }
            if (inputVal == "Açılır Menü") {
                $("#linkYonlendirme").css('display', 'none');
                $("#linkYonlendirme").val("");
                $("#ttes").css('display', 'none');
                $("#ttes").val("");
                $("#megaMenu").css('display', 'none');
            }
            if (inputVal == "Menü Türü") {
                $("#linkYonlendirme").css('display', 'none');
                $("#linkYonlendirme").val("");
                $("#ttes").css('display', 'none');
                $("#ttes").val("");
                $("#megaMenu").css('display', 'none');
                $("#megaMenu").val("");

            }
        });
    </script>