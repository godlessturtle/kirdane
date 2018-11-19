<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if($this->session->userdata('userInfo')){
    $user_id = $this->session->userdata('userInfo')[0]->user_id;
    $user = userDetails($user_id)[0];
}
/**
 * Created by PhpStorm.
 * User: Aslan
 * Date: 23.08.2018
 * Time: 11:19
 */ ?>

<div class="col-md-3">
    <div style="border: 1px solid #ccc; height: auto; padding: 15px 30px;">
        <img class="img-responsive"
             style="width: 175px; height: 175px;object-fit: cover;margin: 0 auto; border-radius: 90px;"
             src="<?php echo base_url($user->user_img); ?>">
        <p style="margin-top: 10px;" class="text-center"><b><?php echo $user->user_name; ?></b></p>
        <hr>
        <ul style="list-style: none!important; align-items: center; width: fit-content;margin: 0 auto;    padding-right: 18px;"
            class="magz-list">
            <li style="text-align: center;padding: 10px 5px;"><a style="font-size: 16px;" class="font-lato text-center"
                                                                 href="<?php echo base_url('profile'); ?>"><b><i
                                class="fa fa-user"></i> Profilim</b></a></li>
            <li style="text-align: center;padding: 10px 5px;"
            "><a style="font-size: 16px" class="text-center" href="<?php echo base_url('posts'); ?>"><b><i
                            class="fa fa-file-text"></i> Yazılarım</b></a></li>
            <li style="text-align: center;padding: 10px 5px;"
            "><a style="font-size: 16px;" class="text-center" href="<?php echo base_url('post'); ?>"><i
                        class="fa fa-file-text"></i> <b>Yeni Yazı</b></a></li>
            <li style="text-align: center;padding: 10px 5px;"
            "><a style="font-size: 16px;" class="text-center" href="<?php echo base_url('password'); ?>"><i
                        class="fa fa-file-text"></i> <b>Şifre İşlemleri</b></a></li>
            <li style="text-align: center;padding: 10px 5px;"
            "><a style="font-size: 16px;" class="text-center" href="<?php echo base_url('logout'); ?>"><i
                        class="fa fa-power-off"></i><b> Çıkış Yap</b></a></li>
        </ul>
    </div>
</div>