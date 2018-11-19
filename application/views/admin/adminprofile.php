<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Yönetici Profili | Kirdane.com</title>
    <?php $this->load->view('admin/inc/header.php'); ?>
    <aside class="main-sidebar">
        <?php $this->load->view('admin/inc/sidebar'); ?>
    </aside>

    <?php if ($this->session->userdata('adminInfo')) {
        $admin = $this->session->userdata('adminInfo');
    }
    $user = $userDetail[0];

    ?>
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Yönetici Profili
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url('panel'); ?>"><i class="fa fa-dashboard"></i> Anasayfa</a></li>
                <li class="active">Yönetici Profili</li>
            </ol>
        </section>
        <section class="content">
            <?php echo validation_errors(); ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#activity" data-toggle="tab">Bilgiler</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <form method="POST" enctype="multipart/form-data"
                                      action="<?php echo base_url('panel/adminUpdate'); ?>"
                                      class="form-horizontal">
                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-2 control-label">İsim-Soyisim</label>

                                        <div class="col-sm-10">
                                            <input type="text" required="required" class="form-control" name="user_name"
                                                   id="inputName" value="<?php echo $admin[0]->user_name; ?>"
                                                   placeholder="İsim Soyisim">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" required="required" class="form-control" id="inputEmail"
                                                   name="user_email" value="<?php echo $admin[0]->user_email; ?>"
                                                   placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail" class="col-sm-2 control-label">Yönetici Bilgisi</label>
                                        <div class="col-sm-10">
                                            <textarea name="user_detail" required="required"
                                                      placeholder="yazılarda görünecek"
                                                      style="width: 100%;">
                                              <?php echo trim($admin[0]->user_detail); ?>
                                            </textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail" class="col-sm-2 control-label">Profil Resmi</label>
                                        <div class="col-sm-10">
                                            <input type="file" name="profile_img">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail" class="col-sm-2 control-label">Arkaplan</label>
                                        <div class="col-sm-10">
                                            <input type="file" name="user_cover_img">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail" class="col-sm-2 control-label">Şifre * </label>
                                        <div class="col-sm-10">
                                            <input type="password" required="required" class="form-control"
                                                   id="inputEmail"
                                                   name="user_password" placeholder="Mevcut şifreniz">
                                        </div>
                                    </div>

                                    <small>
                                        ** Arkaplan resmi tekil yazı gösterimi sayfasında sidebarda bulunan yazar
                                        detayı alanında gösterilecek.<br>
                                        *** Değişiklikleri kayıt etmek için şifrenizi girin. <br>
                                        **** Güncellemeden sonra otomatik çıkış yapılacak.
                                    </small>
                                    <br>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-success pull-right">Güncelle</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#settings" data-toggle="tab">Şifremi Değiştir</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <form method="POST" action="<?php echo base_url('panel/admin/update/password'); ?>"
                                      class="form-horizontal">
                                       <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="password" required="required" class="form-control old_pass"
                                                   name="old_pass" id="inputName" placeholder="Mevcut Şifre">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="password" required="required" class="form-control new_pass"
                                                   id="inputEmail"
                                                   name="new_pass" placeholder="Yeni Şifre">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="password" required="required" class="form-control new_pass_re"
                                                   id="inputEmail"
                                                   name="new_pass_re" placeholder="Yeni Şifre Tekrarı">
                                        </div>
                                    </div>

                                    <small id="test"></small>

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-success">Güncelle</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#settings" data-toggle="tab">Sosyal Hesaplar</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <form method="POST" action="<?php echo base_url('panel/admin/update/social'); ?>"
                                      class="form-horizontal">
                                       <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label for=""><i class="fa fa-facebook"></i> Facebook</label>
                                            <input type="text" class="form-control"
                                                   name="user_facebook" id="inputName" value="<?php echo $user->user_facebook; ?>" placeholder="http://facebook.com/......">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label for=""><i class="fa fa-twitter"></i> Twitter</label>
                                            <input type="text" class="form-control"$user                                                 name="user_twitter" id="inputName" value="<?php echo $user->user_twitter; ?>" placeholder="http://twitter.com/......">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label for=""><i class="fa fa-instagram"></i> Instagram</label>
                                            <input type="text" class="form-control"
                                                   name="user_instagram" id="inputName" value="<?php echo $user->user_instagram; ?>" placeholder="http://instagram.com/......">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label for=""><i class="fa fa-external-link"></i> Harici Link/Websitesi</label>
                                            <input type="text" class="form-control"
                                                   name="user_external" id="inputName" value="<?php echo $user->user_external; ?>" placeholder="http://....">
                                        </div>
                                    </div>





                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-success">Güncelle</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </section>
    </div>
<?php $this->load->view('admin/inc/footer'); ?>
