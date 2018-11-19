<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<?php $path = base_url('assets/admin/'); ?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" type="text/css" href="<?php echo $path; ?>bower_components/select2/dist/css/select2.min.css">
  <title>Sayfayı Düzenle - Yönetim | Kirdane.Com</title>


  <?php $this->load->view('admin/inc/header'); ?>
  <aside class="main-sidebar">
    <?php $this->load->view('admin/inc/sidebar'); ?>
  </aside>

  <div class="content-wrapper">
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('panel'); ?>">Anasayfa</a></li>
        <li><a href="<?php echo base_url('panel/posts'); ?>">Sayfalar</a></li>
        <li class="active">Sayfayı Düzenle</li>
      </ol>
    </section>
    <br>

    <section class="content container-fluid">

     <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Sayfayı Düzenle</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form action="<?php echo base_url('panel/update/page'); ?>" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <div class="box-body">
                <input type="text" name="page_id" hidden="hidden" value="<?php echo $page[0]->page_id; ?>">
              <div class="form-group col-md-7">
                <label for="exampleInputEmail1">Sayfa Başlığı</label>
                <input type="text" required="required" name="page_title" value="<?php echo $page[0]->page_title; ?>" class="form-control">
              </div>
              <div class="form-group col-md-5">
                <label for="exampleInputPassword1">Sayfa Sloganı</label>
                <input type="text" name="page_slogan" value="<?php if(!is_null($page[0]->page_slogan || !empty($page[0]->page_slogan))){ echo $page[0]->page_slogan; } ?>" placeholder="Başlığın altında görünür, zorunlu değil" class="form-control">
              </div>
              <div class="form-group">
                <div class="col-md-12">
                  <label for="exampleInputFile">Sayfa İçeriği</label>
                  <textarea id="editor1" required="required" name="page_text" rows="10" cols="80">
                      <?php echo $page[0]->page_text; ?>
                  </textarea>
                </div>
              </div>

    

          </div>
 

        <div class="box-footer">

            <button type="submit" class="btn btn-success pull-right col-md-4">Kaydet</button>
            <a style="margin-right: 10px" href="<?php echo base_url('panel/posts'); ?>" class="btn btn-danger pull-right">İptal</a>


        </div>
      </form>
    </div>
  </div>
</div>

</section>
</div>

<!-- Footer -->

<?php $this->load->view('admin/inc/footer'); ?>