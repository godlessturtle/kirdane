<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<!-- Shareable -->
		<meta property="og:title" content="<?php $not_found_title = $setting[0]->set_404_title; $suffix = $setting[0]->set_title_suffix;
        if(!empty($not_found_title) || !is_null($not_found_title) && !empty($suffix) || !is_null($suffix)){
            echo $not_found_title . " - " . $suffix;
        }
        ?>" />
		<meta property="og:type" content="article" />
		<title><?php $not_found_title = $setting[0]->set_404_title; $suffix = $setting[0]->set_title_suffix;
		if(!empty($not_found_title) || !is_null($not_found_title) && !empty($suffix) || !is_null($suffix)){
		    echo $not_found_title . " - " . $suffix;
        }
		?></title>
		<?php $this->load->view('inc/header'); ?>

		<section class="not-found">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="code">
							404
						</div>
						<h1><?php echo $setting[0]->set_404_subtitle; ?></h1>
						<p class="lead"><?php echo $setting[0]->set_404_text; ?></p>
						<div class="search-form">
							<div class="link">
								<a href="<?php echo base_url(); ?>"><?php echo $setting[0]->set_homepage_title; ?></a>.
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php $this->load->view('inc/footer'); ?>