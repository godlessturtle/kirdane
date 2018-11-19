<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
    <!DOCTYPE html>
    <?php $path = base_url('assets/admin/'); ?>
    <html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="<?php echo $path; ?>bower_components/select2/dist/css/select2.min.css">
    <title>Anasayfa Ayarları - Yönetim | Kirdane.Com</title>
    <?php $this->load->view('admin/inc/header'); ?>
    <aside class="main-sidebar">
        <?php $this->load->view('admin/inc/sidebar'); ?>
    </aside>

    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Anasayfa Ayarları
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url('panel'); ?>">Anasayfa</a></li>
                <li class="active">Anasayfa Ayarları</li>
            </ol>
        </section>
        <br>

        <section style="padding-top: 0!important" class="content container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#activity" data-toggle="tab">Üst Slider Alanı</a></li>
                            <li><a href="#altslider" data-toggle="tab">Alt Slider</a></li>
                            <li><a href="#timeline" data-toggle="tab">Kategori Alanı</a></li>
                            <li><a href="#test" data-toggle="tab">Son Yazılar</a></li>
                        </ul>
                        <div style="min-height: 300px;" class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <div class="post">

                                    <form method="POST" action="<?php echo base_url('panel/settings/hp/update'); ?>">
                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                        <div class="col-md-6">
                                            <label for="topSlider-type">Slide Türü</label><br>
                                            <select class="select2 topslider" name="slide_type" style="width: 100%;" id="selBox">
                                                <option disabled>Tür Seçiniz</option>
                                                <?php $type = $setting[0]->top_slider_type; ?>
                                                <option>Son Yazılar</option>
                                                <option class="selected">Kategori</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Post Sayısı</label><br>
                                            <input name="postCount" min="1" max="20" value="<?php echo $setting[0]->top_slider_post_count; ?>" type="number" class="form-control">
                                        </div>
                                        <div id="cats" style="display: none;" class="col-md-6">
                                            <label for="topSlider-type">Kategoriler</label><br>
                                            <select class="select2" name="select_cat" style="width: 100%;" id="topSlider-type">
                                                <option class="selected" disabled>Kategori Seçiniz</option>
                                                <?php foreach($categories as $cat){ ?>
                                                <option value="<?php echo $cat->cat_id; ?>"><?php echo $cat->cat_name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <footer class="col-md-12"><p><b style="color:limegreen!important">DURUM</b> : <?php if($type){ echo "<b>" . getCatNameByID($setting[0]->top_slider_category)[0]->cat_name . " </b>Kategorisi"; } if(!$type){ echo "<b>Son Yazılar</b>"; } ?> Gösteriliyor.</p> <br><br>

                                            <input style="width: 25%;" class="btn btn-success pull-right" value="Güncelle" type="submit">
                                        </footer>

                                    </form>
                                </div>

                            </div>

                            <div class="tab-pane" id="altslider">
                                <div class="post">

                                    <form method="POST" action="<?php echo base_url('panel/settings/bs/update'); ?>">
                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                                        <div class="col-md-6">
                                            <label>Post Sayısı</label><br>
                                            <input name="postCount" min="4" max="48" value="<?php echo $setting[0]->bottom_slider_post_count; ?>" type="number" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="topSlider-type">Kategoriler</label><br>
                                            <select class="select2" name="select_cat" style="width: 100%;" id="topSlider-type">
                                                <option class="selected" disabled>Kategori Seçiniz</option>
                                                <?php foreach($categories as $cat){ ?>
                                                    <option value="<?php echo $cat->cat_id; ?>"><?php echo $cat->cat_name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <footer class="col-md-12"><p><b style="color:limegreen!important">DURUM</b> : <?php if(!is_null($setting[0]->bottom_slider_category)){ echo getCatNameByID($setting[0]->bottom_slider_category)[0]->cat_name . " </b>Kategorisi Gösteriliyor"; } else { echo "Seçim Yapılmadı"; } ?> .</p> <br><br>

                                            <input style="width: 25%;" class="btn btn-success pull-right" value="Güncelle" type="submit">
                                        </footer>

                                    </form>
                                </div>

                            </div>

                            <div class="tab-pane" id="timeline">

                                <form method="POST" action="<?php echo base_url('panel/settings/hp/cat'); ?>">
                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                    <div class="col-md-6">
                                        <label for="topSlider-type">Kategoriler</label><br>
                                        <select class="select2" name="cat_id" style="width: 100%;" id="topSlider-type">
                                            <option class="selected" disabled>Kategori Seçiniz</option>
                                            <?php foreach($categories as $cat){ ?>
                                                <option value="<?php echo $cat->cat_id; ?>"><?php echo $cat->cat_name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Post Sayısı</label><br>
                                        <input type="number" value="<?php echo $setting[0]->cat_section_post_count; ?>" min="2" max="16" name="post_count" class="form-control">
                                    </div>

                                    <footer class="col-md-12"><p><b style="color:limegreen!important">DURUM</b> : <?php echo "<b>".getCatNameByID($setting[0]->cat_section_category)[0]->cat_name."</b>"; ?> Kategorisi Gösteriliyor.</p> <br><br>
                                        <input style="width: 25%;" class="btn btn-success pull-right" value="Güncelle" type="submit">
                                    </footer>
                                </form>

                            </div>
                            <div class="tab-pane" id="test">

                                <form method="POST" action="<?php echo base_url('panel/settings/hp/recent'); ?>">
                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                    <div class="col-md-6">
                                        <label for="topSlider-type">Başlık</label><br>
                                        <input type="text" value="<?php echo $setting[0]->recent_posts_title; ?>" name="recent_posts_title" required="required" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Post Sayısı</label><br>
                                        <input type="number" value="<?php echo $setting[0]->recent_posts_count; ?>" min="2" max="32" name="post_count" class="form-control">
                                    </div>

                                    <footer class="col-md-12"><br><br>
                                        <input style="width: 25%;" class="btn btn-success pull-right" value="Güncelle" type="submit">
                                    </footer>
                                </form>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
    <?php $this->load->view('admin/inc/footer'); ?>
    <script>
        $("#selBox").change(function () {
            var value = $("#selBox").val();
            if(value!='Seçiniz'){
                if(value == "Son Yazılar"){
                    $("#cats").css('display','none');
                    $("#cats").val('');
                }
                if(value== "Kategori"){
                    $("#cats").css('display','block');
                }
            }else{
                alert('Slide Türü Boş Olamaz');
            }

        });
    </script>
