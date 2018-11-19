<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<?php $path = base_url('application/assets/admin/'); ?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sayfalar - Yönetim | Kirdane.Com</title>
  <?php $this->load->view('admin/inc/header'); ?>


  <aside class="main-sidebar">
    <?php $this->load->view('admin/inc/sidebar'); ?>
  </aside>
  <div class="modal fade" id="modalSil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Sayfayı Sil</h5>
        </div>
        <form action="<?php echo base_url('panel/delete/page'); ?>" method="POST">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
          <div class="modal-body">
            <br>
            <label for="#inputEmail3">Silinecek Sayfanın ID Numarası</label>
            <input type="text" name="page_id" required="required" class="form-control" id="inputEmail3" placeholder="Sayfa ID numarası">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-dismiss="modal">İptal</button>
            <button type="submit" class="btn btn-success">Onayla</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Sayfalar
        <small>Toplam <?php echo $pages->num_rows(); ?> Sayfa</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('panel'); ?>">Anasayfa</a></li>
        <li class="active">Sayfalar</li>
      </ol>
    </section>

    <section class="content container-fluid">

     <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">
              <a href="<?php echo base_url('panel/new/page'); ?>" class="btn btn-success pull-left btn-xs"> <i class="fa fa-plus"></i> Yeni Sayfa Oluştur</a>
              <button style="margin-left: 20px;" type="button" class="btn btn-danger pull-right btn-xs" data-toggle="modal" data-target="#modalSil">
                <i class="fa fa-remove"></i> Sayfa Sil
              </button>
            </h3>

            <div class="box-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="table_search" class="form-control pull-right" placeholder="Sayfalarda Ara">

                <div class="input-group-btn">
                  <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                </div>
              </div>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tbody><tr>
                <th>ID</th>
                <th>Başlık</th>
                <th>Slug</th>
                <th>Oluşturulma</th>
                <th>İşlem</th>
              </tr>

              <?php foreach($pages->result() as $page){ ?>
                <tr>
                  <td><b>#<?php echo $page->page_id; ?></b></td>
                  <td><?php echo $page->page_title; ?></td>
                  <td><?php echo $page->page_slug; ?></td>
                  <td><?php echo $page->createdAt; ?></td>
                  <td>
                    <a href="<?php echo base_url('panel/edit/page/') . $page->page_id; ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Düzenle</a>
                      <a target="_blank" href="<?php echo base_url('page/') . $page->page_slug; ?>" class="btn btn-success btn-xs"><i class="fa fa-eye"></i> Görüntüle</a>
                  </td>
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