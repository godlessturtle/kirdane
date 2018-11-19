<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
    <html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta property="og:title" content="<?php echo $setting[0]->set_homepage_title; ?> | Kirdane.com"/>
    <meta property="og:type" content="home"/>
    <meta property="og:url" content="<?php echo base_url(); ?>"/>
    <title><?php
        if (
            !is_null($setting[0]->set_homepage_title) || !empty($setting[0]->set_homepage_title)
            &&
            !is_null($setting[0]->set_title_suffix) || !empty($setting[0]->set_title_suffix)
        ) {
            echo $setting[0]->set_homepage_title . " | " . $setting[0]->set_title_suffix;
        }

        ?>
    </title>
<?php $this->load->view('inc/header'); ?>

    <section class="home">

        <div class="container">

            <div class="row">
                <div class="col-md-8 col-sm-12 col-xs-12">
                    <div class="owl-carousel owl-theme slide" id="featured">
                        <?php foreach ($getCatPosts as $post) { ?>
                            <div class="item">
                                <article class="featured">
                                    <div class="overlay"></div>
                                    <figure>
                                        <img style="object-fit: cover!important"
                                             src="<?php echo base_url($post->post_img); ?>"
                                             alt="<?php echo $post->post_tags; ?>">
                                    </figure>
                                    <div class="details">
                                        <div class="category"><a
                                                    href="<?php echo base_url('category') . "/" . seo(getCatNameByID($post->post_category)[0]->cat_name) . "/" . getCatNameByID($post->post_category)[0]->cat_id; ?>/1"><?php echo getCatNameByID($post->post_category)[0]->cat_name; ?></a>
                                        </div>
                                        <h1>
                                            <a href="<?php echo permalinkCreator('c', $post->post_id, $post->post_title); ?>"><?php echo $post->post_title; ?></a>
                                        </h1>
                                        <div class="time"><?php setlocale(LC_TIME, 'tr_CA.UTF-8');
                                            echo dateTranslate(date('d M Y', strtotime($post->createdAt))); ?></div>
                                    </div>
                                </article>
                            </div>
                        <?php } ?>

                    </div>
                    <div class="line">
                        <div><?php echo getCatNameByID($getCategoryPosts[0]->post_category)[0]->cat_name; ?></div>
                    </div>
                    <div class="row">

                        <?php foreach ($getCategoryPosts as $catPost) { ?>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="row">
                                    <article class="article col-md-12">
                                        <div class="inner">
                                            <figure>
                                                <a href="<?php echo permalinkCreator('c', $catPost->post_id, $catPost->post_title); ?>">
                                                    <img style="width: 100%; height: 100%; object-fit: cover;" src="
												<?php echo $catPost->post_img; ?>"
                                                         alt="<?php echo $catPost->post_tags . "," . $catPost->post_title; ?>">
                                                </a>
                                            </figure>
                                            <div class="padding">
                                                <div class="detail">
                                                    <div class="time"><i
                                                                class="fa fa-clock-o"></i> <?php setlocale(LC_TIME, 'tr_CA.UTF-8');
                                                        echo dateTranslate(date('d M Y', strtotime($catPost->createdAt))); ?>
                                                    </div>
                                                </div>
                                                <h2><a style="font-size: 16px!important;"
                                                       href="<?php echo permalinkCreator('c', $catPost->post_id, $catPost->post_title); ?>"><?php echo substr($catPost->post_title, 0, 75); ?></a>
                                                </h2>
                                                <p><?php echo strip_tags(limitChars($catPost->post_text, 125, '[...]')); ?></p>
                                                <footer>
                                                    <a class="love"><i class="ion ion-eye"></i>
                                                        <div><?php echo $catPost->post_views; ?></div>
                                                    </a>
                                                    <a class="love" style="margin-left: 15px;"><i
                                                                class="ion ion-chatbubbles"></i>
                                                        <div><?php echo commentCount($catPost->post_id); ?></div>
                                                    </a>
                                                    <a class="btn btn-primary more"
                                                       href="<?php echo permalinkCreator('c', $catPost->post_id, $catPost->post_title); ?>">
                                                        <div><?php echo lang('readMore'); ?></div>
                                                        <div><i class="ion-ios-arrow-thin-right"></i></div>
                                                    </a>
                                                </footer>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="line transparent little"></div>
                    <!--
                    <section id="dersler" style="margin-top: -30px;padding:  0!important;">
                        <div class="line top">
                            <div>Zazaki Dersler</div>
                        </div>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <b>Ders 1: </b>
                                <a style="font-weight: bold;" href="javascript:void(0);">Cras justo odio</a>
                                <span style="float:right"><i class="ion-eye"> </i> 258</span>
                            </li>
                            <li class="list-group-item ">
                                <b>Ders 2: </b>
                                <a style="font-weight: bold;" href="javascript:void(0);">Lorem ipsum dolor sit amet</a>
                                <span style="float:right"><i class="ion-eye"> </i> 785</span>
                            </li>
                            <li class="list-group-item">
                                <b>Ders 3: </b>
                                <a style="font-weight: bold;" href="javascript:void(0);">Cras justo odio</a>
                                <span style="float:right"><span class="badge badge-danger"><i class="ion-eye"> </i> 785</span></span>
                            </li>
                            <li class="list-group-item ">
                                <b>Ders 4: </b>
                                <a style="font-weight: bold;" href="javascript:void(0);">Lorem ipsum dolor sit amet</a>
                                <span style="float:right"><span class="badge badge-warning"><i class="ion-eye"> </i> 785</span></span>
                            </li>
                        </ul>
                    </section>
                    <section id="dersler" style="margin-top: -30px;padding:  0!important;">
                        <div class="line top">
                            <div>Materyaller</div>
                        </div>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <b>PDF: </b>
                                <a style="font-weight: bold;" href="javascript:void(0);">Cras justo odio</a>
                                <span style="float:right"><span class="badge badge-success"><i class="glyphicon glyphicon-download-alt"> </i> 258</span></span>
                            </li>
                            <li class="list-group-item">
                                <b>PDF: </b>
                                <a style="font-weight: bold;" href="javascript:void(0);">Cras justo odio</a>
                                <span style="float:right"><span class="badge badge-primary"><i class="fa fa-download"> </i> 258</span></span>
                            </li>
                            <li class="list-group-item ">
                                <b>DOC: </b>
                                <a style="font-weight: bold;" href="javascript:void(0);">Lorem ipsum dolor sit amet</a>
                                <span style="float:right"><i class="fa fa-download"> </i> 257</span>
                            </li>
                            <li class="list-group-item ">
                                <b>PPT: </b>
                                <a style="font-weight: bold;" href="javascript:void(0);">Lorem ipsum dolor sit amet</a>
                                <span style="float:right"><i class="fa fa-download"> </i> 367</span>
                            </li>
                        </ul>
                    </section> -->
                    <div id="lineSet" class="line top">
                        <div><?php echo html_escape($setting[0]->recent_posts_title); ?></div>
                    </div>
                    <div class="row">
                        <?php foreach ($feedPosts as $feedPost) { ?>
                            <article class="col-md-12 article-list">
                                <div class="inner">
                                    <figure>
                                        <a title="<?php echo $feedPost->post_title; ?>"
                                           href="<?php echo permalinkCreator('c', $feedPost->post_id, $feedPost->post_title); ?>">
                                            <img id="featuredIMG" src="<?php echo $feedPost->post_img; ?>"
                                                 alt="<?php echo $feedPost->post_tags; ?>">
                                        </a>
                                    </figure>
                                    <div class="details">
                                        <div class="detail">
                                            <div class="category">
                                                <a href="<?php echo base_url('category') . "/" . seo(getCatNameByID($feedPost->post_category)[0]->cat_name) . "/" . getCatNameByID($feedPost->post_category)[0]->cat_id; ?>/1"><?php echo getCatName($feedPost->post_id)[0]->cat_name; ?></a>
                                            </div>
                                            <div class="time">
                                                <?php setlocale(LC_TIME, 'tr_CA.UTF-8');
                                                echo dateTranslate(date('d M Y', strtotime($feedPost->createdAt))); ?>
                                            </div>
                                        </div>
                                        <h1>
                                            <a href="<?php echo permalinkCreator('c', $feedPost->post_id, $feedPost->post_title); ?>"><?php echo $feedPost->post_title; ?></a>
                                        </h1>
                                        <p>
                                            <?php echo strip_tags(substr($feedPost->post_text, 0, 124)) . '...'; ?>
                                        </p>
                                        <footer>
											<span class="love">
												<i class="ion-eye"></i> <div><?php echo $feedPost->post_views; ?></div>
											</span>
                                            <span style="margin-left:20px;" class="love">
												<i class="ion-chatbubbles"></i> <div><?php echo commentCount($feedPost->post_id); ?></div>
											</span>
                                            <a class="btn btn-primary more"
                                               href="<?php echo permalinkCreator('c', $feedPost->post_id, $feedPost->post_title); ?>">
                                                <div><?php echo lang('readMore'); ?></div>
                                                <div><i class="ion-ios-arrow-thin-right"></i></div>
                                            </a>
                                        </footer>
                                    </div>
                                </div>
                            </article>
                        <?php } ?>

                    </div>
                </div>
                <?php $this->load->view('inc/sidebar'); ?>
            </div>
        </div>
    </section>
<?php if (count($popularThisWeek) < 3) {
} else { ?>
    <section class="best-of-the-week">
        <div class="container">
            <h1>
                <div class="text"><?php echo getCatNameByID($setting[0]->bottom_slider_category)[0]->cat_name; ?></div>
                <div class="carousel-nav" id="best-of-the-week-nav">
                    <div class="prev">
                        <i class="ion-ios-arrow-left"></i>
                    </div>
                    <div class="next">
                        <i class="ion-ios-arrow-right"></i>
                    </div>
                </div>
            </h1>
            <div class="owl-carousel owl-theme carousel-1" id="featured2">


                <?php for ($i = 0; $i < count($popularThisWeek); $i++) { ?>
                    <article class="article">
                        <div class="inner">
                            <figure>
                                <a href="<?php echo permalinkCreator('c', $popularThisWeek[$i]->post_id, $popularThisWeek[$i]->post_title); ?>">
                                    <img height="200px" style="object-fit: cover;"
                                         title="<?php echo $popularThisWeek[$i]->post_title; ?>"
                                         src="<?php echo base_url($popularThisWeek[$i]->post_img); ?>"
                                         alt="<?php echo strip_tags($popularThisWeek[$i]->post_tags); ?>">
                                </a>
                            </figure>
                            <div class="padding">
                                <div class="detail">
                                    <div class="time"><i
                                                class="fa fa-clock-o"></i> <?php setlocale(LC_TIME, 'tr_CA.UTF-8');
                                        echo dateTranslate(date('d M Y', strtotime($popularThisWeek[$i]->createdAt))); ?>
                                    </div>
                                    <div class="category"><i class="fa fa-list"></i> <a
                                                href="<?php echo base_url('category') . "/" . seo(getCatNameByID($popularThisWeek[$i]->post_category)[0]->cat_name) . "/" . getCatNameByID($popularThisWeek[$i]->post_category)[0]->cat_id; ?>/1"><?php echo getCatName($popularThisWeek[$i]->post_id)[0]->cat_name; ?></a>
                                    </div>
                                </div>
                                <h2>
                                    <a href="<?php echo permalinkCreator('c', $popularThisWeek[$i]->post_id, $popularThisWeek[$i]->post_title); ?>"><?php echo limitChars(strip_tags($popularThisWeek[$i]->post_title), 40, '...'); ?></a>
                                </h2>
                                <p><?php echo limitChars(strip_tags($popularThisWeek[$i]->post_text), '70', '...'); ?></p>
                            </div>
                        </div>
                    </article>
                <?php } ?>

            </div>
        </div>
    </section>
<?php } ?>
<?php $this->load->view('inc/footer'); ?>