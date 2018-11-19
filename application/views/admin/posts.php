<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<?php $path = base_url('assets/admin/'); ?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Yazılar - Yönetim | Kirdane.Com</title>
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
        Yazılar
        <small>Toplam <?php echo $postCount; ?> Yazı</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('panel'); ?>">Anasayfa</a></li>
        <li class="active">Yazılar</li>
      </ol>
    </section>

    <section class="content container-fluid">

     <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">
              <a href="<?php echo base_url('panel/new/post'); ?>" class="btn btn-success pull-left btn-xs"> <i class="fa fa-plus"></i> Yeni Yazı Oluştur</a>
              <button style="margin-left: 20px;" type="button" class="btn btn-danger pull-right btn-xs" data-toggle="modal" data-target="#modalSil">
                <i class="fa fa-remove"></i> Yazı Sil
              </button>
            </h3>


          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tbody><tr>
                <th>ID</th>
                <th><i class="fa fa-pencil"></i> Başlık</th>
                <th><i class="fa fa-list"></i> Kategori</th>
                <th><i class="fa fa-clock-o"></i> Oluşturulma</th>
                  <th><i title="Görüntülenme Sayısı" class="fa fa-eye"></i></th>
                <th>Durum</th>
                <th><i class="fa fa-user"></i> Yazar</th>
                <th>İşlem</th>
              </tr>

              <?php foreach($posts as $post){ ?>
                <tr>
                  <td><b>#<?php echo $post->post_id; ?></b></td>
                  <td><?php echo substr(strip_tags($post->post_title), 0, 75); ?></td>
                  <td><?php echo getCatName($post->post_id)[0]->cat_name; ?></td>
                  <td><?php echo $post->createdAt; ?></td>
                    <td><?php echo $post->post_views; ?></td>
                  <?php 
                  if($post->isDraft){ $status = "Taslak"; $label = "warning"; } 
                  if(!$post->isDraft){ $status = "Yayınlandı"; $label = "success"; } 
                  ?>
                  <td><span style="padding: 5px 20px!important;" class="label label-<?php echo $label; ?>"><?php echo $status; ?></span></td>
                  <td><?php echo getAuthorInfo($post->post_author)[0]->user_name; ?></td>
                  <td>
                    <a href="<?php echo base_url('panel/edit/post/') . $post->post_id; ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Düzenle</a>
                  </td>
                </tr>
              <?php } ?>
            </tbody>

          </table>
              <div style="padding: 5px 10px;" class="box-tools pull-right">
                  <div class="input-group input-group-sm" style="width: 100%;">
                      <ul class="pagination pagination-sm no-margin pull-right">
                          <?php echo $pagination; ?>
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