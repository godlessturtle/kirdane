<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<?php $path = base_url('assets/admin/'); ?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" type="text/css" href="<?php echo $path; ?>bower_components/select2/dist/css/select2.min.css">
  <title>Footer Ayarları - Yönetim | Kirdane.Com</title>


  <?php $this->load->view('admin/inc/header'); ?>


  <aside class="main-sidebar">
    <?php $this->load->view('admin/inc/sidebar'); ?>
  </aside>

  <div class="content-wrapper">
    <section class="content-header">
     <h1>
      Footer Ayarları
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('panel'); ?>">Anasayfa</a></li>
      <li class="active">Footer Ayarları</li>
    </ol>
  </section>
  <br>

  <section style="padding-top: 0!important" class="content container-fluid">

   <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <!-- /.box-header -->
        <!-- form start -->
        <form action="<?php echo base_url('panel/footer/submit'); ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
          <div class="box-body">


            <div style="margin-bottom: 15px;" class="col-md-12">
                  <div class="col-md-6">
                      <h3>Hakkında Bölümü</h3>
                      <label>Başlık</label>
                      <input type="text" required="required" name="about_us_title" value="<?php echo trim($footer[0]->about_us_title); ?>" placeholder="Örnek: Hakkımızda" class="form-control">
                  </div>
                  <div class="col-md-12">
                      <label>Detay</label>
                      <textarea id="editor1" required="required" name="about_us_text" rows="3" cols="80">
                      <?php echo trim($footer[0]->about_us_text); ?>
                  </textarea>
                  </div>
              </div>
              <hr>

              <div style="margin-bottom: 15px;" class="col-md-12">
                  <h3>Son Yazılar Bölümü</h3>
                  <div class="col-md-6">

                      <label>Başlık</label>
                      <input type="text" required="required" name="recent_posts_title" value="<?php echo trim($footer[0]->recent_posts_title); ?>" placeholder="Örnek: Hakkımızda" class="form-control">
                  </div>
                  <div class="col-md-6">
                      <label>Toplam Yayın</label>
                      <input type="number" min="3" max="18" name="recent_posts_count" value="<?php echo trim($footer[0]->recent_posts_count); ?>" placeholder="Önerilen: 5, Maks:18 / Min:3" class="form-control">
                  </div>

              </div>

              <div style="margin-bottom: 15px;" class="col-md-12">
                  <h3>Sosyal Hesaplar</h3>
                  <div class="col-md-6">
                      <label>Başlık</label>
                      <input type="text" name="social_title" value="<?php echo trim($footer[0]->social_title); ?>" placeholder="http:// ile başlayan tam link" class="form-control">
                  </div>
                  <div class="col-md-6">
                      <label>Facebook</label>
                      <input type="text" name="social_facebook" value="<?php echo trim($footer[0]->social_facebook); ?>" placeholder="http:// ile başlayan tam link" class="form-control">
                  </div>
                  <div class="col-md-6">
                      <label>Twitter</label>
                      <input type="text" name="social_twitter" value="<?php echo trim($footer[0]->social_twitter); ?>" placeholder="http:// ile başlayan tam link" class="form-control">
                  </div>
                  <div class="col-md-6">
                      <label>Instagram</label>
                      <input type="text" name="social_instagram" value="<?php echo trim($footer[0]->social_instagram); ?>" placeholder="http:// ile başlayan tam link" class="form-control">
                  </div>
                  <div class="col-md-6">
                      <label>Pinterest</label>
                      <input type="text" name="social_pinterest" value="<?php echo trim($footer[0]->social_pinterest); ?>" placeholder="http:// ile başlayan tam link" class="form-control">
                  </div>
              </div>

              <div style="margin-bottom: 15px;" class="col-md-12">
                  <h3>Copyright</h3>
                  <div class="col-md-6">
                      <input type="text" required="required" name="copyright" value="<?php echo trim($footer[0]->copyright); ?>" placeholder="COPYRIGHT © KIRDANE 2018. ALL RIGHT RESERVED." class="form-control">
                  </div>
              </div>

          </div>
          <div class="box-footer">

            <button type="submit" class="btn btn-success pull-right col-md-4">Kaydet</button>
            <a style="margin-right: 10px" href="<?php echo base_url('panel/settings'); ?>" class="btn btn-danger pull-right">İptal</a>


          </div>
        </form>
      </div>
    </div>
  </div>

</section>
</div>
<?php $this->load->view('admin/inc/footer'); ?>
<script type="text/javascript">
  $(document).ready( function() {
    $("#txtEditor").Editor();                    
  });
</script>