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



    <div class="modal fade" id="modalSil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yazı Sil</h5>
                </div>
                <form action="<?php echo base_url('panel/deletePost'); ?>" method="POST">
                    <div class="modal-body">
                        <br>
                        <label for="#inputEmail3">Silinecek Yazının ID Numarası</label>
                        <input type="text" name="post_id" class="form-control" id="inputEmail3" placeholder="Yazının ID numarası">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">İptal</button>
                        <button type="submit" class="btn btn-success">Onayla</button>
                    </div>
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                </form>
            </div>
        </div>
    </div>




    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Üyeler
                <small>Toplam <?php echo $userDetail->num_rows(); ?> Üye</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url('panel'); ?>">Anasayfa</a></li>
                <li class="active">Üyeler</li>
            </ol>
        </section>

        <section class="content container-fluid">

            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tbody><tr>
                                    <th>ID</th>
                                    <th> Ad-Soyad</th>
                                    <th> e-Mail</th>
                                    <th><i> Onaysız Yayın?</i></th>
                                    <th>İşlem</th>
                                </tr>

                                <?php foreach($userDetail->result() as $user){ ?>
                                    <tr>
                                        <td><?php echo $user->user_id; ?></td>
                                        <td><?php echo html_escape($user->user_name); ?></td>
                                        <td><?php echo html_escape($user->user_email); ?></td>
                                        <td>
                                            <?php $needConfirmation = $user->needConfirmation;
                                            if($needConfirmation){
                                                echo '<a href="'.base_url('panel/').'upgrade/user/'.$user->user_id.'" class="btn btn-danger btn-xs"> Hayır</a>';
                                            }else{
                                                echo '<a href="'.base_url('panel/').'downgrade/user/'.$user->user_id.'" class="btn btn-success btn-xs"> Evet</a>';
                                            }

                                            ?>
                                        </td>


                                        <td>
                                            <a href="<?php echo base_url('panel/deleteUser/') . $user->user_id; ?>" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i> Üyeliği İptal Et</a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>

                            </table>
                            <div style="padding: 5px 10px;" class="box-tools pull-right">
                                <div class="input-group input-group-sm" style="width: 100%;">
                                    <ul class="pagination pagination-sm no-margin pull-right">

                                    </ul>

                                </div>
                            </div>
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