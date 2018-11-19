<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Start footer -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="block">
                    <h1 class="block-title"><?php $title = $footer[0]->about_us_title; if(!empty($title) || !is_null($title)){ echo trim($title); } ?></h1>
                    <div class="block-body">
                        <figure class="foot-logo">
                            <img width="170" src="<?php echo base_url('assets/'); ?>images/logo-light.png"
                                 class="img-responsive" alt="<?php $keywords = $setting[0]->set_keywords; if(!empty($keywords) || !is_null($keywords)){ echo $keywords; } ?>">
                        </figure>
                        <p class="brand-description">
                            <?php $text = $footer[0]->about_us_text; if(!empty($text) || !is_null($text)){ echo $text; } ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="block">
                    <h1 class="block-title"><?php echo trim(strip_tags($footer[0]->recent_posts_title)); ?></h1>
                    <div class="block-body">
                        <?php foreach(recentPostsFooter($footer[0]->recent_posts_count) as $post){ ?>
                        <article class="article-mini">
                            <div class="inner">
                                <figure>
                                    <a title="<?php echo $post->post_title; ?>" href="<?php echo permalinkCreator('c', $post->post_id, $post->post_title); ?>">
                                        <img style="object-fit: cover; height: 50px!important;" src="<?php echo base_url($post->post_img); ?>" alt="<?php echo strip_tags($post->post_tags); ?>">
                                    </a>
                                </figure>
                                <div class="padding">
                                    <h1 style="line-height: 1!important;"><a href="<?php echo permalinkCreator('c', $post->post_id, $post->post_title); ?>"><?php echo limitChars($post->post_title, 32); ?></a></h1>
                                    <p style="color:#999;"><small><?php echo limitChars(strip_tags($post->post_text), 65); ?></small></p>
                                </div>
                            </div>
                        </article>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xs-12 col-sm-6">
                <div class="block">
                    <h1 class="block-title"><?php echo trim(strip_tags($footer[0]->social_title)); ?></h1>
                    <div class="block-body">
                        <ul class="social trp">
                            <?php
                            $facebook = trim(strip_tags($footer[0]->social_facebook));
                            $twitter = trim(strip_tags($footer[0]->social_twitter));
                            $pinterest = trim(strip_tags($footer[0]->social_pinterest));
                            $instagram = trim(strip_tags($footer[0]->social_instagram));
                            ?>

                            <?php if(empty($facebook)){} else{ ?>
                            <li>
                                <a rel="nofollow" title="<?php echo $setting[0]->set_title_suffix ?> facebook" href="<?php echo $facebook; ?>" class="facebook">
                                    <svg>
                                        <rect width="0" height="0"/>
                                    </svg>
                                    <i class="ion-social-facebook"></i>
                                </a>
                            </li><?php } ?>
                            <?php if(empty($twitter)){} else{ ?>
                            <li>
                                <a rel="nofollow" title="<?php echo $setting[0]->set_title_suffix ?> twitter" href="<?php echo $twitter; ?>" class="twitter">
                                    <svg>
                                        <rect width="0" height="0"/>
                                    </svg>
                                    <i class="ion-social-twitter-outline"></i>
                                </a>
                            </li><?php } ?>
                            <?php if(empty($pinterest)){} else{ ?>
                            <li>
                                <a rel="nofollow"title="<?php echo $setting[0]->set_title_suffix ?> pinterest" href="<?php echo $pinterest; ?>" class="pinterest">
                                    <svg>
                                        <rect width="0" height="0"/>
                                    </svg>
                                    <i class="ion-social-pinterest"></i>
                                </a>
                            </li> <?php } ?>
                            <?php if(empty($instagram)){} else{ ?>
                            <li>
                                <a rel="nofollow" title="<?php echo $setting[0]->set_title_suffix ?> instagram" href="<?php echo $instagram; ?>" class="instagram">
                                    <svg>
                                        <rect width="0" height="0"/>
                                    </svg>
                                    <i class="ion-social-instagram-outline"></i>
                                </a>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <!--
                <div class="line"></div>
                <div class="block">
                    <h1 class="block-title">Popüler Kategoriler
                    </h1>
                    <div class="block-body">
                        <ul class="tags">
                            <li><a href="#">HTML5 (<?php echo catPostCount(18); ?>)</a></li>
                        </ul>
                    </div>
                </div>
                -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="copyright">
                    <?php echo trim(strip_tags($footer[0]->copyright)); ?>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- End Footer -->
<script src="<?php echo base_url('assets/') ?>js/jquery.js"></script>
<script src="<?php echo base_url('assets/') ?>js/jquery.migrate.js"></script>
<script src="<?php echo base_url('assets/') ?>scripts/bootstrap/bootstrap.min.js"></script>
<script>var $target_end = $(".best-of-the-week");</script>
<script src="<?php echo base_url('assets/') ?>scripts/jquery-number/jquery.number.min.js"></script>
<script src="<?php echo base_url('assets/') ?>scripts/owlcarousel/dist/owl.carousel.min.js"></script>
<script src="<?php echo base_url('assets/') ?>scripts/magnific-popup/dist/jquery.magnific-popup.min.js"></script>
<script src="<?php echo base_url('assets/') ?>scripts/easescroll/jquery.easeScroll.js"></script>
<script src="<?php echo base_url('assets/') ?>scripts/sweetalert/dist/sweetalert.min.js"></script>
<script src="<?php echo base_url('assets/') ?>scripts/toast/jquery.toast.min.js"></script>
<script src="<?php echo base_url('assets/') ?>js/themeJS.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lazyload@2.0.0-beta.2/lazyload.js"></script>
<script type="text/javascript">
    $("html").prepend('<div id="preloader"><div class="spinner-sm spinner-sm-1" id="status"> </div></div>');
    $(window).on('load', function () {
        $('#status').fadeOut();
        $('#preloader').fadeOut('fast');
        $('body').css({'overflow': 'visible'});
    })
    $("#lazy").lazyload();
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "4000"
    }

        $('.test-popup-link').magnificPopup({
            items: [
                {
                    src: '.test-popup-link', // CSS selector of an element on page that should be used as a popup
                    type: 'inline'
                },
                {
                    src: '.test-popup-link2', // CSS selector of an element on page that should be used as a popup
                    type: 'inline'
                },
                {
                    src: '.test-popup-link3', // CSS selector of an element on page that should be used as a popup
                    type: 'inline'
                }

            ],
            type: 'image',
            gallery:false
        });




    /*
    $('.test-popup-link').magnificPopup({
        items: [
            {
                src: 'http://vimeo.com/123123',
                type: 'iframe' // this overrides default type
            },
            {
                src: $('<div>Dynamically created element</div>'), // Dynamically created element
                type: 'inline'
            },
            {
                src: '<div>HTML string</div>',
                type: 'inline'
            },
            {
                src: '#my-popup', // CSS selector of an element on page that should be used as a popup
                type: 'inline'
            }
        ],
        type: 'image'
        // other options
    });*/
</script>
<?php
    echo '<script>'.$this->session->flashdata('swalfront').'</script>';
 ?>
<?php if ($this->session->flashdata('loginStatus')) {
    echo $this->session->flashdata('loginStatus');
} ?>
<?php if ($this->session->flashdata('captchaStatus')) {
    echo $this->session->flashdata('captchaStatus');
} ?>
<?php echo validation_errors('', ''); ?>
<?php if (!is_null($setting[0]->set_analytics) || !empty($setting[0]->set_analytics)) {
    echo $setting[0]->set_analytics;
} ?>
</body>
</html>