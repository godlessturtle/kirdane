<div class="col-xs-12 col-md-4 sidebar" id="sidebar">
    <br class="hidden-md hidden-lg">
    <div class="line sidebar-title hidden-md hidden-sm hidden-lg">
        <div>Sidebar</div>
    </div>
    <br class="hidden-md hidden-lg"><br class="hidden-md hidden-lg">

    <aside>
        <ul class="nav nav-tabs nav-justified" role="tablist">
            <li class="active">
                <a href="#recomended" aria-controls="recomended" role="tab" data-toggle="tab">
                    <i class="ion-android-star-outline"></i> <?php echo lang('popularArticles'); ?>
                </a>
            </li>
            <li>
                <a href="#comments" aria-controls="comments" role="tab" data-toggle="tab">
                    <i class="ion-ios-chatboxes-outline"></i> <?php echo lang('recentComments'); ?>
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="recomended">
                <?php $getPopularPosts = $getPopularPosts->result(); ?>
                <?php for ($i = 0; $i < count($getPopularPosts); $i++) {
                    if ($i == 0) { ?>
                        <article class="article-fw">
                            <div class="inner">
                                <figure>
                                    <a href="<?php echo permalinkCreator('c', $getPopularPosts[$i]->post_id, $getPopularPosts[$i]->post_title); ?>">
                                        <img src="<?php echo base_url($getPopularPosts[$i]->post_img); ?>">
                                    </a>
                                </figure>
                                <div class="details">
                                    <h1>
                                        <a href="<?php echo permalinkCreator('c', $getPopularPosts[$i]->post_id, $getPopularPosts[$i]->post_title); ?>"><?php echo $getPopularPosts[$i]->post_title; ?></a>
                                    </h1>
                                    <p>
                                        <?php $limit = 180;
                                        echo substr($getPopularPosts[$i]->post_text, 0, $limit);
                                        if (strlen($getPopularPosts[$i]->post_text) > $limit) {
                                            echo '[...]';
                                        } ?>
                                    </p>
                                    <div class="detail">
                                        <div class="time"><?php setlocale(LC_TIME, 'tr_CA.UTF-8');
                                        echo dateTranslate(date('d M Y', strtotime($getPopularPosts[$i]->createdAt))); ?></div>
                                        <div class="category"><a
                                            href="<?php echo base_url('category') . "/" . seo(getCatNameByID($getPopularPosts[$i]->post_category)[0]->cat_name) . "/" . getCatNameByID($getPopularPosts[$i]->post_category)[0]->cat_id; ?>/1"><?php echo getCatNameByID($getPopularPosts[$i]->post_category)[0]->cat_name; ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                        <div class="line"></div>
                    <?php } elseif ($i > 0) { ?>


                        <article class="article-mini">
                            <div class="inner">
                                <figure>
                                    <a href="<?php echo permalinkCreator('c', $getPopularPosts[$i]->post_id, $getPopularPosts[$i]->post_title); ?>">
                                        <img src="<?php echo base_url($getPopularPosts[$i]->post_img); ?>">
                                    </a>
                                </figure>
                                <div class="padding">
                                    <h1>
                                        <a href="<?php echo permalinkCreator('c', $getPopularPosts[$i]->post_id, $getPopularPosts[$i]->post_title); ?>"><?php echo $getPopularPosts[$i]->post_title; ?></a>
                                    </h1>
                                    <div class="detail">
                                        <div class="category"><a
                                            href="<?php echo base_url('category') . "/" . seo(getCatNameByID($getPopularPosts[$i]->post_category)[0]->cat_name) . "/" . getCatNameByID($getPopularPosts[$i]->post_category)[0]->cat_id; ?>/1"><?php echo getCatNameByID($getPopularPosts[$i]->post_category)[0]->cat_name; ?></a>
                                        </div>
                                        <div class="time"><?php setlocale(LC_TIME, 'tr_CA.UTF-8');
                                        echo dateTranslate(date('d M Y', strtotime($getPopularPosts[$i]->createdAt))); ?></div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    <?php }
                } ?>
            </div>
            <div class="tab-pane comments" id="comments">
                <div class="comment-list sm">

                    <?php foreach ($getRecentComments as $comment) { ?>
                        <div class="item">
                            <div class="user">
                                <figure>
                                    <img src="<?php echo base_url($comment->commenter_img); ?>"
                                    alt="<?php echo $setting[0]->set_keywords; ?>">
                                </figure>
                                <div class="details">
                                    <h5 class="name"><?php echo $comment->commenter_name; if(userDetailsByMail($comment->commenter_email)[0]->user_permission == 121){ echo ' <span style="padding: 2px 4px!important;" class="label label-primary">  <small style="color:white"><i  class="fa fa-star"></i></small></span>'; } ?></h5>
                                    <small><i class="fa fa-clock-o"></i> <?php setlocale(LC_TIME, 'tr_CA.UTF-8');
                                    echo dateTranslate(date('d M Y', strtotime($comment->createdAt))); ?></small>
                                    <div class="description">
                                        <?php
                                        $limit = 100;
                                        echo substr($comment->comment_message, 0, $limit);
                                        if (strlen($comment->comment_message) > $limit) {
                                            echo "[...]";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>


                </div>
            </div>
        </div>
    </aside>
    <aside>
        <h1 class="aside-title"><?php echo html_escape(lang('randomPosts')); ?></h1>
        <div class="aside-body">
            <?php foreach($randomPosts as $post){ ?>
            <article class="article-mini">
                <div class="inner">
                    <figure>
                        <a href="single.html">
                            <img src="<?php echo base_url($post->post_img); ?>" alt="Sample Article">
                        </a>
                    </figure>
                    <div class="padding">
                        <h1><a href="single.html"><?php echo html_escape(limitChars($post->post_title, 65, '...')); ?></a></h1>
                    </div>
                </div>
            </article>
        <?php } ?>
        </div>
    </aside>
    <!--
<?php // if($gallery->num_rows()){ ?>
    <aside id="sponsored">
        <h1 class="aside-title">Galeri

        </h1>

        <div class="aside-body">
            <div class="block">
                <div class="block-body">
                    <ul class="item-list-round" data-magnific="gallery">

                        <?php foreach($gallery->result() as $gallery){ ?>
                        <li>
                            <a href="<?php echo $gallery->img_url; ?>" style="background-image: url('<?php echo $gallery->img_url; ?>');"></a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </aside>
    <?php // } ?> -->
    <aside>
        <h1 class="aside-title">Videolar
            <div class="carousel-nav" id="video-list-nav">
                <div class="prev"><i class="ion-ios-arrow-left"></i></div>
                <div class="next"><i class="ion-ios-arrow-right"></i></div>
            </div>


        </h1>
        <div class="aside-body">
            <ul class="video-list lazyload" data-youtube='"carousel":true, "nav": "#video-list-nav"'>

                <?php foreach($videos as $video){ ?>
                <li>
                    <p style="font-weight: bold;"><i class="fa fa-dot-circle-o"></i> <?php echo $video->video_title; ?></p>
                    <div class="youtube" style="margin-bottom:15px;" data-embed="<?php echo $video->video_yt_id; ?>">
                        <div class="play-button"></div>
                    </div>

                </li>
                <?php } ?>

            </ul>
        </div>
    </aside>
</div>