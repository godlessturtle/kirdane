<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: Aslan
 * Date: 23.08.2018
 * Time: 11:04
 */
$this->load->view('inc/header'); ?><title><?php echo lang('passwordF'); ?> - <?php echo $setting[0]->set_title_suffix; ?></title>

    <section>
        <div class="container">
            <div class="row">
                <?php $this->load->view('userprofile/sidebar'); ?>

                <div class="col-md-8">
                    <div style="border: 1px solid #ccc; height: auto; padding: 15px 30px;">
                        <div class="row">

                            <form action="change/password" method="POST">
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                <h5><?php echo lang('passwordF'); ?></h5><br>
                                <hr>
                                <br>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="user_name"><?php echo lang('oldPass'); ?></label>
                                        <input type="password" name="old_password" required="required" class="form-control" style="padding-right: 60px;">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div style="margin-top: 15px;" class="col-md-6">
                                        <label for="user_name"><?php echo lang('newPass'); ?></label>
                                        <input type="password" name="new_password" minlength="8" maxlength="32" required="required" class="form-control" style="padding-right: 60px;">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div style="margin-top: 15px;" class="col-md-6">
                                        <label for="user_name"><?php echo lang('rePass'); ?></label>
                                        <input type="password" name="re_password" minlength="8" maxlength="32" required="required" class="form-control" style="padding-right: 60px;">
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <div style="margin-top: 15px;" class="col-md-6">
                                        <input type="submit" name="password" value="<?php echo lang('submitUpdate'); ?>" class="btn btn-primary" style="padding-right: 60px;">
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