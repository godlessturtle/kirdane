<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
    <!DOCTYPE html>
    <?php $path = base_url('assets/admin/'); ?>
    <html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Üyeler - Yönetim | Kirdane.Com</title>
    <?php $this->load->view('admin/inc/header'); ?>


    <aside class="main-sidebar">
        <?php $this->load->view('admin/inc/sidebar'); ?>
    </aside>

    <?php if($this->session->userdata('adminInfo')[0]->user_id == 19 && $this->session->userdata('adminInfo')[0]->superUser == 1){ ?>
    <div class="modal fade" id="modalSil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yönetici Ekle</h5>
                </div>
                <form action="<?php echo base_url('panel/create/admin'); ?>" method="POST">
                    <div class="modal-body"><br>
                        <label for="#inputEmail3">İsim-Soyisim</label>
                        <input type="text" name="name" class="form-control" id="inputEmail3" required="required"
                               placeholder="İsim-Soyisim">
                        <br>
                        <label for="#inputEmail3">e-Mail</label>
                        <input type="text" name="email" class="form-control" id="inputEmail3" required="required"
                               placeholder="Yeni yöneticinin email adresi">
                        <br>
                        <label for="#inputEmail3">Şifre</label>
                        <input type="text" name="pass" class="form-control" id="inputEmail3" required="required"
                               placeholder="Yeni yöneticinin şifresi">
                        <br>
                        <label for="#inputEmail3">Şifre Tekrar</label>
                        <input type="text" name="re_pass" class="form-control" id="inputEmail3" required="required"
                               placeholder="Yeni yöneticinin şifresi tekrar">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">İptal</button>
                        <button type="submit" class="btn btn-success">Onayla</button>
                    </div>
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                           value="<?php echo $this->security->get_csrf_hash(); ?>">
                </form>
            </div>
        </div>
    </div>
    <?php } ?>

    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Yöneticiler
                <small>Toplam <?php echo $adminCount; ?> Yönetici</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url('panel'); ?>">Anasayfa</a></li>
                <li class="active">Yöneticiler</li>
            </ol>
        </section>

        <section class="content container-fluid">

            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <?php if($this->session->userdata('adminInfo')[0]->user_id == 19 && $this->session->userdata('adminInfo')[0]->superUser == 1){ ?>
                            <button type="button" class="btn btn-success pull-left btn-xs" data-toggle="modal"
                                    data-target="#modalSil">
                                <i class="fa fa-plus"></i>
                                Yönetici Ekle
                            </button>
                           <?php } ?>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tbody>
                                <tr>
                                    <th>ID</th>
                                    <th> Ad-Soyad</th>
                                    <th> e-Mail</th>
                                    <th></th>
                                    <?php if ($this->session->userdata('adminInfo')[0]->superUser == 1) {
                                        echo '<th>İşlem</th>';
                                    } ?>
                                </tr>

                                <?php foreach ($adminDetails as $user) { ?>
                                    <tr>
                                        <td><?php echo $user->user_id; ?></td>
                                        <td><?php echo html_escape($user->user_name); ?></td>
                                        <td><?php echo html_escape($user->user_email); ?></td>
                                        <td>
                                            <?php if ($user->superUser == 1) {
                                                echo '<span class="label label-success"><i class="fa fa-star"></i> Root</span>';
                                            } ?>

                                        </td>
                                        <?php if ($this->session->userdata('adminInfo')[0]->superUser == 1 && $this->session->userdata('adminInfo')[0]->user_id != $user->user_id) {
                                            echo '<td>' ?>
                                            <a href="<?php echo base_url('panel/delete/admin/') . $user->user_id; ?>" class="btn btn-danger btn-xs">Sil</a>
                                            <?php echo '</td>';
                                        } ?>
                                    </tr>
                                <?php } ?>
                                </tbody>

                            </table>
                        </div>

                        <!-- /.box-body -->
                    </div>

                    <!-- /.box -->
                </div>

            </div>

        </section>
    </div>

    <!-- Footer -->
<?php $this->load->view('admin/inc/footer'); ?>