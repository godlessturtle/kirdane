<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Aslan
 * Date: 23.08.2018
 * Time: 11:08
 */
class UserProfileController extends CI_Controller
{
    static $data = array();
    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
        $data['setting'] = $this->MainModel->getSettings();
    }

    public function isUserLoggedIn()
    {
        if (!$this->session->userdata('userInfo')) {
            redirect(base_url('user-login'));
        }
    }

    public function index()
    {
        $this->isUserLoggedIn();
        $data['menus'] = $this->MainModel->getMenus();
        $data['setting'] = $this->MainModel->getSettings();
        $data['footer'] = $this->MainModel->getFooterSettings();
        $this->load->view('userprofile/profile', $data);
    }

    public function updateProfile()
    {
        $this->isUserLoggedIn();
        $user_id = $this->session->userdata('userInfo')[0]->user_id;
        $user = userDetails($user_id)[0];
        $this->form_validation->set_rules('user_name', exprs('fullName'), 'trim|required|alpha_numeric_spaces');
        $this->form_validation->set_rules('user_email', 'e-Mail', 'trim|required|valid_email');
        $this->form_validation->set_rules('user_details', exprs('aboutMe'), 'trim|required');
        if ($this->form_validation->run()) {
            $mail = $this->security->xss_clean(html_escape(trim($this->input->post('user_email'))));
            if (!$this->UserModel->isAdminMail($mail)) {
                $this->load->library('upload');
                if ($_FILES['user_img']['size'] == 0) {
                    $path = $user->user_img;
                } else {
                    $config['upload_path'] = 'assets/user_images/';
                    $config['allowed_types'] = 'jpeg|jpg|png';
                    $config['max_size'] = 2048;
                    $config['file_name'] = 'kirdane-user-' . create_uniq(7) . rand(0,1000);
                    $config['min_width'] = 45;
                    $config['min_height'] = 45;
                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('user_img')) {

                        $img = $this->upload->data()['file_name'];
                        $path = 'assets/user_images/' . $img;

                    } else {
                        $this->session->set_flashdata('swalfront', 'swal('.exprs('error').', '.exprs('format_exception').', "error");');
                        redirect(base_url('profile'));
                    }
                }

                if ($_FILES['user_cover']['size'] == 0) {
                    $path2 = $user->user_cover_img;
                } else {
                    $config['upload_path'] = 'assets/user_images/';
                    $config['allowed_types'] = 'jpeg|jpg|png';
                    $config['max_size'] = 2048;
                    $config['file_name'] = 'kirdane-cover-' . create_uniq(7) . rand(0,1000);
                    $config['min_width'] = 45;
                    $config['min_height'] = 45;
                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('user_cover')) {
                        $img2 = $this->upload->data()['file_name'];
                        $path2 = 'assets/user_images/' . $img2;

                    } else {
                        $this->session->set_flashdata('swalfront', 'swal('.exprs("error").', '.exprs('format_exception').', "error");');
                        redirect(base_url('profile'));
                    }
                }

                $updateData = array(
                    'user_name' => $this->security->xss_clean(html_escape(trim($this->input->post('user_name')))),
                    'user_email' => $mail,
                    'user_detail' => $this->security->xss_clean(html_escape(trim($this->input->post('user_details')))),
                    'user_img' => $path,
                    'user_cover_img' => $path2
                );
                $this->MainModel->updateUser($user->user_id, $updateData);
                $this->session->set_flashdata('swalfront', 'swal('.exprs("success").', '.exprs('updatedScf').', "success");');
                redirect(base_url('profile'));
            } else {
                $this->session->set_flashdata('swalfront', 'swal('.exprs("error").', '.exprs('user_exists').', "error");');
                redirect(base_url('profile'));
            }
        } else {
            //KOD: 254923
            $this->session->set_flashdata('swalfront', 'swal('.exprs("error").', '.exprs('uncaught_err').', "error");');
            redirect(base_url('profile'));
        }
    }


    public function posts()
    {
        $this->isUserLoggedIn();
        $data['menus'] = $this->MainModel->getMenus();
        $data['setting'] = $this->MainModel->getSettings();
        $data['footer'] = $this->MainModel->getFooterSettings();
        $data['categories'] = $this->MainModel->getCategories();
        $data['posts'] =$this->UserModel->userPosts($this->session->userdata('userInfo')[0]->user_id);
        $this->load->view('userprofile/posts', $data);
    }


    public function password()
    {
        $this->isUserLoggedIn();
        $data['menus'] = $this->MainModel->getMenus();
        $data['setting'] = $this->MainModel->getSettings();
        $data['footer'] = $this->MainModel->getFooterSettings();
        $this->load->view('userprofile/password', $data);
    }

    public function post()
    {
        $this->isUserLoggedIn();
        $data['menus'] = $this->MainModel->getMenus();
        $data['setting'] = $this->MainModel->getSettings();
        $data['footer'] = $this->MainModel->getFooterSettings();
        $data['categories'] = $this->MainModel->getCategories();
        $this->load->helper('captcha');
        $vals = array(
            'img_path' => './captcha/',
            'img_url' => base_url() . 'captcha/',
            'img_width' => '120',
            'img_height' => 40,
            'expiration' => 7200,
            'word_length' => 6,
            'font_size' => 18,
            'img_id' => 'Imageid',
            'pool' => 'abcdefghijklmnopqrstuvwxyz',
            'colors' => array(
                'background' => array(0, 0, 0),
                'border' => array(255, 255, 255),
                'text' => array(255, 255, 255),
                'grid' => array(255, 40, 40)
            )
        );
        $cap = create_captcha($vals);
        $data['captcha'] = $cap;
        $this->session->set_userdata('captchaWord', array($cap['filename'], $cap['word']));
        $this->load->view('userprofile/post', $data);
    }

    public function createPost()
    {
        $this->isUserLoggedIn();
        $this->load->model('UserModel');
        $this->form_validation->set_rules('post_title', exprs('postsTitle'), 'trim|required');
        $this->form_validation->set_rules('post_tags', exprs('tags'), 'trim|required');
        $this->form_validation->set_rules('post_text', exprs('post_text'), 'trim|required');
        $this->form_validation->set_rules('post_category', expr('postCategory'), 'trim|required');
        $this->form_validation->set_rules('user_id', "NotAData", 'trim|required');
        if ($this->input->post('captchaWord') == $this->session->userdata('captchaWord')[1]) {
            if ($this->form_validation->run()) {
                $title = $this->security->xss_clean($this->input->post('post_title'));
                $post_slug = seo($title);
                $tags = $this->security->xss_clean($this->input->post('post_tags'));
                $text = $this->security->xss_clean($this->input->post('post_text'));
                $cat_slug = seo($this->security->xss_clean($this->input->post('post_category')));
                $user_id = $this->security->xss_clean($this->encryption->decrypt($this->input->post('user_id')));
                $this->load->library('upload');
                if (!$this->UserModel->hasPost($post_slug)) {
                    if ($_FILES['post_img']['size'] == 0) {
                        $this->session->set_flashdata('swalfront', 'swal('.exprs("error").', '.exprs("empty_exception").', "error");');
                        redirect(base_url('post'));
                    } else {
                        $config['upload_path'] = 'assets/postimages/';
                        $config['allowed_types'] = 'jpeg|jpg|png';
                        $config['max_size'] = 1024;
                        $config['file_name'] = 'kirdane-post-' . rand(15000, 25000) . rand(0, 25000);
                        $config['min_width'] = 45;
                        $config['min_height'] = 45;
                        $this->upload->initialize($config);

                        if ($this->upload->do_upload('post_img')) {
                            $img2 = $this->upload->data()['file_name'];
                            $path2 = 'assets/postimages/' . $img2;

                        } else {
                            $this->session->set_flashdata('swalfront', 'swal('.exprs("error").', '.exprs('format_exception').', "error");');
                            redirect(base_url('post'));
                        }
                    }
                    $cat_id = $this->UserModel->catNameBySlug($cat_slug)[0]->cat_id;
                    $needConfirmation = userDetails($user_id)[0]->needConfirmation;
                    if($needConfirmation==1){
                        $isDraft = 1;
                        $this->session->set_flashdata('swalfront', 'swal('.exprs("success").', '.exprs("waiting_c").', "success");');
                    }else if($needConfirmation==0){
                        $isDraft = 0;
                        $this->session->set_flashdata('swalfront', 'swal('.exprs("success").', '.exprs("approved_a").', "success");');
                    }
                    $insertData = array(
                        'post_title' => strip_tags($title),
                        'post_slug' => strip_tags($post_slug),
                        'post_tags' => strip_tags($tags),
                        'post_text' => strip_tags($text),
                        'post_category' => strip_tags($cat_id),
                        'post_author' => strip_tags($user_id),
                        'post_img' => $path2,
                        'isDraft' => $isDraft,
                        'secureID' => create_uniq(rand(7,11))
                    );
                    $this->UserModel->insertPost($insertData);
                    redirect(base_url('post'));
                } else {
                    $this->session->set_flashdata('swalfront', 'swal('.exprs("error").', '.exprs("post_exists").', "error");');
                    redirect(base_url('post'));
                }
            } else {
                $this->load->view('userprofile/post');
            }
        } else {
            $this->session->set_flashdata('swalfront', 'swal('.exprs("error").', '.exprs("captcha_err").', "error");');
            redirect(base_url('post'));
        }


    }

    public function deletePost($secureID){
        $this->isUserLoggedIn();
        $secureID = $this->security->xss_clean($secureID);
        $user_id = $this->session->userdata('userInfo')[0]->user_id;

        if($this->UserModel->isValidID($secureID) != 0){
            //gerçek post sahibi mi?
            if($this->UserModel->checkPostAuthor($secureID, $user_id) != 0){
                //evet
                $this->UserModel->deletePost($secureID);
                $this->session->set_flashdata('swalfront', 'swal('.exprs("success").', '.exprs('deletedScf').', "success");');
                redirect(base_url('posts'));
            }else{
                //hayır
                $this->notFound();
            }

        }else{
            $this->notFound();
        }

    }


    public function changePass(){
        $this->isUserLoggedIn();
        $this->form_validation->set_rules('old_password', exprs('oldPass'), 'trim|required');
        $this->form_validation->set_rules('new_password', exprs('newPass'), 'trim|required|matches[re_password]');
        $this->form_validation->set_rules('re_password', exprs('rePass'), 'trim|required');
        $errors = array(
            'required' => 'swal('.exprs('warning').', '.exprs('requiredInput').', "warning");',
            'matches' => 'swal('.exprs('warning').', '.exprs('ntMatches').', "warning");'

        );
        $this->form_validation->set_message($errors);
        if($this->form_validation->run()){
            $oldPass = trim($this->security->xss_clean($this->input->post('old_password')));
            $newPass = trim($this->security->xss_clean($this->input->post('new_password')));

            $user_id = $this->session->userdata('userInfo')[0]->user_id;
            $userPass = $this->UserModel->getUserPass($user_id)[0]->user_password;

            $hashedPass = md5(sha1($oldPass));
            if($hashedPass == $userPass){
                $updateData = array(
                    'user_password' => md5(sha1($newPass))
                );
                $this->UserModel->updatePass($updateData, $user_id);
                $this->session->set_flashdata('swalfront', 'swal('.exprs("success").', '.exprs('updatedScf').', "success");');
                redirect(base_url('password'));
            }else{
                $this->password();
            }
        }else{
            $this->password();
        }




    }


    public function notFound(){
        $data['menus'] = $this->MainModel->getMenus();
        $data['footer'] = $this->MainModel->getFooterSettings();
        $data['setting'] = $this->MainModel->getSettings();
        $this->load->view('errors/cli/error_404', $data);
    }

}