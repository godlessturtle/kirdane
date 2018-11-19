<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<?php $path = base_url('application/assets/admin/'); ?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Yorumlar - Yönetim | Kirdane.Com</title>
  <?php $this->load->view('admin/inc/header'); ?>
  <aside class="main-sidebar">
    <?php $this->load->view('admin/inc/sidebar'); ?>
  </aside>
  <div class="modal fade" id="modalSil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Yorum Sil</h5>
        </div>
        <form action="<?php echo base_url('panel/deletePost'); ?>" method="POST">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
          <div class="modal-body">
            <br>
            <label for="#inputEmail3">Silinecek Yazının ID Numarası</label>
            <input type="text" name="post_id" class="form-control" id="inputEmail3" placeholder="Yazının ID numarası">
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
        <?php if($this->uri->segment(3)=="waiting"){ echo "Onay Bekleyen "; } elseif($this->uri->segment(3)=="approved"){ echo "Onaylanan "; } ?>Yorumlar
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('panel'); ?>">Anasayfa</a></li>
        <li class="active">Yorumlar</li>
      </ol>
    </section>

    <section class="content container-fluid">

     <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">
            Toplam <?php 
            echo $comments->num_rows(); 
            if($this->uri->segment(3)=="waiting"){ echo " Onay Bekleyen"; } elseif($this->uri->segment(3)=="approved"){ echo " Onaylanan"; }
            ?> Yorum</h3>

          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tbody><tr>
                <th>ID</th>
                  <th>Yazı ID</th>
                <th>Yazan</th>
                <th>Yorum</th>
                <th>İşlem</th>
              </tr>

                <?php foreach($comments->result() as $comment){ ?>
                <tr>
                  <td><b>#<?php echo $comment->comment_id; ?></b></td>
                    <td><label class="label label-primary"><?php echo $comment->whichPost; ?></label></td>
                  <td><?php echo $comment->commenter_name; ?></td>
                  <td><p style="max-width: 70%!important;" class="yorumKisalt"><?php echo $comment->comment_message; ?></p></td>
                  <td>
                  <?php if(!$comment->isApproved){ ?>
                    <a href="<?php echo base_url('panel/approveComment') ."/". $comment->comment_id; ?>" class="btn btn-success btn-xs"><i class="fa fa-check"></i> Onayla</a>
                    <?php } ?>
                    <a href="<?php echo base_url('panel/deleteComment')."/".$comment->comment_id; ?>" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i> Sil</a>
                  
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
    <script>
        $(".yorumKisalt").pKisalt({limit: 40, text2: "(gizle)", text: "(tamamını gör)"});
    </script>
