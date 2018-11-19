<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="author" content="Kirdane">
    <!-- Shareable -->
    <meta property="og:title" content="<?php $title = $page[0]->page_title;
    if(!empty($title) || !is_null($title)){ echo $title . " | " . $setting[0]->set_title_suffix; } ?>"/>
    <meta property="og:type" content="page"/>
    <title><?php $title = $page[0]->page_title;
        if(!empty($title) || !is_null($title)){ echo $title ." | ". $setting[0]->set_title_suffix; } ?></title>
    <?php $this->load->view('inc/header'); ?>

    <section class="page">
        <div style="padding-top:40px;" class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <ol class="breadcrumb">
                        <?php if(!empty($setting[0]->set_homepage_title) || !is_null($setting[0]->set_homepage_title)){ ?>
                        <li><a href="<?php echo base_url(); ?>"><?php echo $setting[0]->set_homepage_title; ?></a></li>
                        <?php } ?>
                        <?php if(!empty($page[0]->page_title) || !is_null($page[0]->page_title)){ ?>
                        <li class="active"><?php echo $page[0]->page_title; ?></li>
                        <?php } ?>
                    </ol>
                    <h1 class="page-title">
                        <?php $title = $page[0]->page_title;
                         if(!empty($title) || !is_null($title)){ echo $title; } ?>
                    </h1>
                    <p class="page-subtitle"><?php if (!empty($page[0]->page_slogan) || !is_null($page[0]->page_slogan)) {
                            echo $page[0]->page_slogan;
                        } ?></p>
                    <div class="line thin"></div>
                    <div class="page-description">
                        <p>
                            <?php $text = $page[0]->page_text;
                            if (!empty($text) || !is_null($text)) {
                                echo $text;
                            }
                            ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php $this->load->view('inc/footer'); ?>