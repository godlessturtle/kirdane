<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
    <!DOCTYPE html>
    <html>
<head>
<?php
if (
    !is_null($setting[0]->set_title_suffix) || !empty($setting[0]->set_title_suffix)
    &&
    !is_null($setting[0]->set_search_title) || !empty($setting[0]->set_search_title)
) {
    $title = $setting[0]->set_search_title . ": " . html_escape($searchTerm) . " - " . $setting[0]->set_title_suffix;
}
?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="<?php echo html_escape($setting[0]->set_description); ?>">
    <meta name="author" content="Kirdane">
    <meta name="keyword"
          content="<?php echo html_escape($setting[0]->set_description) . "," . html_escape($searchTerm) ?>">
    <!-- Shareable -->
    <meta property="og:title" content="<?php echo $title; ?>"/>
    <meta property="og:type" content="search"/>
    <meta property="og:url" content="<?php echo current_url(); ?>"/>
    <title><?php echo $title; ?></title>
<?php $this->load->view('inc/header'); ?>
    <section class="category">
        <div class="container">
            <div class="row">
                <div class="col-md-8 text-left">
                    <div class="row">
                        <div class="col-md-12">
                            <ol class="breadcrumb">
                                <li>
                                    <a href="<?php echo base_url(); ?>"><?php echo $setting[0]->set_homepage_title; ?></a>
                                </li>
                                <li class="active"><?php echo $setting[0]->set_search_title; ?></li>
                            </ol>
                            <h1 class="page-title">"<?php echo html_escape($searchTerm); ?>"</h1>
                            <p class="page-subtitle"> <?php echo html_escape(lang('searchT')); ?></p>
                        </div>
                    </div>
                    <div class="line"></div>
                    <div class="row">
                        <?php foreach ($searchResults as $cat) { ?>
                            <article class="col-md-12 article-list">
                                <div class="inner">
                                    <figure>
                                        <a href="<?php echo permalinkCreator('c', $cat->post_id, $cat->post_title); ?>">
                                            <img id="featuredIMG" src="<?php echo base_url($cat->post_img); ?>"
                                                 alt="<?php echo $cat->post_tags; ?>">
                                        </a>
                                    </figure>
                                    <div class="details">
                                        <div class="detail">
                                            <div class="category">
                                                <a href="<?php echo base_url('category') . "/" . seo(getCatNameByID($cat->post_category)[0]->cat_name) . "/" . getCatNameByID($cat->post_category)[0]->cat_id; ?>"><?php echo getCatName($cat->post_id)[0]->cat_name; ?></a>
                                            </div>
                                            <div class="time">
                                                <?php setlocale(LC_TIME, 'tr_CA.UTF-8');
                                                echo dateTranslate(date('d M Y', strtotime($cat->createdAt))); ?>
                                            </div>
                                        </div>
                                        <h1>
                                            <a href="<?php echo permalinkCreator('c', $cat->post_id, $cat->post_title); ?>"><?php echo $cat->post_title; ?></a>
                                        </h1>
                                        <p>
                                            <?php echo strip_tags(substr($cat->post_text, 0, 124)) . '...'; ?>
                                        </p>
                                        <footer>
											<span class="love">
												<i class="ion-eye"></i> <div><?php echo $cat->post_views; ?></div>
											</span>
                                            <span style="margin-left:20px;" class="love">
												<i class="ion-chatbubbles"></i> <div>12</div>
											</span>
                                            <a class="btn btn-primary more"
                                               href="<?php echo permalinkCreator('c', $cat->post_id, $cat->post_title); ?>">
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
<?php $this->load->view('inc/footer'); ?>