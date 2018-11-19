<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<?php $path = base_url('assets/admin/'); ?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" type="text/css" href="<?php echo $path; ?>bower_components/select2/dist/css/select2.min.css">
  <title>Genel Ayarlar - Yönetim | Kirdane.Com</title>


  <?php $this->load->view('admin/inc/header'); ?>


  <aside class="main-sidebar">
    <?php $this->load->view('admin/inc/sidebar'); ?>
  </aside>

  <div class="content-wrapper">
    <section class="content-header">
       <h1>
        Genel Ayarlar
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('panel'); ?>">Anasayfa</a></li>
        <li class="active">Genel Ayarlar</li>
      </ol>
    </section>
    <br>

    <section style="padding-top: 0!important" class="content container-fluid">
            
     <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <!-- /.box-header -->
          <!-- form start -->
          <form action="<?php echo base_url('panel/settings/submit'); ?>" method="POST" enctype="multipart/form-data">
            <div class="box-body">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

              <div style="margin-bottom: 15px;" class="col-md-12">
                <div class="col-md-4">
                  <label>Sayfa Son Eki (suffix) * </label>
                  <input type="text" name="set_title_suffix" value="<?php echo $setting[0]->set_title_suffix; ?>" placeholder="Örnek: Kirdane.com" class="form-control">
                </div>
                <div class="col-md-4">
                  <label>Site Açıklaması * </label>
                  <input type="text" name="set_description" value="<?php echo $setting[0]->set_description; ?>" placeholder="siteyi tanımlayan bir açıklama" class="form-control">
                </div>
                <div class="col-md-4">
                  <label>Site Anahtar Kelimeleri * </label>
                  <input type="text" name="set_keywords" value="<?php echo $setting[0]->set_keywords; ?>" placeholder="Virgülle ayırın" class="form-control">
                </div>
              </div>

              <div style="margin-top: 20px;" class="col-md-12">
               <div class="form-group col-md-4">
                <label for="exampleInputEmail1">Anasayfa Başlığı * </label>
                <input type="text" required="required" name="set_homepage_title" value="<?php echo $setting[0]->set_homepage_title; ?>" placeholder="Örnek: Anasayfa" class="form-control">
              </div>
              <div class="form-group col-md-4">
                <label for="exampleInputPassword1">Kategori Sayfası Başlığı * </label>
                <input type="text" name="set_category_title" value="<?php echo $setting[0]->set_category_title; ?>" placeholder="Örnek: Kategori" class="form-control">
              </div>
              <div class="col-md-4">
                <label>Arama Sayfası Başlığı * </label>
                <input type="text" name="set_search_title" value="<?php echo $setting[0]->set_search_title; ?>" placeholder="Örnek: Arama Sonucu" class="form-control">
              </div>
            </div>

                <div style="margin-top: 20px;" class="col-md-12">
                    <div class="col-md-3">
                        <label>404 Sayfası Başlığı * </label>
                        <input type="text" name="set_404_title" value="<?php echo $setting[0]->set_404_title; ?>" placeholder="Örnek: 404 - Sayfa Bulunamadı" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label>404 Alt Başlık * </label>
                        <input type="text" name="set_404_subtitle" value="<?php echo $setting[0]->set_404_subtitle; ?>" placeholder="Örnek: 404 - Sayfa Bulunamadı" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>404 Detay Metni * </label>
                        <input type="text" name="set_404_text" value="<?php echo $setting[0]->set_404_text; ?>" placeholder="Örnek: Böyle bir sayfa yok, bunun yerine anasayfaya dönebilirsiniz." class="form-control">
                    </div>
                </div>

            <div style="margin-top: 30px;" class="col-md-12">
              <div class="col-md-12">
                <label>Google Analytics Kodu * </label>
                <input type="text" name="set_analytics" value="<?php echo $setting[0]->set_analytics; ?>" placeholder="<script>...</script>" class="form-control">
              </div>
            </div>

            <div class="col-md-12">
              <div style="margin-top: 30px;" class="col-md-12">
               <h2>Açıklamalar</h2>
               <span>
                 * <b>Sayfa başlığı</b> alanları, ilgili sayfaya erişim sağlandığında tarayıcı sekmesinde ve sayfa içerisinde görüntülenecek başlıktır
               </span><br>
               <span>
                 ** <b>Suffix</b> alanı tarayıcı sekmesinde her sayfada görüntülenecek olan başlıktan sonra yazılacak alandır.
               </span><br>
               <span>
                 *** <b>Analytics</b> alanı Google Analytics servisinden aldığınız ve sayfa görüntülenme sayısını detaylı olarak görüntüleyebileceğiniz hizmeti kullanabilmeniz için oluşturuldu, aldığınız kodu ilgili alana yapıştırıp kaydedin.
               </span>
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