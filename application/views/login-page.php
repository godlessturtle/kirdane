<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="description" content="Magz is a HTML5 & CSS3 magazine template is based on Bootstrap 3.">
	<meta name="author" content="Kodinger">
	<meta name="keyword" content="magz, html5, css3, template, magazine template">
	<!-- Shareable -->

	<meta property="og:title" content="HTML5 & CSS3 magazine template is based on Bootstrap 3" />
	<meta property="og:type" content="article" />
	<meta property="og:url" content="http://github.com/nauvalazhar/Magz" />
	<meta property="og:image" content="https://raw.githubusercontent.com/nauvalazhar/Magz/master/images/preview.png" />
	<title>Giriş Yap</title>
	<?php $this->load->view('inc/header'); ?>

	<section class="login first grey">
		<div class="container">
			<div class="box-wrapper">				
				<div class="box box-border">
					<div class="box-body">
						<h4>Üye Girişi</h4>
						<form method="POST" action="<?php echo base_url('login'); ?>">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
							<div class="form-group">
								<label>e-Posta</label>
								<input type="email" name="email" required="required" class="form-control">
							</div>
							<div class="form-group">
								<label class="fw">Şifre
									<a href="#" class="pull-right">Şifremi Unuttum</a>
								</label>
								<input type="password" name="password" required="required" class="form-control">
							</div>
							<div class="form-group">
								<label>Doğrulama Kodu</label>
								<div class="row">
                                    <div class="col-md-5 col-xs-6 col-sm-6">
										<?php echo $captcha['image']; ?>
									</div>
									<div class="col-md-7 col-xs-6 col-sm-6">
										<input style="width: 85%;margin-left: 15%;" type="text" required="required" placeholder="######" name="cap_code" class="form-control">
									</div>
								</div><br><br>
							</div>
							<div class="form-group text-right">
								<button class="btn btn-primary btn-block">Giriş</button>
							</div>
							<div class="form-group text-center">
								<span class="text-muted">Hesabın yok mu?</span> <a href="<?php echo base_url('register'); ?>">Kayıt ol</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php $this->load->view('inc/footer'); ?>