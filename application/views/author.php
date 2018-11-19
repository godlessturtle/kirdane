<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<?php $this->load->view('inc/header'); ?>
	<section class="category">
		<div class="container">
			<div class="row">
				<div class="col-md-8 text-left">
					<div class="row">
						<div class="col-md-12">        
							<ol class="breadcrumb">
								<li><a href="#">Anasayfa</a></li>
								<li><a href="#">Yazarlar</a></li>
								<li class="active"><?php echo $authorInfo[0]->user_name; ?></li>
							</ol>
							<h3 class="page-title"><?php echo $setting[0]->set_author_title; ?>: 
								
								<?php echo $authorInfo[0]->user_name; ?>
							</h3>
							<p class="page-subtitle">Yazara ait tüm yazılar listeleniyor.</i></p>
						</div>
					</div>
					<div class="line"></div>
					<div class="row">
						<?php foreach($authorPost as $authorPost){ ?>
							<article class="col-md-12 article-list">
								<div class="inner">
									<figure>
										<a href="<?php echo permalinkCreator('c', $authorPost->post_id, $authorPost->post_title); ?>">
											<img id="featuredIMG" src="<?php echo base_url($authorPost->post_img); ?>" alt="<?php echo $authorPost->post_tags . "," . $authorPost->post_title; ?>">
										</a>
									</figure>
									<div class="details">
										<div class="detail">
											<div class="category">
												<a href="#"><?php echo getCatName($authorPost->post_id)[0]->cat_name; ?></a>
											</div>
											<div class="time">
												<?php setlocale(LC_TIME, 'tr_CA.UTF-8'); echo dateTranslate(date('d M Y',strtotime($authorPost->createdAt))); ?>
											</div>
										</div>
										<h1><a href="<?php echo permalinkCreator('c', $authorPost->post_id, $authorPost->post_title); ?>"><?php echo $authorPost->post_title; ?></a></h1>
										<p>
											<?php echo strip_tags(substr($authorPost->post_text, 0, 124)) . '...'; ?>
										</p>
										<footer>
											<span class="love">
												<i class="ion-eye"></i> <div>273</div>
											</span>
											<span style="margin-left:20px;" class="love">
												<i class="ion-chatbubbles"></i> <div>12</div>
											</span>
											<a class="btn btn-primary more" href="<?php echo permalinkCreator('c', $authorPost->post_id, $authorPost->post_title); ?>">
												<div>Devamını Oku</div>
												<div><i class="ion-ios-arrow-thin-right"></i></div>
											</a>
										</footer>
									</div>
								</div>
							</article>
						<?php } ?>

						<div class="col-md-12 text-center">
							<ul class="pagination">
                                <!--
								<li class="prev"><a href="#"><i class="ion-ios-arrow-left"></i></a></li>
								<li class="active"><a href="#">1</a></li>
								<li><a href="#">2</a></li>
								<li><a href="#">3</a></li>
								<li><a href="#">...</a></li>
								<li><a href="#">97</a></li>
								<li class="next"><a href="#"><i class="ion-ios-arrow-right"></i></a></li>-->
                                <?php echo $pagination; ?>
							</ul>
						</div>
					</div>
				</div>
				<?php $this->load->view('inc/sidebar'); ?>
			</div>
		</div>
	</section>

	<?php $this->load->view('inc/footer'); ?>
