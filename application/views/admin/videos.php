<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Aslan
 * Date: 10.10.2018
 * Time: 09:47
 */
?><!DOCTYPE html>
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
                    <h5 class="modal-title" id="exampleModalLabel">Video Ekle</h5>
                </div>
                <form action="<?php echo base_url('panel/add/video'); ?>" method="POST">
                    <div class="modal-body"><br>
                        <label for="#inputEmail3">Video Başlığı</label>
                        <input type="text" name="video_title" class="form-control" id="inputEmail3" required="required">
                        <br>
                        <label for="#inputEmail3">Youtube Video Kimliği</label>
                        <input type="text" name="video_yt_id" class="form-control" id="inputEmail3" required="required" placeholder="S2tXxKHoZuU">
                        <br><br>
                            *Youtube kimliği bir youtube videosunun URL adresindeki <b>?v=</b> parametresinden sonra bulunan değerdir.
                            <br>
                            ** Video bir listeye ait ise <b>?v=</b> ile <b>&list</b> parametreleri arasındaki değer geçerlidir.
                            <br>

                        <br>
                            <h4>Normal Video Url</h4>

                            https://www.youtube.com/watch?v=<span style="color:green">S2tXxKHoZuU</span>
                        <br><br>
                            <h4>Liste Videosu</h4>
                            https://www.youtube.com/watch?v=<span style="color:green">S2tXxKHoZuU</span>&list=RDt2Vv8E-py5k&index=8
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
                Videolar
                <small>Toplam <?php echo $videos->num_rows; ?> video</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url('panel'); ?>">Anasayfa</a></li>
                <li class="active">Videolar</li>
            </ol>
        </section>

        <section class="content container-fluid">

            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <button type="button" class="btn btn-success pull-left btn-xs" data-toggle="modal" data-target="#modalSil">
                                <i class="fa fa-plus"></i>
                                Video Ekle
                            </button>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tbody><tr>
                                    <th>Satır ID</th>
                                    <th>Başlık</th>
                                    <th>Video ID</th>
                                    <th>İşlem</th>
                                </tr>

                                <?php foreach($videos->result() as $vid){ ?>
                                    <tr>
                                        <td>#<?php echo $vid->video_id; ?></td>
                                        <td><?php echo html_escape($vid->video_title); ?></td>
                                        <td><?php echo html_escape($vid->video_yt_id); ?></td>
                                        <td><a href="<?php echo base_url('panel/delete/video/') . $vid->video_id; ?>" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i> Sil</a></td>
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
