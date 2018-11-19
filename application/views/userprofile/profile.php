<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if($this->session->userdata('userInfo')){
    $user_id = $this->session->userdata('userInfo')[0]->user_id;
    $user = userDetails($user_id)[0];
}
/**
 * Created by PhpStorm.
 * User: Aslan
 * Date: 23.08.2018
 * Time: 11:04
 */
$this->load->view('inc/header');  ?><title><?php echo lang('myProfile') ?> - <?php echo $setting[0]->set_title_suffix; ?></title>

<section>
			<div class="container">
				<div class="row">
					<?php $this->load->view('userprofile/sidebar'); ?>

					<div class="col-md-8">
						<div style="border: 1px solid #ccc; height: auto; padding: 15px 30px;">
							<div class="row">
								<h4><?php echo lang('myProfile') ?></h4><hr>
								<form method="POST" action="<?php echo base_url('profile/update'); ?>" enctype="multipart/form-data">
                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
									<div class="form-group">
										<div class="col-md-6">
											<label for="user_name"><?php echo lang('fullName') ?></label>
											<input type="text" name="user_name" value="<?php echo html_escape(trim($user->user_name)); ?>" id="user_name" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-6">
											<label for="user_details">e-Mail</label><br>
											<input type="text" name="user_email" id="user_name" value="<?php echo html_escape(trim($user->user_email)); ?>" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<div style="margin-top: 15px;" class="col-md-12">
											<label for="user_details"><?php echo lang('aboutMe') ?></label><br>
											<textarea name="user_details" style="width: 100%; height: 75px;" id="user_details">
                                                <?php echo html_escape(trim($user->user_detail)); ?>
                                            </textarea>
										</div>
									</div>

									<div class="form-group">
										<div style="margin-top: 15px;" class="col-md-6">
											<label for="user_img"><?php echo lang('profileImg') ?><small>(Maximum 2MB)</small> </label><br>
											<input type="file" name="user_img">
										</div>

									</div>

									<div class="form-group">
										<div style="margin-top: 15px;" class="col-md-6">
											<label for="user_cover"><?php echo lang('coverImg') ?><small> (Maximum 2MB)</small> </label><br>
											<input type="file" name="user_cover">
										</div>
									</div>

									<div class="form-group">
										<div class="col-md-12">
											<hr>
											<input id="btn_submit_profile" type="submit" class="btn btn-info btn-sm btn-rounded pull-right" value="<?php echo lang('submitUpdate'); ?>" name="btn_submit_profile">
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