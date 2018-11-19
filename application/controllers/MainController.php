<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MainController extends CI_Controller
{
    static $data = array();

    public function __construct()
    {
        parent::__construct();


    }

    public function isLoggedIn()
    {
        if (!$this->session->userdata('userInfo')) {
            $this->session->set_flashdata('swalfront', 'swal('.exprs("warning").', '.exprs('log_in_msg').', "warning");');
            $this->loginPage();
        }
    }

    public function index()
    {

        $data['menus'] = $this->MainModel->getMenus();
        $data['setting'] = $this->MainModel->getSettings();
        $data['feedPosts'] = $this->MainModel->feedPosts($this->MainModel->getSettings()[0]->recent_posts_count);
        $data['footer'] = $this->MainModel->getFooterSettings();
        $data["gallery"] = $this->MainModel->getGalleryImages();
        $data['videos'] = $this->MainModel->getVideos();
        


        $cat_id = $this->MainModel->getSettings()[0]->top_slider_category;
        $post_count = $this->MainModel->getSettings()[0]->top_slider_post_count;
        $slider_type = $this->MainModel->getSettings()[0]->top_slider_type;
        if (!is_null($cat_id) && $slider_type == 1) {
            $data['getCatPosts'] = $this->MainModel->getCatPosts($cat_id, $post_count);
        } elseif (is_null($cat_id) && $slider_type == 0) {
            $data['getCatPosts'] = $this->MainModel->getRecentPostsTS($post_count);
        }

        if (!is_null($this->MainModel->getSettings()[0]->bottom_slider_category)) {
            $cat = $this->MainModel->getSettings()[0]->bottom_slider_category;
            $limit = $this->MainModel->getSettings()[0]->bottom_slider_post_count;
            $data['popularThisWeek'] = $this->MainModel->popularThisWeek($cat, $limit);
        } else {
            $data['popularThisWeek'] = NULL;
        }

        $cat_section_category = $this->MainModel->getSettings()[0]->cat_section_category;
        $cat_section_post_count = $this->MainModel->getSettings()[0]->cat_section_post_count;
        $data['getCategoryPosts'] = $this->MainModel->getCategoryPosts($cat_section_category, $cat_section_post_count);
        $data['getPopularPosts'] = $this->MainModel->getPopularPosts();
        $data['getRecentComments'] = $this->MainModel->getRecentComments();
        $data["randomPosts"] = $this->MainModel->getRandomPosts();


        $this->load->view('index', $data);
    }

    public function register()
    {

        $data['menus'] = $this->MainModel->getMenus();
        $data['footer'] = $this->MainModel->getFooterSettings();
        $data['setting'] = $this->MainModel->getSettings();
        $this->load->helper('captcha');
        $vals = array(
            'img_path' => './captcha/',
            'img_url' => base_url() . 'captcha/',
            'img_width' => 108,
            'img_height' => 40,
            'expiration' => 7200,
            'word_length' => 6,
            'font_size' => 18,
            'img_id' => 'Imageid',
            'pool' => 'abcdefghijklmnopqrstuvwxyz1234567890',
            'colors' => array(
                'background' => array(0, 0, 0),
                'border' => array(255, 255, 255),
                'text' => array(255, 255, 255),
                'grid' => array(255, 40, 40)
            )
        );
        $cap = create_captcha($vals);
        $data['cap'] = $cap;
        $this->session->set_userdata('captchaWord', array($cap['filename'], $cap['word']));
        $this->load->view('register-page', $data);
    }

    public function registUser()
    {

        $data['footer'] = $this->MainModel->getFooterSettings();
        $data['setting'] = $this->MainModel->getSettings();
        $cap = $this->session->userdata('captchaWord');
        $this->form_validation->set_rules('name', 'Ad Soyad', 'trim|required');
        $this->form_validation->set_rules('email', 'e-Posta', 'trim|valid_email|is_unique[users.user_email]|required');
        $this->form_validation->set_rules('password', 'Şifre', 'trim|required|matches[re_password]');
        $this->form_validation->set_rules('re_password', 'Şifre Tekrarı', 'trim|required');
        $this->form_validation->set_rules('cap_code', 'Doğrulama Kodu', 'trim|required');
        $errors = array(
            'required' => "<script>toastr.error(".exprs('requiredInput').", ".exprs('error').")</script>",
            'is_unique' => "<script>toastr.error(".exprs('user_exists').", ".exprs('error').")</script>",
            'matches' => "<script>toastr.error(".exprs('ntMatches').", ".exprs('error').")</script>",
            'valid_email' => "<script>toastr.error(".exprs('t_valid_email').", ".exprs('error').")</script>"
        );

        $this->form_validation->set_message($errors);
        if ($this->form_validation->run()) {

            if ($this->input->post('cap_code') == $cap[1]) {
                $hashedPass = md5(sha1($this->security->xss_clean($this->input->post('password'))));
                $regData = array(
                    'user_name' => $this->input->post('name'),
                    'user_email' => $this->input->post('email'),
                    'user_password' => $hashedPass,
                    'user_permission' => 1,
                    'needConfirmation' => 1
                );
                $this->MainModel->register($regData);
                $this->session->set_flashdata('swalfront', 'swal('.exprs('success').', '.exprs('createdScf').', "success");');
                $this->loginPage();
            } else {
                $this->session->set_flashdata('swalfront', 'swal('.exprs('warning').', '.exprs('captcha_err').', "warning");');
                $this->register();
            }
        } else {
            $this->register();
        }

    }

    function loginPage()
    {

        $data['menus'] = $this->MainModel->getMenus();
        $data['footer'] = $this->MainModel->getFooterSettings();
        $data['setting'] = $this->MainModel->getSettings();
        $this->load->helper('captcha');
        $vals = array(
            'img_path' => './captcha/',
            'img_url' => base_url() . 'captcha/',
            'img_width' => 108,
            'img_height' => 40,
            'expiration' => 7200,
            'word_length' => 6,
            'font_size' => 18,
            'img_id' => 'Imageid',
            'pool' => 'abcdefghijklmnopqrstuvwxyz1234567890',
            'colors' => array(
                'background' => array(0, 0, 0),
                'border' => array(255, 255, 255),
                'text' => array(255, 255, 255),
                'grid' => array(255, 40, 40)
            )
        );
        $cap = create_captcha($vals);
        $data['captcha'] = $cap;
        $this->session->set_userdata('loginCaptcha', array($cap['filename'], $cap['word']));
        $this->load->view('login-page', $data);
    }

    function login()
    {
        $cap = $this->session->userdata('loginCaptcha');
        $this->form_validation->set_rules('email', exprs('e_mail'), 'trim|required|valid_email');
        $this->form_validation->set_rules('password', exprs('pass'), 'trim|required');
        $this->form_validation->set_rules('cap_code', exprs('cap_code'), 'trim|required');
        $errors = array(
            'required' => "<script>toastr.error(".exprs('requiredInput').", ".exprs('error').")</script>",
            'valid_email' => "<script>toastr.error(".exprs('t_valid_email').", ".exprs('error').")</script>"
        );
        $this->form_validation->set_message($errors);

        if ($this->form_validation->run()) {
            $email = trim($this->input->post('email'));
            $password = md5(sha1($this->input->post('password')));

            if ($this->input->post('cap_code') == $cap[1]) {
                if ($this->MainModel->checkUser($email, $password)->num_rows()) {
                    $userInfo = $this->MainModel->checkUser($email, $password)->result();
                    $this->session->set_userdata('userInfo', $userInfo);
                    $this->index();
                } else {
                    $this->session->set_flashdata('swalfront', 'swal('.exprs('error').', '.exprs('lg_error').', "error");');
                    $this->loginPage();
                }
            } else {
                //captcha yanlış
                $this->session->set_flashdata('swalfront', 'swal('.exprs('error').', '.exprs('captcha_err').', "error");');
                $this->loginPage();
            }
        } else {
            //validation
            $this->loginPage();
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('userInfo');
        redirect(base_url());
    }

    public function sendComment()
    {
        $this->load->library('user_agent');
        $this->form_validation->set_rules('commenter_name', 'Ad-Soyad', 'trim|alpha_numeric_spaces|max_length[28]');
        $this->form_validation->set_rules('commenter_email', 'e-Mail', 'trim|valid_email|max_length[65]');
        $this->form_validation->set_rules('commenter_message', 'Yorum', 'trim|min_length[5]');

        if ($this->form_validation->run()) {
            $isMember = $this->security->xss_clean($this->encryption->decrypt($this->input->post('isMember')));

            if ($isMember) {
                $mail = $this->security->xss_clean($this->input->post('commenter_email'));
                $img = $this->MainModel->getUserImg($mail)[0]->user_img;
            } else {
                $img = "assets/images/default-user.png";
            }

            if($this->input->post('csrf')){
                $isApproved = 1;
            }else{
                $isApproved = 0;
            }

            $commentData = array(
                'commenter_name' => $this->security->xss_clean(strip_tags($this->input->post('commenter_name'))),
                'commenter_email' => $this->security->xss_clean($this->input->post('commenter_email')),
                'comment_message' => $this->security->xss_clean(strip_tags($this->input->post('commenter_message'))),
                'whichPost' => $this->encryption->decrypt($this->input->post('whichPost')),
                'isMember' => $this->encryption->decrypt($this->input->post('isMember')),
                'commenter_img' => $img,
                'isApproved' => $isApproved
            );
            $this->MainModel->insertComment($commentData);
            $this->session->set_flashdata('swalfront', 'swal('.exprs('success').', '.lang('commentCondt').', "success");');
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('swalfront', 'swal('.exprs('error').', '.lang('commentErr').', "error");');
            redirect($this->agent->referrer());
        }
    }


    public function single()
    {

        $post_id = $this->security->xss_clean(trim(strip_tags(stripslashes($this->uri->segment(2)))));
        if ($this->MainModel->checkPostID($post_id)) {
            $postCat = postCategory($post_id)[0]->post_category;
            $data['menus'] = $this->MainModel->getMenus();
            $data['single'] = $this->MainModel->single($post_id);
            $data['footer'] = $this->MainModel->getFooterSettings();
            $data['setting'] = $this->MainModel->getSettings();
            $data['relatedPosts'] = $this->MainModel->relatedPosts($postCat);
            $data['getPostComments'] = $this->MainModel->getPostComments($post_id);
            $data['getPopularPosts'] = $this->MainModel->getPopularPosts();
            $data['getRecentPosts'] = $this->MainModel->getRecentPosts();
            $data["randomPosts"] = $this->MainModel->getRandomPosts();
            $this->load->view('single', $data);
        } else {
            $this->notFound();
        }


    }

    public function author($offset = 1)
    {

        $idM = intval($this->security->xss_clean(trim($this->uri->segment(2))));
        $id = str_replace('[removed]', '',$idM);
        if ($this->MainModel->checkAuthorID($id)) {
            $data['menus'] = $this->MainModel->getMenus();
            $data['footer'] = $this->MainModel->getFooterSettings();
            $data['setting'] = $this->MainModel->getSettings();
            $data['authorPost'] = $this->MainModel->getAuthorPosts($id);
            $data['getPopularPosts'] = $this->MainModel->getPopularPosts();
            $data['getRecentComments'] = $this->MainModel->getRecentComments();
            $data['authorInfo'] = getAuthorInfo($id);
            $data["gallery"] = $this->MainModel->getGalleryImages();
            $data["randomPosts"] = $this->MainModel->getRandomPosts();


            $postCount = $this->MainModel->authorPostsCount($id);
            $this->load->library('pagination');

            $config['base_url'] = base_url('author/' . $id . '/') ;
            $config['total_rows'] = $postCount;
            $config['per_page'] = 2;

            $config['cur_tag_open'] = '<li class="active"><a href="1">';
            $config['cur_tag_close'] = '</a></li>';

            $config['last_tag_open'] = '<li class="next">';
            $config['last_tag_close'] = '</li>';
            $config['last_link'] = '»';

            $config['first_tag_open'] = '<li class="next">';
            $config['first_tag_close'] = '</li>';
            $config['first_link'] = '«';

            $config['next_link'] = '';
            $config['next_tag_open'] = '';
            $config['next_tag_close'] = '';

            $config['prev_link'] = '';
            $config['prev_tag_open'] = '';
            $config['prev_tag_close'] = '';

            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';

            $this->pagination->initialize($config);
            $data['pagination'] =  $this->pagination->create_links();



            $data['authorPost'] = $this->MainModel->getAuthorPosts($id, $config['per_page'], $this->uri->segment(3,0));


            $this->load->view('author', $data);
        } else {
            $this->notFound();
        }


    }

    public function category()
    {

        $cat_id = intval($this->security->xss_clean(trim($this->uri->segment(3))));
        $cat_id = str_replace('[removed]', '', $cat_id);
        if ($this->MainModel->checkCatID($cat_id)) {
            $data['footer'] = $this->MainModel->getFooterSettings();
            $data['setting'] = $this->MainModel->getSettings();
            $data['menus'] = $this->MainModel->getMenus();
            $data["gallery"] = $this->MainModel->getGalleryImages();
            //$data['getCatPosts'] = $this->MainModel->getCatPosts($cat_id);
            $data['getPopularPosts'] = $this->MainModel->getPopularPosts();
            $data['getRecentComments'] = $this->MainModel->getRecentComments();
            $data["randomPosts"] = $this->MainModel->getRandomPosts();

            $cat_slug = $this->MainModel->catSlug($cat_id);

            $postCount = $this->MainModel->catPostsCount($cat_id);
            $this->load->library('pagination');

            $config['base_url'] = base_url('category/' . $cat_slug . '/' . $cat_id . "/") ;
            $config['total_rows'] = $postCount;
            $config['per_page'] = 8;

            $config['cur_tag_open'] = '<li class="active"><a href="1">';
            $config['cur_tag_close'] = '</a></li>';

            $config['last_tag_open'] = '<li class="next">';
            $config['last_tag_close'] = '</li>';
            $config['last_link'] = '»';

            $config['first_tag_open'] = '<li class="next">';
            $config['first_tag_close'] = '</li>';
            $config['first_link'] = '«';

            $config['next_link'] = '';
            $config['next_tag_open'] = '';
            $config['next_tag_close'] = '';

            $config['prev_link'] = '';
            $config['prev_tag_open'] = '';
            $config['prev_tag_close'] = '';

            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';

            $this->pagination->initialize($config);
            $data['pagination'] =  $this->pagination->create_links();
            $data['getCatPosts'] = $this->MainModel->catPosts($cat_id, $config['per_page'], $this->uri->segment(4,0));

            $this->load->view('category', $data);
        } else {
            $this->notFound();
        }
    }

    public function page($slug)
    {
        $this->load->library('user_agent');

        $xssFree = $this->security->xss_clean(trim($slug));
        if ($this->MainModel->checkPageSlug($xssFree)) {
            $data['page'] = $this->MainModel->getPageDetails($xssFree);
            $data['footer'] = $this->MainModel->getFooterSettings();
            $data['setting'] = $this->MainModel->getSettings();
            $data['menus'] = $this->MainModel->getMenus();

            $this->load->view('page', $data);
        } else {
            $this->notFound();
        }
    }


    public function search()
    {
        $term =  strip_tags(trim($this->input->get('q')));
        $term = str_replace('[removed]', '', $this->security->xss_clean($term));

        $term = strip_tags($term);
        $data['menus'] = $this->MainModel->getMenus();
        $data['footer'] = $this->MainModel->getFooterSettings();
        $data['setting'] = $this->MainModel->getSettings();
        $data['searchResults'] = $this->MainModel->search($term);
        $data['searchTerm'] = $term;
        $data["gallery"] = $this->MainModel->getGalleryImages();
        //$data['getCatPosts'] = $this->MainModel->getCatPosts($cat_id);
        $data['getPopularPosts'] = $this->MainModel->getPopularPosts();
        $data['getRecentComments'] = $this->MainModel->getRecentComments();
        $data["randomPosts"] = $this->MainModel->getRandomPosts();
        $this->load->view('search', $data);
    }


    public function notFound()
    {
        $data['menus'] = $this->MainModel->getMenus();
        $data['footer'] = $this->MainModel->getFooterSettings();
        $data['setting'] = $this->MainModel->getSettings();
        $this->load->view('errors/cli/error_404', $data);
    }


    public function sitemap(){
        $posts = $this->HomeModel->getSlugs('posts');

        header("Content-type: text/xml");
        echo '<?xml version="1.0" encoding="UTF-8"?>
        <urlset xmlns="http://www.google.com/schemas/sitemap/0.84"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.google.com/schemas/sitemap/0.84 http://www.google.com/schemas/sitemap/0.84/sitemap.xsd">' . PHP_EOL;
        echo '
        <url>
        <loc>'.base_url().'</loc>
        <changefreq>hourly</changefreq>
        <priority>1.0</priority>
        </url>' . PHP_EOL; 

        foreach($posts as $book){
            echo '
            <url>
            <loc>'.base_url('kitap/') . $book->book_slug.'</loc>
            <changefreq>weekly</changefreq>
            <priority>0.5</priority>
            </url>' . PHP_EOL;
        }

        foreach($pages as $page){
            echo '
            <url>
            <loc>'.base_url('sayfa/') . $page->page_slug.'</loc>
            <changefreq>weekly</changefreq>
            <priority>0.5</priority>
            </url>' . PHP_EOL;
        }


        foreach($categories as $cat){
            echo '
            <url>
            <loc>'.base_url('kategori/') . $cat->cat_slug.'</loc>
            <changefreq>daily</changefreq>
            <priority>0.5</priority>
            </url>' . PHP_EOL;
        }
        echo '</urlset>' . PHP_EOL;

    }


} ?>