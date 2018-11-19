<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Aslan
 * Date: 23.08.2018
 * Time: 11:04
 */
$this->load->view('inc/header'); ?><title><?php echo lang('myPosts'); ?> - <?php echo $setting[0]->set_title_suffix; ?></title>
    <section>
        <div class="container">
            <div class="row">
                <?php $this->load->view('userprofile/sidebar'); ?>
                <div class="col-md-8">
                    <div style="border: 1px solid #ccc; height: auto; padding: 15px 30px;">
                        <div class="row">
                            <h5 style="font-weight: 600;"><?php echo lang('myPosts'); ?></h5>
                            <div class="table table-responsive">
                                <hr>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th id="thStyle" scope="col"><?php echo lang('postsTitle'); ?></th>
                                        <th id="thStyle" scope="col"><i title="views" class="ion ion-eye"></i></th>
                                        <th id="thStyle" scope="col"><?php echo lang('status'); ?></th>
                                        <th id="thStyle" scope="col"><?php echo lang('date'); ?></th>
                                        <th id="thStyle" scope="col"><?php echo lang('functions'); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($posts as $post){ ?>
                                    <tr>
                                        <td id="tdStyle"><?php echo $post->post_title; ?></td>
                                        <td id="tdStyle"><?php echo $post->post_views; ?></td>
                                        <td id="tdStyle2">
                                            <?php
                                                $status = $post->isDraft;
                                                if($status){ ?>
                                                    <span id="approvedBadge" class="label label-warning"><?php echo lang('waitingC'); ?></span>
                                               <?php }else{ ?>
                                                    <span id="approvedBadge" class="label label-success"><?php echo lang('approvedA'); ?></span>
                                              <?php  }
                                            ?>
                                        </td>
                                        <td id="tdStyle"><?php echo $post->createdAt; ?></td>
                                        <td id="tdStyle">
                                            <a href="<?php echo base_url('profile/post/delete/') . $post->secureID; ?>" class="btn btn-danger btn-sm btn-custom"><i class="fa fa-remove"></i> <?php echo lang('delete'); ?></a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $this->load->view('inc/footer'); ?>