<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <meta content='<?php echo current_url(); ?>' property='og:url'/>
    <meta name="description" content="<?php echo strip_tags($setting[0]->set_description); ?>">
    <meta name="keyword" content="<?php echo strip_tags($setting[0]->set_keywords); ?>">

    <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>scripts/bootstrap/bootstrap.min.css">
    <!-- IonIcons -->
    <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>scripts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css">
    <!-- Toast -->
    <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>scripts/toast/jquery.toast.min.css">
    <!-- OwlCarousel -->
    <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>scripts/owlcarousel/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet"
          href="<?php echo base_url('assets/'); ?>scripts/owlcarousel/dist/assets/owl.theme.default.min.css">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>scripts/magnific-popup/dist/magnific-popup.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>scripts/sweetalert/dist/sweetalert.css">
    <!-- Custom style -->
    <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>css/style.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>css/skins/all.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>css/demo.css">
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/images/mini-logo-dark.png'); ?>">

</head>
<body class="skin-blue">
<header class="primary">
    <div class="firstbar">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-12">
                    <div class="brand">
                        <a href="<?php echo base_url(); ?>">
                            <img src="<?php echo base_url('assets/'); ?>images/logo1.png" alt="<?php echo $setting[0]->set_keywords; ?>">
                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 pull-right">
                    <form class="search" autocomplete="off" method="get" action="<?php echo base_url('search'); ?>">

                        <div class="form-group">
                            <div class="input-group">
                                <input id="searchInput" type="search" name="q" class="form-control" placeholder="<?php echo lang("searchBox"); ?>">
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-primary"><i class="ion-search"></i>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- Start nav -->
    <nav class="menu">
        <div class="container">
            <div class="brand">
                <a href="<?php echo base_url(); ?>">
                    <img style="width: 125px;margin-top: -8px;"
                         src="<?php echo base_url('assets/'); ?>images/logo-light.png"
                         alt="<?php echo $setting[0]->set_keywords; ?>">
                </a>
            </div>
            <div class="mobile-toggle">
                <a href="#" style="color:#fff!important;" data-toggle="menu" data-target="#menu-list"><i class="ion-navicon-round"></i></a>
            </div>
            <div id="menu-list">
                <ul class="nav-list">
                    <li><img id="mobile-menu" class="hidden-md hidden-lg hidden-sm" style="width: 75%;margin-top: 25px;margin-left:-38px;margin-bottom:10px"
                             src="<?php echo base_url('assets/'); ?>images/logo1.png"
                             alt="<?php echo $setting[0]->set_keywords; ?>"></li>
                    <li class="for-tablet nav-title"><a>Menu</a></li>

                    <?php foreach ($menus as $menu) {
                        if ($menu->menu_type == 1 && !$menu->isMega == 1 || $menu->menu_type == 0 && !$menu->isMega == 1) {
                            echo '<li><a href="' . $menu->menu_link . '">' . $menu->menu_title . '</a></li>';
                        }

                        if ($menu->menu_type == 2 && $menu->isMega == 1) { ?>
                            <li class="dropdown magz-dropdown magz-dropdown-megamenu"><a
                                        href="#"><?php echo $menu->menu_title; ?><i
                                            class="ion-ios-arrow-right"></i> </a>
                                <div class="dropdown-menu megamenu">
                                    <div class="megamenu-inner">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h2 class="megamenu-title"><?php echo lang("popularPostsHeader"); ?></h2>
                                                    </div>
                                                </div>
                                                <ul class="vertical-menu">
                                                    <?php foreach (megaPopular($menu->menu_category) as $pop) { ?>
                                                        <li>
                                                            <a style="color:dodgerblue"
                                                               href="<?php echo permalinkCreator('c', $pop->post_id, $pop->post_title); ?>"><i
                                                                        class="ion-ios-circle-outline"></i><?php echo $pop->post_title; ?>
                                                            </a>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h2 class="megamenu-title"><?php echo lang("recentPosts"); ?></h2>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <?php foreach (megaRecent($menu->menu_category) as $recent) { ?>
                                                        <article class="article col-md-4 mini">
                                                            <div class="inner">
                                                                <figure>
                                                                    <a href="<?php echo permalinkCreator('c', $recent->post_id, $recent->post_title); ?>">
                                                                        <img src="<?php echo base_url($recent->post_img); ?>"
                                                                             alt="<?php echo $recent->post_tags . "," . $recent->post_title; ?>">
                                                                    </a>
                                                                </figure>
                                                                <div class="padding">
                                                                    <div class="detail">
                                                                        <div class="time"><?php setlocale(LC_TIME, 'tr_CA.UTF-8');
                                                                            echo dateTranslate(date('d M Y', strtotime($recent->createdAt))); ?></div>
                                                                        <div class="category"><a
                                                                                    href="<?php echo base_url('category') . "/" . seo(getCatNameByID($recent->post_category)[0]->cat_name) . "/" . getCatNameByID($recent->post_category)[0]->cat_id; ?>"><?php echo getCatName($recent->post_id)[0]->cat_name; ?></a>
                                                                        </div>
                                                                    </div>
                                                                    <h2>
                                                                        <a href="<?php echo permalinkCreator('c', $recent->post_id, $recent->post_title); ?>"><?php echo limitChars($recent->post_title, 48); ?></a>
                                                                    </h2>
                                                                </div>
                                                            </div>
                                                        </article>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php } elseif ($menu->menu_type == 3 && $menu->isMega == 0) { ?>
                            <li class="dropdown magz-dropdown"><a href="javascript:void(0);"><?php echo $menu->menu_title; ?> <i
                                            class="ion-ios-arrow-right"></i></a>
                                <ul class="dropdown-menu">
                                    <?php foreach(subMenus($menu->menu_id) as $sub){ ?>
                                    <li><a href="<?php echo $sub->menu_link; ?>"><?php echo $sub->menu_title; ?></a></li>
                                    <?php } ?>
                                </ul>
                            </li>
                        <?php }
                    }
                    ?>
                </ul>
                <ul class="pull-right nav-list2">
                    <?php if (!$this->session->userdata('userInfo')) { ?>
                        <li><a href="<?php echo base_url('register'); ?>"><i class="ion-person-add"></i>
                                <span class="hidden-xs hidden-sm"><?php echo lang("register"); ?></span>
                            </a></li>
                        <li><a href="<?php echo base_url('user-login'); ?>"><i class="fa fa-sign-in"></i>
                                <span class="hidden-xs hidden-sm"><?php echo lang("login"); ?></span>
                            </a></li>
                    <?php } elseif ($this->session->userdata('userInfo')) { ?>
                        <li><a href="<?php echo base_url('profile'); ?>"><i class=" ion-person"></i>
                                <span class="hidden-xs hidden-sm"><?php echo lang("profile"); ?></span>
                            </a></li>
                        <li><a href="<?php echo base_url('logout'); ?>"><i class=" ion-log-out"></i>
                                <span class="hidden-xs hidden-sm"><?php echo lang("logout"); ?></span>
                            </a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End nav -->
</header>


