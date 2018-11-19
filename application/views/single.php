<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="author" content="Kirdane">
	<meta property="og:title" content="<?php echo $single[0]->post_title; if(!is_null( $setting[0]->set_title_suffix) || !empty( $setting[0]->set_title_suffix)){ echo " | " . $setting[0]->set_title_suffix; } ?>" />
	<meta property="og:type" content="article" />
    <meta content='<?php echo trim(strip_tags(substr($single[0]->post_text,0, 160))); ?>' property='og:description'/>
	<meta property="og:image" content="<?php echo base_url() . $single[0]->post_img; ?>" />
	<title><?php echo $single[0]->post_title;
	if(!is_null( $setting[0]->set_title_suffix) || !empty( $setting[0]->set_title_suffix)){ echo " | " . $setting[0]->set_title_suffix; } ?>
</title>
<?php $this->load->view('inc/header'); ?>
<section class="single">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url(); ?>"><?php echo $setting[0]->set_homepage_title; ?></a></li>
					<li><a href="<?php echo base_url('category')."/".seo(getCatNameByID($single[0]->post_category)[0]->cat_name)."/".getCatNameByID($single[0]->post_category)[0]->cat_id; ?>/1"><?php echo getCatNameByID($single[0]->post_category)[0]->cat_name; ?></a></li>
					<li class="active"><?php echo $single[0]->post_title ?></li>
				</ol>
				<article class="article main-article">
					<header><br>
						<h2 style="font-size:32px!important;"><?php echo $single[0]->post_title; ?></h2>
						<ul class="details">
							<li>
								<i class="fa fa-clock-o"></i> <?php setlocale(LC_TIME, 'tr_CA.UTF-8'); echo rtrim(trim(dateTranslate(date('d M Y',strtotime($single[0]->createdAt))))); ?>
							</li>

							<li>
								<i class="fa fa-list"></i> <a href="<?php echo rtrim(base_url('category')."/".seo(getCatNameByID($single[0]->post_category)[0]->cat_name)."/".getCatNameByID($single[0]->post_category)[0]->cat_id); ?>/1"><?php echo getCatNameByID($single[0]->post_category)[0]->cat_name; ?></a>
							</li>

							<li>
								<i class="fa fa-user"></i> <a href="<?php echo base_url('author') . "/" . getAuthorInfo($single[0]->post_author)[0]->user_id; ?>/1"><?php echo getAuthorInfo($single[0]->post_author)[0]->user_name; ?></a>
							</li>
						</ul>
					</header>
					<div class="main">
						<div style="max-width: 100%!important;" class="featured">
							<figure>
								<img style="max-height: 500px;object-fit: cover;max-width: 100%;" alt="<?php echo seo($single[0]->post_title)."-".seo(getCatNameByID($single[0]->post_category)[0]->cat_name)."-".seo($single[0]->post_tags); ?>" src="<?php echo base_url().$single[0]->post_img; ?>">
							</figure>
						</div>

						<p><?php echo $single[0]->post_text; ?></p>
					</div>
					<footer>
						<?php $tags = tags($single[0]->post_tags); ?>
						<div class="col">
							<ul class="tags">
								<li style="margin-right: 5px;font-weight: bold;"><?php echo html_escape(lang("tags")) ?>: </li>
								<?php foreach($tags as $tag){ ?>
									<li><a><i class="fa fa-tag"></i> <?php echo $tag ?></a></li>
								<?php } ?>
							</ul>
						</div>
					</footer>
				</article>
				<div class="sharing">
					<div class="title"><i class="ion-android-share-alt"></i> <?php echo html_escape(lang("shareThis")) ?></div>
					<ul class="social">
						<li>
                            <?php
                            $currentURL = current_url();
                            ?>
							<a href="http://www.facebook.com/sharer.php?u=<?php echo $currentURL; ?>&amp;title=<?php $title = $single[0]->post_title; if(!empty($title) || !is_null($title)){ echo seo($title) . " | " . seo($setting[0]->set_title_suffix); } ?>" onclick="window.open(this.href, 'windowName', 'width=600, height=400, left=24, top=24, scrollbars, resizable'); return false;" rel="nofollow" target="_blank" class="facebook">
								<i class="ion-social-facebook"></i> Facebook
							</a>
						</li>

						<li>
							<a href="#" class="twitter">
								<i class="ion-social-twitter"></i> Twitter
							</a>
						</li>
						<li>
							<a href="#" class="googleplus">
								<i class="ion-social-googleplus"></i> Google+
							</a>
						</li>
						<li>
							<a href="#" class="linkedin">
								<i class="ion-social-linkedin"></i> Linkedin
							</a>
						</li>
						<li>
							<a href="#" class="pinterest">
								<i class="ion-social-pinterest"></i> Pinterest
							</a>
						</li>
					</ul>
				</div>
				<div class="line">
					<div><?php echo html_escape(lang("author")) ?></div>
				</div>
				<div class="author">
					<figure>
						<img style="height: 100%!important;object-fit: cover;max-width: 100%!important" alt="<?php echo $setting[0]->set_keywords; ?>" src="<?php echo html_escape(base_url(getAuthorInfo($single[0]->post_author)[0]->user_img)); ?>">
					</figure>
					<div class="details">






						<div class="job">
							<?php
							if(getAuthorInfo($single[0]->post_author)[0]->user_permission == 1){ echo lang('member'); }
							elseif(getAuthorInfo($single[0]->post_author)[0]->user_permission == 121){ echo lang('admin'); }
							?>
						</div>
						<h3 class="name"><?php echo html_escape(getAuthorInfo($single[0]->post_author)[0]->user_name); ?></h3>
						<p>
							<?php echo html_escape(getAuthorInfo($single[0]->post_author)[0]->user_detail); ?>
						</p>
						<ul class="social trp sm">
                            <?php $author = getAuthorInfo($single[0]->post_author)[0]; ?>
                            <?php if(is_null($author->user_facebook) || !empty($author->user_facebook)){

                                echo '<li>
                                    <a target="_blank" rel="nofollow" href="'.html_escape($author->user_facebook).'" class="facebook">
                                        <svg><rect/></svg>
                                        <i class="ion-social-facebook"></i>
                                    </a>
                                </li>';


                            } ?>
                            <?php if(is_null($author->user_twitter) || !empty($author->user_twitter)){

                                echo '<li>
                                    <a target="_blank" rel="nofollow" href="'.html_escape($author->user_twitter).'" class="twitter">
                                        <svg><rect/></svg>
                                        <i class="ion-social-twitter"></i>
                                    </a>
                                </li>';


                            } ?>
                            <?php if(is_null($author->user_instagram) || !empty($author->user_instagram)){

                                echo '<li>
                                    <a target="_blank" rel="nofollow" href="'.html_escape($author->user_instagram).'" class="instagram">
                                        <svg><rect/></svg>
                                        <i class="ion-social-instagram"></i>
                                    </a>
                                </li>';


                            } ?>
                            <?php if(is_null($author->user_external) || !empty($author->user_external)){

                                echo '<li>
                                    <a target="_blank" rel="nofollow" href="'.html_escape($author->user_external).'" class="googleplus">
                                        <svg><rect/></svg>
                                        <i class="ion-link"></i>
                                    </a>
                                </li>';


                            } ?>


						</ul>
					</div>
				</div>
				<div class="line"><div><?php echo html_escape(lang("relatedPosts")) ?></div></div>
				<div class="row">

					<?php foreach($relatedPosts as $related){ ?>
						<article class="article related col-md-6 col-sm-6 col-xs-12">
							<div class="inner">
								<figure>
									<a href="<?php echo permalinkCreator('c', $related->post_id, $related->post_title); ?>">
										<img style="height: 250px; object-fit: cover;" src="<?php 
										if(!is_null($related->post_img) || !empty($related->post_img)){ echo html_escape(base_url($related->post_img)); } ?>">
									</a>
								</figure>
								<div class="padding">
									<h2><a href="<?php echo permalinkCreator('c', $related->post_id, $related->post_title); ?>"><?php echo html_escape($related->post_title); ?></a></h2>
									<div class="detail">
										<div class="category"><a href="<?php echo base_url('category')."/".seo(getCatNameByID($single[0]->post_category)[0]->cat_name)."/".getCatNameByID($single[0]->post_category)[0]->cat_id; ?>"><?php echo getCatNameByID($single[0]->post_category)[0]->cat_name; ?></a></div>
										<div class="time"><?php setlocale(LC_TIME, 'tr_CA.UTF-8'); echo dateTranslate(date('d M Y',strtotime($related->createdAt))); ?></div>
									</div>
								</div>
							</div>
						</article>
					<?php } ?>




                </div>
				<div class="line thin"></div>
				<div class="comments">
					<h2 class="title">
						<?php if(!$getPostComments->num_rows()){ echo html_escape(lang("noComment")); } else {
							echo html_escape($getPostComments->num_rows()." ".html_escape(lang("comments"))); } ?>
							
						</h2>
						<div class="comment-list">

							<?php foreach ($getPostComments->result() as $comment){ ?>
								<div class="item">
									<div class="user">                                
										<figure>
											<img src="<?php echo base_url($comment->commenter_img); ?>">
										</figure>
										<div class="details">
											<h5 class="name"><?php  echo $comment->commenter_name; if(userDetailsByMail($comment->commenter_email)[0]->user_permission == 121){ echo ' <span style="padding: 2px 4px!important;" class="label label-primary">  <small style="color:white"><i  class="fa fa-star"></i>Yönetici</small></span>'; } ?></h5>
											<div class="time"><?php echo $comment->createdAt; ?></div>
											<div class="description">
												<?php echo $comment->comment_message; ?>
											</div>
										</div>
									</div>
								</div>
							<?php } ?>	

						</div>
						<form action="<?php echo base_url('sendComment'); ?>" method="POST" class="row">
							<div class="col-md-12">
								<h3 class="title"><?php echo html_escape(lang("writeComment")) ?></h3>
							</div>
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
							<?php
                            if($this->session->userdata('userInfo')){
                                $user_id = $this->session->userdata('userInfo')[0]->user_id; $session = userDetails($user_id);
                              if($session){ ?>
								<div style="display:none;">
									<input type="text" style="display: none;" value="<?php echo $this->encryption->encrypt(1); ?>" name="isMember">
								</div>
								<div class="form-group col-md-6">
									<label for="name"><?php echo html_escape(lang("name")); ?> <span class="required"></span></label>
									<input type="text" required id="name" readonly="" value="<?php echo $session[0]->user_name; ?>" name="commenter_name" class="form-control">
								</div>
								<div class="form-group col-md-6">
									<label for="email">Email <span class="required"></span></label>
									<input type="email" required id="email" readonly="" value="<?php echo $session[0]->user_email; ?>" name="commenter_email" class="form-control">
								</div>
								
							<?php } } else if($this->session->userdata('adminInfo')){
                                $user_id = $this->session->userdata('adminInfo')[0]->user_id; $session = userDetails($user_id);
                                if($session){ ?>
                                    <div style="display:none;">
                                        <input type="text" style="display: none;" value="<?php echo $this->encryption->encrypt(1); ?>" name="isMember">
                                    </div>
                                    <input type="hidden" name="csrf" value="1">
                                    <div class="form-group col-md-6">
                                        <label for="name"><?php echo html_escape(lang("name")); ?> <span class="required"></span></label>
                                        <input type="text" required id="name" readonly="" value="<?php echo $session[0]->user_name; ?>" name="commenter_name" class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email">Email <span class="required"></span></label>
                                        <input type="email" required id="email" readonly="" value="<?php echo $session[0]->user_email; ?>" name="commenter_email" class="form-control">
                                    </div>

                                <?php }  } else { ?>
								<div style="display:none">
									<input type="text" style="display: none;" value="<?php echo $this->encryption->encrypt(0); ?>" name="isMember">
								</div>
								<div class="form-group col-md-6">
									<label for="name"><?php echo html_escape(lang("name")); ?> <span class="required"></span></label>
									<input type="text" required minlength="5" maxlength="28" id="name" name="commenter_name" class="form-control">
								</div>
								<div class="form-group col-md-6">
									<label for="email">Email <span class="required"></span></label>
									<input type="email" required id="email" minlength="8" maxlength="65" name="commenter_email" class="form-control">
								</div>

							<?php } ?>
							<input type="text" hidden="hidden" required id="email" value="<?php echo $this->encryption->encrypt($single[0]->post_id); ?>" name="whichPost" class="form-control hidden">
							<div class="form-group col-md-12">
								<label for="message"><?php echo html_escape(lang("comment")); ?> <span class="required"></span></label>
								<textarea required class="form-control" minlength="5" name="commenter_message" placeholder="<?php echo html_escape(lang("commentInfo")) ?>"></textarea>
							</div>
							<div class="form-group col-md-12">
								<button type="submit" class="btn btn-primary"><?php echo html_escape(lang("submitComment")); ?> </button>
							</div>

						</form>
						<small><?php echo html_escape(lang("commentCondt")); ?></small>
					</div>
				</div>
				<div class="col-md-4 sidebar" id="sidebar">
					<aside>
						<div class="aside-body">
							<div class="aside-body">
								<div class="featured-author">
									<div class="featured-author-inner">
										<div class="featured-author-cover" style="background-image: url('<?php echo base_url(getAuthorInfo($single[0]->post_author)[0]->user_cover_img); ?>');">
											<div class="badges">
												<div class="badge-item"><i class="ion-star"></i>  <?php
												if(getAuthorInfo($single[0]->post_author)[0]->user_permission == 1){ echo lang('member'); }
												elseif(getAuthorInfo($single[0]->post_author)[0]->user_permission == 121){ echo lang('admin'); }
												?></div>
											</div>
											<div class="featured-author-center">
												<figure class="featured-author-picture">
													<img style="height: 100%!important;object-fit: cover;" src="<?php echo base_url(getAuthorInfo($single[0]->post_author)[0]->user_img); ?>" alt="<?php echo base_url(getAuthorInfo($single[0]->post_author)[0]->user_img); ?>">
												</figure>
												<div class="featured-author-info">
													<h2 class="name"><?php echo getAuthorInfo($single[0]->post_author)[0]->user_name; ?></h2>
												</div>
											</div>
										</div>
										<div class="featured-author-body">
											<div class="featured-author-count">
												<div style="width: 50%!important;" class="item">
													<a href="<?php echo base_url('author/' . getAuthorInfo($single[0]->post_author)[0]->user_id); ?>/1">
														<div class="name"><?php echo html_escape(lang("posts")); ?></div>
														<div class="value"><?php echo postCount(getAuthorInfo($single[0]->post_author)[0]->user_id); ?></div>														
													</a>
												</div>
												<div style="width: 50%!important;" class="item">
													<a href="#">
														<div class="icon">
															<div><?php echo html_escape(lang("details")) ?></div>
															<i class="ion-chevron-right"></i>
														</div>														
													</a>
												</div>
											</div>
											<div class="featured-author-quote">
												<?php echo substr(getAuthorInfo($single[0]->post_author)[0]->user_detail, 0, 200);  ?>
											</div>
											<div class="featured-author-footer">
												<a href="#"><?php echo html_escape(lang("seeAuthors")) ?></a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</aside>
					<aside>
						<h1 class="aside-title"><?php echo html_escape(lang("newestArticles")) ?></h1>
						<div class="aside-body">

							<?php for($i=0;$i<count($getRecentPosts);$i++){  if($i==0){ ?>
								<article class="article-fw">
									<div class="inner">
										<figure>
											<a href="<?php echo permalinkCreator('c', $getRecentPosts[$i]->post_id, $getRecentPosts[$i]->post_title); ?>">												
												<img src="<?php echo base_url($getRecentPosts[$i]->post_img); ?>">
											</a>
										</figure>
										<div class="details">
											<h1><a href="<?php echo permalinkCreator('c', $getRecentPosts[$i]->post_id, $getRecentPosts[$i]->post_title); ?>"><?php echo $getRecentPosts[$i]->post_title; ?></a></h1>
											<p>
												<?php $limit = 180; 
												echo substr($getRecentPosts[$i]->post_text, 0 , $limit);
												if(strlen($getRecentPosts[$i]->post_text)>$limit){ echo '[...]'; } ?>
											</p>
											<div class="detail">
												<div class="time"><?php setlocale(LC_TIME, 'tr_CA.UTF-8'); echo dateTranslate(date('d M Y',strtotime($getRecentPosts[$i]->createdAt))); ?></div>
												<div class="category"><a href="<?php echo base_url('category')."/".seo(getCatNameByID($getRecentPosts[$i]->post_category)[0]->cat_name)."/".getCatNameByID($getRecentPosts[$i]->post_category)[0]->cat_id; ?>/1"><?php echo getCatNameByID($getRecentPosts[$i]->post_category)[0]->cat_name; ?></a></div>
											</div>
										</div>
									</div>
								</article>
								<div class="line"></div>
							<?php } elseif($i>0){ ?>
								

								<article class="article-mini">
									<div class="inner">
										<figure>
											<a href="<?php echo permalinkCreator('c', $getRecentPosts[$i]->post_id, $getRecentPosts[$i]->post_title); ?>">
												<img src="<?php echo base_url($getRecentPosts[$i]->post_img); ?>">
											</a>
										</figure>
										<div class="padding">
											<h1><a href="<?php echo permalinkCreator('c', $getRecentPosts[$i]->post_id, $getRecentPosts[$i]->post_title); ?>"><?php echo $getRecentPosts[$i]->post_title; ?></a></h1>
											<div class="detail">
												<div class="category"><a href="<?php echo base_url('category')."/".seo(getCatNameByID($getRecentPosts[$i]->post_category)[0]->cat_name)."/".getCatNameByID($getRecentPosts[$i]->post_category)[0]->cat_id; ?>/1"><?php echo getCatNameByID($getRecentPosts[$i]->post_category)[0]->cat_name; ?></a></div>
												<div class="time"><?php setlocale(LC_TIME, 'tr_CA.UTF-8'); echo dateTranslate(date('d M Y',strtotime($getRecentPosts[$i]->createdAt))); ?></div>
											</div>
										</div>
									</div>
								</article>
							<?php } } ?>




						</div>
					</aside>
				</div>

			</div>
		</div>
	</section>
	<?php $this->load->view('inc/footer'); ?>