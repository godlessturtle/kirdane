<!DOCTYPE html>
<html>
	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="author" content="Kirdane.com">
		<title>Kayıtol</title>
		<?php $this->load->view('inc/header'); ?>
		<section class="login first grey">
			<div class="container">
				<div class="box-wrapper">				
					<div class="box box-border">
						<div class="box-body">
							<h4>Kayıt Ol</h4>
							<form action="<?php echo base_url('register/finish'); ?>" method="post">
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
								<div class="form-group">
									<label>Ad Soyad</label>
									<input type="text" required="required" name="name"  class="form-control">
								</div>
								<div class="form-group">
									<label>e-Mail</label>
									<input type="email" required="required" name="email" class="form-control">
								</div>
								<div class="form-group">
									<label class="fw">Şifre</label>
									<input type="password" required="required" name="password"  class="form-control">
								</div>
								<div class="form-group">
									<label class="fw">Tekrar Şifre</label>
									<input type="password" required="required" name="re_password"  class="form-control">
								</div>
								<div class="form-group">
									<label>Doğrulama Kodu</label>
									<div class="row">
										<div class="col-md-5 col-xs-6 col-sm-4">
											<?php echo $cap['image']; ?>
										</div>
										<div class="col-md-7 col-xs-6 col-sm-8">
											<input type="text" required="required" placeholder="######" name="cap_code" class="form-control">
										</div>
									</div><br><br>
									
									
								</div>
								<div class="form-group text-right">
									<button type="submit" class="btn btn-primary btn-block">Kayıt Ol</button>
								</div>
								<div class="form-group text-center">
									<span class="text-muted">Hesabın var mı?</span> <a href="<?php echo base_url('user-login'); ?>">Giriş Yap</a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
		
<?php $this->load->view('inc/footer'); ?>