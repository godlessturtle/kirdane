<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<?php $path = base_url('application/assets/admin/'); ?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Yazılar - Yönetim | Kirdane.Com</title>
  <?php $this->load->view('admin/inc/header'); ?>


  <aside class="main-sidebar">
    <?php $this->load->view('admin/inc/sidebar'); ?>
  </aside>

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Kategori Düzenle
      </h1>
      <ol class="breadcrumb">
        <li class="active">Anasayfa</li>
      </ol>
    </section>

    <section class="content container-fluid">

     <div class="row">

      <div class="col-md-8">

        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Kategori Bilgileri</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form method="post" action="<?php echo base_url('panel/update/cat'); ?>" class="form-horizontal">
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <div class="box-body">

              <div hidden="hidden" class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">ID</label>

                <div class="col-sm-10">
                  <input type="text" class="form-control" name="cat_id" id="inputEmail3" value="<?php echo $cat[0]->cat_id; ?>" placeholder="ID">
                </div>
              </div>
              <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Kategori Adı</label>

                <div class="col-sm-10">
                  <input type="text" required="required" class="form-control" name="cat_name" id="inputEmail3" value="<?php echo $cat[0]->cat_name; ?>" placeholder="Kategori Adı">
                </div>
              </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <a class="btn btn-danger" href="<?php echo base_url('panel/categories'); ?>">İptal</a>
              <button type="submit" class="btn btn-info pull-right">Güncelle</button>
            </div>
            <!-- /.box-footer -->
          </form>
        </div>

      </div>


    </div>

  </section>
</div>

<!-- Footer -->
<?php $this->load->view('admin/inc/footer'); ?>