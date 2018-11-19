<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Aslan
 * Date: 23.08.2018
 * Time: 11:04
 */
?> <title><?php echo lang('createNewPost'). " - " . $setting[0]->set_title_suffix; ?></title>
<style>
    .social li a i:before{
        padding: 13px;
    }
</style>
<?php
$this->load->view('inc/header'); ?>

    <section>
        <div class="container">
            <div class="row">
                <?php $this->load->view('userprofile/sidebar'); ?>

                <div class="col-md-8">
                    <div style="border: 1px solid #ccc; height: auto; padding: 15px 30px;">
                        <div class="row">

                            <form action="<?php echo base_url('submit/post'); ?>" method="POST" enctype="multipart/form-data">
                                <h5><?php echo lang('createNewPost') ?></h5><small><?php echo lang('postNotification'); ?></small>
                                <hr>
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                                <input type="hidden" name="user_id" value="<?php echo $this->encryption->encrypt($this->session->userdata('userInfo')[0]->user_id); ?>">
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label for="post_title"><?php echo lang('postTitle'); ?></label>
                                        <input type="text" name="post_title" required="required" id="post_title" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label for="post_tags"><?php echo lang('postTags'); ?></label><br>
                                        <input type="text" name="post_tags" id="post_tags" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div style="margin-top: 15px;" class="col-md-12">
                                        <label for="post_text"><?php echo lang('postContent'); ?></label><br>
                                        <textarea style="width: 100%; height: 100px;" name="post_text" required="required" id="post_text"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div style="margin-top: 15px;" class="col-md-6">
                                        <label for="user_cover"><?php echo lang('postCategory'); ?></label><br>
                                        <select style="width: 100%;" required="required" name="post_category" class="select select2">
                                            <?php foreach($categories as $cat){ ?>
                                            <option><?php echo $cat->cat_name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div style="margin-top: 15px;" class="col-md-6">
                                        <label  for="post_img"><?php echo lang('postImg'); ?></label><br>
                                        <input required="required" type="file" name="post_img">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-md-12">
                                        <hr>

                                        <br>
                                            <?php echo $captcha['image']; ?>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <input required="required" name="captchaWord" class="form-control" placeholder="######" type="text">
                                            </div>

                                        <input type="submit" class="btn btn-info btn-sm btn-rounded pull-right" value="<?php echo lang('submit'); ?>" name="btn_submit">
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $this->load->view('inc/footer'); ?>

