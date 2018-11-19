<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('AdminModel');
        $this->load->library('user_agent');
    }

    public function isLoggedIn()
    {
        if (!$this->session->userdata('adminInfo')) {
            redirect(base_url() . 'panel/login');
        }
    }

    public function index()
    {
        $this->isLoggedIn();
        $data = array();
        $data['getUsersCount'] = $this->AdminModel->getUsersCount();
        $data['categoryCount'] = $this->AdminModel->getCategoryCount();
        $data['getPostCount'] = $this->AdminModel->getPostCount();
        $data['adminCount'] = $this->AdminModel->adminCount();
        $this->load->view('admin/index', $data);
    }

    public function loginPage()
    {
        $data = array();
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
        $this->load->view('admin/inc/panel-login', $data);

    }


    public function login()
    {
        $cap = $this->session->userdata('captchaWord');
        $this->form_validation->set_rules('email', 'e-Posta', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Şifre', 'trim|required');
        $this->form_validation->set_rules('cap_code', 'Doğrulama Kodu', 'trim|required|alpha');
        $errors = array(
            'required' => "<script>toastr.error('{field} alanı boş bırakılamaz', 'Hata')</script>",
            'valid_email' => "<script>toastr.error('Lütfen geçerli bir e-mail adresi belirtiniz', 'Hata')</script>",
            'alpha' => "<script>toastr.error('{field} alanında yalnızca alfabetik karakterler kullanılabilir!', 'Hata')</script>"
        );
        $this->form_validation->set_message($errors);

        if ($this->form_validation->run()) {
            if ($this->input->post('cap_code') == $cap[1]) {
                $email = $this->input->post('email');
                $password = md5(sha1($this->input->post('password')));
                if ($this->AdminModel->checkAdmin($email, $password)->num_rows()) {
                    $this->session->set_userdata('adminInfo', $this->AdminModel->checkAdmin($email, $password)->result());
                    $this->index();
                } else {
                    $this->session->set_flashdata('logStatus', "<script>toastr.error('Giriş bilgileri hatalı', 'Hata')</script>");
                    redirect(base_url() . 'panel/login');
                }
            } else {
                $this->session->set_flashdata('captchaStatus', "<script>toastr.error('Doğrulama kodu hatalı', 'Hata')</script>");
                redirect(base_url() . 'panel/login');
            }
        } else {
            $this->loginPage();
        }
    }


    public function logout()
    {
        $this->isLoggedIn();
        $this->session->unset_userdata('adminInfo');
        $this->login();
    }


    public function profile()
    {
        $this->isLoggedIn();
        $data = array();
        $data['userDetail'] = $this->AdminModel->userByID($this->session->userdata('adminInfo')[0]->user_id);
        $this->load->view('admin/adminprofile', $data);
    }

    public function updateProfile()
    {
        $this->isLoggedIn();
        $this->form_validation->set_rules('user_name', 'İsim-Soyisim', 'trim|required');
        $this->form_validation->set_rules('user_password', 'Şifre', 'trim|required');
        $this->form_validation->set_rules('user_detail', 'Kullanıcı Detayı', 'trim');

        $img = $this->input->post('profile_img');
        $mail = trim($this->input->post('user_email'));
        $admin = $this->session->userdata('adminInfo')[0];
        $errors = array(
            'required' => "<script>toastr.error('{field} alanı boş bırakılamaz', 'Hata')</script>",
        );
        $this->form_validation->set_message($errors);
        if ($this->form_validation->run()) {
            $pass = md5(sha1(trim($this->input->post('user_password'))));
            $this->load->library('upload');
            if ($_FILES['profile_img']['size'] == 0) {
                $path = $admin->user_img;
            } else {
                $config['upload_path'] = 'assets/user_images/';
                $config['allowed_types'] = 'jpeg|jpg|png';
                $config['max_size'] = 4096;
                $config['file_name'] = 'kirdane-user-' . rand(15000, 25000) . rand(0, 25000);
                $config['min_width'] = 50;
                $config['min_height'] = 50;
                $this->upload->initialize($config);

                if ($this->upload->do_upload('profile_img')) {
                    $img = $this->upload->data()['file_name'];
                    $path = 'assets/user_images/' . $img;

                } else {
                    echo $this->upload->display_errors();
                }
            }

            if ($_FILES['user_cover_img']['size'] == 0) {
                $cover = $admin->user_cover_img;
            } else {
                $config['upload_path'] = 'assets/user_images/';
                $config['allowed_types'] = 'jpeg|jpg|png';
                $config['max_size'] = 4096;
                $config['file_name'] = 'user-cover-' . rand(15000, 25000) . rand(0, 25000);
                $config['min_width'] = 50;
                $config['min_height'] = 50;
                $this->upload->initialize($config);

                if ($this->upload->do_upload('user_cover_img')) {
                    $img = $this->upload->data()['file_name'];
                    $cover = 'assets/user_images/' . $img;

                } else {
                    echo $this->upload->display_errors();
                }
            }

            if ($this->AdminModel->checkAdmin($admin->user_email, $pass)) {
                if ($admin->user_email == $mail) {
                    //maili güncelleme
                    $updateData = array(
                        'user_name' => trim($this->input->post('user_name')),
                        'user_detail' => trim($this->input->post('user_detail')),
                        'user_img' => $path,
                        'user_cover_img' => $cover
                    );
                }

                if ($admin->user_email != $mail) {
                    if ($this->AdminModel->checkMail($admin->user_email)) {
                        $updateData = array(
                            'user_name' => trim($this->input->post('user_name')),
                            'user_email' => trim($this->input->post('user_email')),
                            'user_detail' => trim($this->input->post('user_detail')),
                            'user_img' => $path,
                            'user_cover_img' => $cover
                        );
                    } else {
                        $this->session->set_flashdata('swal', 'swal("Hata!", "Bir hata oluştu, KOD:785639!", "error");');
                        redirect(base_url('panel/profile'));
                    }
                }
                $this->AdminModel->updateAdmin($updateData, $admin->user_id);
                $this->session->set_flashdata('swal', 'swal("Başarılı!", "Bilgileriniz Güncellendi, değişikliklerin görüntülenmesi için tekrar oturum açın!", "success");');
                $this->session->unset_userdata('adminInfo');
                redirect(base_url('panel/login'));
            }
        } else {
            $this->session->set_flashdata('swal', 'swal("Hata!", "Bir hata oluştu! KOD: 9286", "error");');
        }


    }

    public function updateAdmin($code)
    {
        $this->isLoggedIn();
        $clrCode = $this->security->xss_clean(strip_tags(trim($code)));
        if ($clrCode == 'social') {
            $this->form_validation->set_rules('user_facebook', 'Facebook', 'trim|valid_url');
            $this->form_validation->set_rules('user_twitter', 'Twitter', 'trim|valid_url');
            $this->form_validation->set_rules('user_instagram', 'Instagram', 'trim|valid_url');
            $this->form_validation->set_rules('user_external', 'Harici', 'trim|valid_url');
            if ($this->form_validation->run()) {
                $fb = trim($this->input->post('user_facebook'));
                $tw = trim($this->input->post('user_twitter'));
                $insta = trim($this->input->post('user_instagram'));
                $ext = trim($this->input->post('user_external'));
                $updateData = array(
                    'user_facebook' => $fb,
                    'user_twitter' => $tw,
                    'user_instagram' => $insta,
                    'user_external' => $ext,
                );
                $this->AdminModel->updateAdmin($updateData, $this->session->userdata('adminInfo')[0]->user_id);
                $this->session->set_flashdata('swal', 'swal("Başarılı!", "Sosyal Medya Hesaplarınız Güncellendi!", "success");');
                redirect(base_url('panel/profile'));
            } else {
                $this->session->set_flashdata('swal', 'swal("Hata!", "Geçersiz URL Yapısı KOD: 78250!", "error");');
                redirect(base_url('panel/profile'));
            }
        }
        if ($clrCode == 'password') {
            $old_pass = $this->input->post('old_pass');
            $new_pass = md5(sha1($this->input->post('new_pass')));
            $new_pass_re = md5(sha1($this->input->post('new_pass')));
            $admin = $this->session->userdata('adminInfo')[0]->user_id;
            if($this->AdminModel->getAdminDetails($admin)[0]->user_password == md5(sha1($old_pass))){
                if($new_pass == $new_pass_re){
                    $this->AdminModel->updateAdminPass($admin, $new_pass);
                    $this->session->set_flashdata('swal', 'swal("Başarılı!", "Şifreniz Güncellendi!", "success");');
                    redirect(base_url('panel/profile'));
                }else{
                    $this->session->set_flashdata('swal', 'swal("Hata!", "Yeni şifreler eşleşmiyor!", "error");');
                    redirect(base_url('panel/profile'));
                }
            }else{
                $this->session->set_flashdata('swal', 'swal("Hata!", "Eski şifreniz hatalıdır!", "error");');
                redirect(base_url('panel/profile'));
            }
        }else{
            echo "Access Denied <br> Error Code:21";
        }
    }




    /********************************************/

    //***** Post Fonksiyonları

    /*******************************************/
    public function posts()
    {
        $this->isLoggedIn();
        $data = array();

        $this->load->library('pagination');

        $config['base_url'] = base_url('panel/posts');
        $config['total_rows'] = $this->AdminModel->getPostCount();
        $config['per_page'] = 16;
        $config['first_link'] = 'İlk';
        $config['last_link'] = 'Son';
        $config['next_link'] = 'Sonraki';
        $config['prev_link'] = 'Önceki';
        $config['cur_tag_open'] = '<li><a href=""><strong>';
        $config['cur_tag_close'] = '</strong></a><li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['posts'] = $this->AdminModel->getPosts($config['per_page'], $this->uri->segment(3, 0))->result();


        $data['postCount'] = $this->AdminModel->getPostCount();

        $this->load->view('admin/posts', $data);
    }

    //post olluşturma sayfası
    public function newPost()
    {
        $this->isLoggedIn();
        $data = array();
        $data['categories'] = $this->AdminModel->getAllCategories()->result();
        $this->load->view('admin/createPost', $data);
    }

    //oluştur
    public function createPost()
    {
        $this->isLoggedIn();
        $data = array();
        $this->form_validation->set_rules('post_title', 'Başlık', 'trim|required');
        $this->form_validation->set_rules('post_tags', 'Etiket', 'trim');
        $this->form_validation->set_rules('post_text', 'Yazı', 'trim|required');
        $this->form_validation->set_rules('post_category', 'Kategori', 'trim|required');
        $this->form_validation->set_rules('isDraft', 'Durum', 'trim|required');
        $slug = seo($this->input->post('post_title'));
        if ($this->AdminModel->checkSlugName($slug)) {
            $this->session->set_flashdata('swal', 'swal("Hata!", "Yazı oluşturulamadı, böyle bir yazı zaten var!", "warning");');
            redirect(base_url() . 'panel/posts');
        } else {
            $errors = array(
                'required' => "<script>toastr.error('{field} alanı boş bırakılamaz', 'Hata');</script>"
            );
            $this->form_validation->set_message($errors);
            if ($this->form_validation->run()) {
                $cat_id = $this->AdminModel->getCategoryIDbyName($this->input->post('post_category'))[0]->cat_id;
                if ($this->input->post('isDraft') == "Taslak") {
                    $statusCode = 1;
                }
                if ($this->input->post('isDraft') == "Yayınla") {
                    $statusCode = 0;
                }
                $config['upload_path'] = 'assets/postimages/';
                $config['allowed_types'] = 'jpeg|jpg|png';
                $config['max_size'] = 2048;
                $config['file_name'] = 'kirdane-post-' . rand(15080, 25000) . rand(25000, 32687);
                $config['min_width'] = 50;
                $config['min_height'] = 50;
                $this->load->library('upload');
                $this->upload->initialize($config);

                if ($this->upload->do_upload('post_img')) {
                    $img = $this->upload->data()['file_name'];
                    $path = 'assets/postimages/' . $img;
                } else {
                    echo $this->upload->display_errors();
                }
                $postDetail = array(
                    'post_title' => $this->input->post('post_title'),
                    'post_tags' => $this->input->post('post_tags'),
                    'post_text' => $this->input->post('post_text'),
                    'post_category' => $cat_id,
                    'post_slug' => seo($this->input->post('post_title')),
                    'post_img' => $path,
                    'isDraft' => $statusCode,
                    'post_author' => $this->session->userdata('adminInfo')[0]->user_id
                );
                $this->AdminModel->createPost($postDetail);
                $this->session->set_flashdata('success', "<script>toastr.success('Yazınız oluşturuldu', 'Başarılı');</script>");
                redirect(base_url('panel/posts'));
            } else {
                $this->load->view('admin/createPost');
            }
        }

    }

    public function editPost()
    {
        $this->isLoggedIn();
        $data = array();
        $post_id = trim(strip_tags(stripslashes($this->uri->segment(4))));
        $data['post'] = $this->AdminModel->getPostByID($post_id);
        $data['categories'] = $this->AdminModel->getCategories();

        $this->load->view('admin/editPost', $data);
    }

    public function updatePost()
    {
        $this->isLoggedIn();
        if ($this->input->post('isDraft') == "Taslak") {
            $statusCode = 1;
        }
        if ($this->input->post('isDraft') == "Yayınla") {
            $statusCode = 0;
        }
        if ($_FILES['post_img']['size'] == 0) {
            $id = $this->input->post('post_id');
            $path = $this->AdminModel->getPostByID($id)[0]->post_img;
        } else {
            $config['upload_path'] = 'assets/postimages/';
            $config['allowed_types'] = 'jpeg|jpg|png';
            $config['max_size'] = 2048;
            $config['file_name'] = 'kirdane-post-' . rand(15000, 25000) . rand(0, 25000);
            $config['min_width'] = 50;
            $config['min_height'] = 50;
            $this->load->library('upload');
            $this->upload->initialize($config);

            if ($this->upload->do_upload('post_img')) {
                $img = $this->upload->data()['file_name'];
                $path = 'assets/postimages/' . $img;
            } else {
                echo $this->upload->display_errors();
            }
        }

        $cat_id = $this->AdminModel->getCategoryIDbyName($this->input->post('post_category'))[0]->cat_id;
        $this->form_validation->set_rules('post_title', 'Başlık', 'trim|required');
        $this->form_validation->set_rules('post_tags', 'Etiket', 'trim');
        $this->form_validation->set_rules('post_text', 'Yazı', 'trim|required');
        $this->form_validation->set_rules('post_category', 'Kategori', 'trim|required');
        $this->form_validation->set_rules('isDraft', 'Durum', 'trim|required');
        $errors = array(
            'required' => "<script>toastr.error('{field} alanı boş bırakılamaz', 'Hata');</script>"
        );
        $this->form_validation->set_message($errors);

        if ($this->form_validation->run()) {

            $postData = array(
                'post_title' => $this->input->post('post_title'),
                'post_tags' => $this->input->post('post_tags'),
                'post_text' => $this->input->post('post_text'),
                'post_category' => $cat_id,
                'post_slug' => seo($this->input->post('post_title')),
                'post_img' => $path,
                'isDraft' => $statusCode
            );
            $id = $this->input->post('post_id');
            $this->AdminModel->updatePost($id, $postData);
            redirect(base_url() . 'panel/posts');
        }
    }


    public function deletePost()
    {
        $this->isLoggedIn();
        $data = array();
        $this->form_validation->set_rules('post_id', 'Yazı ID', 'trim|required');
        if ($this->form_validation->run()) {
            $post_id = $this->input->post('post_id');
            $filename = $this->AdminModel->getPostByID($post_id)[0]->post_img;
            unlink($filename);
            $this->AdminModel->deletePost($post_id);
            $this->session->set_flashdata('status', "<script>toastr.success('Yazınız Silindi', 'Başarılı');</script>");
            redirect(base_url() . 'panel/posts');
        } else {
            $this->session->set_flashdata('status', "<script>toastr.error('Yazı ID Alanı Boş Bırakılamaz', 'Hata');</script>");
            redirect(base_url() . 'panel/posts');
        }

    }


    /********************************************/

    //***** Kategori Fonksiyonları

    /*******************************************/

    public function categories()
    {
        $this->isLoggedIn();
        $data = array();

        $this->load->library('pagination');

        $config['base_url'] = base_url('panel/categories');
        $config['total_rows'] = $this->AdminModel->getCategoryCount();
        $config['per_page'] = 16;
        $config['first_link'] = 'İlk';
        $config['last_link'] = 'Son';
        $config['next_link'] = 'Sonraki';
        $config['prev_link'] = 'Önceki';
        $config['cur_tag_open'] = '<li><a href=""><strong>';
        $config['cur_tag_close'] = '</strong></a><li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['categories'] = $this->AdminModel->getCategories($config['per_page'], $this->uri->segment(3, 0));

        //$data['categories'] = $this->AdminModel->getCategories();
        $data['categoryCount'] = $this->AdminModel->getCategoryCount();
        $this->load->view('admin/categories', $data);
    }

    public function createCategory()
    {
        $this->isLoggedIn();
        $data = array();
        $data['categories'] = $this->AdminModel->getCategories();
        $data['categoryCount'] = $this->AdminModel->getCategoryCount();
        $this->form_validation->set_rules('cat_name', 'Kategori Adı', 'trim|is_unique[categories.cat_name]|required');
        $errors = array(
            'is_unique' => '<script>swal("Hata!", "Böyle bir kategori zaten var!", "error");</script>',
            'required' => '<script>swal("Hata!", "{field} alanı boş bırakılamaz", "warning");</script>'
        );
        $this->form_validation->set_message($errors);
        if ($this->form_validation->run()) {
            $this->AdminModel->createCategory($this->input->post('cat_name'));
            $this->session->set_flashdata('swal', 'swal("Başarılı!", "Kategori Oluşturuldu!", "success");');
            redirect(base_url('panel/categories'));
        } else {
            $this->load->view('admin/categories', $data);
        }
    }


    public function deleteCategory()
    {
        $this->isLoggedIn();
        $data = array();
        $data['categories'] = $this->AdminModel->getCategories();
        $data['categoryCount'] = $this->AdminModel->getCategoryCount();

        $this->form_validation->set_rules('cat_id', 'Kategori ID', 'trim|required|numeric');
        $errors = array(
            'numeric' => "<script>toastr.error('Yalnızca numerik karakterler kullanılabilir.', 'Hata');</script>",
            'required' => "<script>toastr.error('{field} alanı boş bırakılamaz', 'Hata');</script>"
        );
        $this->form_validation->set_message($errors);

        if ($this->form_validation->run()) {
            $this->AdminModel->deleteCategory($this->input->post('cat_id'));
            redirect(base_url('panel/categories'));
        } else {
            $this->load->view('admin/categories', $data);
        }
    }

    public function editCategory()
    {
        $this->isLoggedIn();
        $data = array();
        $cat_id = trim(strip_tags(stripslashes($this->uri->segment(4))));
        $data['cat'] = $this->AdminModel->getCategoryByID($cat_id);
        $this->load->view('admin/editCategory', $data);
    }

    public function updateCategory()
    {
        $data['categories'] = $this->AdminModel->getCategories();
        $data['categoryCount'] = $this->AdminModel->getCategoryCount();
        $this->form_validation->set_rules('cat_name', 'Kategori Adı', 'trim|is_unique[categories.cat_name]|required');
        $errors = array(
            'is_unique' => "<script>toastr.error('Böyle bir kategori zaten var.', 'Hata');</script>",
            'required' => "<script>toastr.error('{field} alanı boş bırakılamaz', 'Hata');</script>"
        );
        $this->form_validation->set_message($errors);

        if ($this->form_validation->run()) {
            $this->AdminModel->updateCategory($this->input->post('cat_id'), $this->input->post('cat_name'));
            $this->session->set_flashdata('success', "<script>toastr.success('Güncelleme Başarılı', 'Başarılı!');</script>");
            redirect(base_url('panel/categories'));
        } else {
            $this->load->view('admin/categories', $data);
        }

    }





    /********************************************/

    //***** Yorum Fonksiyonları

    /*******************************************/

    public function waitingComments()
    {
        $this->isLoggedIn();
        $data = array();
        $data['comments'] = $this->AdminModel->getComments(0);
        $this->load->view('admin/comments', $data);
    }

    public function approvedComments()
    {
        $this->isLoggedIn();
        $data = array();
        $data['comments'] = $this->AdminModel->getComments(1);
        $this->load->view('admin/comments', $data);
    }

    public function approveComment()
    {
        $this->isLoggedIn();
        $comment_id = $this->security->xss_clean($this->uri->segment(3));
        $this->AdminModel->approveComment($comment_id);
        redirect($this->agent->referrer());
    }

    public function deleteComment()
    {
        $this->isLoggedIn();
        $comment_id = $this->security->xss_clean(trim($this->uri->segment(3)));
        $this->AdminModel->deleteComment($comment_id);
        redirect($this->agent->referrer());
    }





    /********************************************/

    //***** ayar Fonksiyonları
    // ayarlar
    /*******************************************/

    public function settings()
    {
        $this->isLoggedIn();
        $data = array();
        $data['setting'] = $this->AdminModel->getSettings();
        $this->load->view('admin/settings', $data);
    }

    public function updateSettings()
    {
        $this->isLoggedIn();
        $this->form_validation->set_rules('set_title_suffix', 'Suffix', 'trim');
        $this->form_validation->set_rules('set_description', 'Site Açıklaması', 'trim');
        $this->form_validation->set_rules('set_keywords', 'Anahtar Kelimeler', 'trim');
        $this->form_validation->set_rules('set_analytics', 'Analytics Kodu', 'trim');
        $this->form_validation->set_rules('set_homepage_title', 'Anasayfa Başlığı', 'trim');
        $this->form_validation->set_rules('set_category_title', 'Kategori Başlığı', 'trim');
        $this->form_validation->set_rules('set_search_title', 'Arama Başlığı', 'trim');
        $this->form_validation->set_rules('set_404_title', '404 Sayfa Başlığı', 'trim');
        $this->form_validation->set_rules('set_404_subtitle', '404 Alt Başlığı', 'trim');
        $this->form_validation->set_rules('set_404_text', '404 Detay Bilgisi', 'trim');

        if ($this->form_validation->run()) {
            $set = array(
                'set_title_suffix' => $this->input->post('set_title_suffix'),
                'set_description' => $this->input->post('set_description'),
                'set_keywords' => $this->input->post('set_keywords'),
                'set_analytics' => $this->input->post('set_analytics'),
                'set_homepage_title' => $this->input->post('set_homepage_title'),
                'set_category_title' => $this->input->post('set_category_title'),
                'set_search_title' => $this->input->post('set_search_title'),
                'set_404_title' => $this->input->post('set_404_title'),
                'set_404_subtitle' => $this->input->post('set_404_subtitle'),
                'set_404_text' => $this->input->post('set_404_text')
            );
            $this->AdminModel->updateSettings(0, $set);
            $this->session->set_flashdata('swal', 'swal("Başarılı!", "Ayarlar Güncellendi!", "success");');
            redirect(base_url() . 'panel/settings');
        } else {
            redirect(base_url() . 'panel/settings');
        }


    }

    public function footersettings()
    {
        $this->isLoggedIn();
        $data = array(
            'footer' => $this->AdminModel->getFooterSettings()
        );
        $this->load->view('admin/inc/footerSettings', $data);
    }

    public function footerUpdate()
    {
        $this->isLoggedIn();
        $about_us_title = trim($this->input->post('about_us_title'));
        $about_us_text = trim($this->input->post('about_us_text'));

        $recent_posts_title = trim($this->input->post('recent_posts_title'));
        $recent_posts_count = trim($this->input->post('recent_posts_count'));

        $social_title = trim($this->input->post('social_title'));
        $social_facebook = trim($this->input->post('social_facebook'));
        $social_twitter = trim($this->input->post('social_twitter'));
        $social_instagram = trim($this->input->post('social_instagram'));
        $social_pinterest = trim($this->input->post('social_pinterest'));

        $copyright = trim($this->input->post('copyright'));

        $updateData = array(
            'about_us_title' => $about_us_title,
            'about_us_text' => $about_us_text,
            'recent_posts_title' => $recent_posts_title,
            'recent_posts_count' => $recent_posts_count,
            'social_title' => $social_title,
            'social_facebook' => $social_facebook,
            'social_twitter' => $social_twitter,
            'social_instagram' => $social_instagram,
            'social_pinterest' => $social_pinterest,
            'copyright' => $copyright
        );
        $this->AdminModel->updateFooterSettings($this->security->xss_clean($updateData));
        $this->session->set_flashdata('swal', 'swal("Başarılı!", "Footer Ayarları Güncellendi!", "success");');
        redirect(base_url('panel/settings/footer'));
    }

    public function homepageSettings()
    {
        $this->isLoggedIn();
        $data = array();
        $data['setting'] = $this->AdminModel->getSettings();
        $data['categories'] = $this->AdminModel->getCategories();
        $this->load->view('admin/inc/homepageSettings', $data);
    }

    public function homePageUpdate()
    {
        $this->isLoggedIn();
        $typeStr = $this->security->xss_clean($this->input->post('slide_type'));
        $postCount = $this->input->post('postCount');
        $catName = NULL;
        if ($typeStr == "Son Yazılar") {
            $typeNum = 0;
        } elseif ($typeStr == "Kategori") {
            $typeNum = 1;
            $catName = $this->input->post('select_cat');
        }

        $updateData = array(
            'top_slider_type' => $typeNum,
            'top_slider_category' => $this->AdminModel->getCategoryByID($catName)[0]->cat_id,
            'top_slider_post_count' => $postCount
        );
        $this->AdminModel->updateSettings(0, $updateData);
        $this->session->set_flashdata('swal', 'swal("Başarılı!", "Ayarlar Güncellendi!", "success");');
        redirect(base_url('panel/settings/homepage'));
    }

    public function hpCatUpdate()
    {
        $this->isLoggedIn();
        $cat_id = $this->AdminModel->getCategoryByID($this->input->post('cat_id'))[0]->cat_id;
        $postcount = $this->input->post('post_count');
        $updateData = array(
            'cat_section_category' => $cat_id,
            'cat_section_post_count' => $postcount
        );
        $this->AdminModel->updateSettings(0, $updateData);
        $this->session->set_flashdata('swal', 'swal("Başarılı!", "Ayarlar Güncellendi!", "success");');
        redirect(base_url('panel/settings/homepage'));
    }

    public function bottomSliderUpdate()
    {
        $this->isLoggedIn();
        $postCount = $this->input->post('postCount');
        $catId = $this->input->post('select_cat');

        $updateData = array(
            'bottom_slider_category' => $catId,
            'bottom_slider_post_count' => $postCount
        );
        $this->AdminModel->updateSettings(0, $updateData);
        $this->session->set_flashdata('swal', 'swal("Başarılı!", "Ayarlar Güncellendi!", "success");');
        redirect(base_url('panel/settings/homepage'));
    }

    public function hpRecentUpdate()
    {
        $this->isLoggedIn();
        $postCount = trim($this->input->post('post_count'));
        $postTitle = trim($this->input->post('recent_posts_title'));

        $updateData = array(
            'recent_posts_count' => $postCount,
            'recent_posts_title' => $postTitle
        );
        $this->AdminModel->updateSettings(0, $updateData);
        $this->session->set_flashdata('swal', 'swal("Başarılı!", "Ayarlar Güncellendi!", "success");');
        redirect(base_url('panel/settings/homepage'));
    }



    /*
    top_slider_type
    top_slider_category
    top_slider_post_count
    */

    //*
    //*
    //*
    //*   //SAYFALAR
    //*
    //*
    //*//

    public function listPages()
    {
        $data = array();
        $data['pages'] = $this->AdminModel->listPages();
        $this->load->view('admin/pages', $data);
    }

    public function newPage()
    {
        $this->isLoggedIn();
        $this->load->view('admin/newPage');
    }

    public function createPage()
    {
        $this->isLoggedIn();
        $page_title = $this->security->xss_clean(trim($this->input->post('page_title')));
        $page_text = $this->security->xss_clean(trim($this->input->post('page_text')));
        $page_slogan = $this->security->xss_clean(trim($this->input->post('page_slogan')));
        $slug = seo($page_title);

        //aynı adda sayfa olmasını engelle
        $pageData = array(
            'page_title' => $page_title,
            'page_text' => $page_text,
            'page_slogan' => $page_slogan,
            'page_slug' => $slug
        );
        $this->AdminModel->insertPage($pageData);
        redirect(base_url() . 'panel/pages');
    }

    public function editPage()
    {
        $this->isLoggedIn();
        $data = array();
        $page_id = $this->security->xss_clean($this->uri->segment(4));
        $data['page'] = $this->AdminModel->getPageDetails($page_id);
        $this->load->view('admin/editPage', $data);
    }


    public function updatePage()
    {
        $this->isLoggedIn();
        $id = $this->security->xss_clean($this->input->post('page_id'));
        $data = array(
            'page_title' => $this->security->xss_clean($this->input->post('page_title')),
            'page_text' => $this->security->xss_clean($this->input->post('page_text')),
            'page_slogan' => $this->security->xss_clean($this->input->post('page_slogan')),
            'page_slug' => seo($this->security->xss_clean($this->input->post('page_title')))
        );
        $this->AdminModel->updatePage($data, $id);
        $this->listPages();
    }

    public function deletePage()
    {
        $this->isLoggedIn();
        $page_id = $this->security->xss_clean($this->input->post('page_id'));
        $this->AdminModel->deletePage($page_id);
        $this->listPages();
    }
    //*
    //*
    //*
    //*   //menüler
    //*
    //*
    //*//

    public function menus()
    {
        $this->isLoggedIn();
        $data = array();

        $data['submenus'] = $this->AdminModel->getSubMenus();
        $data['menus'] = $this->AdminModel->listMenus();
        $this->load->view('admin/inc/menus', $data);
    }


    public function createMenu()
    {
        $this->isLoggedIn();
        $data = array();
        $data['categories'] = $this->AdminModel->getAllCategories()->result();
        $data['pages'] = $this->AdminModel->listPages()->result();

        $this->load->view('admin/inc/createMenu', $data);
    }

    public function insertMenu()
    {
        $this->isLoggedIn();
        $title = $this->input->post("menu_baslik");
        $order = $this->input->post("menu_sira");
        $type = $this->input->post("menuTuru");

        $pages = $this->input->post("sayfalar");
        $categories = $this->input->post("kategoriler");
        $redirectLink = $this->input->post("linkyonlendirme");

        /*
         * Menu türü
         * 0 sayfa yönlendirme
         * 1 link yönlendirme
         * 2 mega menü
         * 3 açılır menü
         * */

        if ($type == "Sayfa Yönlendirme") {
            $typeNum = 0;
            $isMega = 0;
            $cat = null;
            $slug = seo($pages);
            $link = base_url('page/' . $slug);
        } elseif ($type == "Mega Menü") {
            $typeNum = 2;
            $isMega = 1;
            $slug = seo($categories);
            $catDetails = $this->AdminModel->catDetailsBySlug($slug);
            $link = base_url("category/" . $catDetails[0]->cat_slug . "/" . $catDetails[0]->cat_id);
            $cat = $catDetails[0]->cat_id;
        } elseif ($type == "Link Yönlendirme") {
            $typeNum = 1;
            $cat = null;
            $isMega = 0;
            $link = trim($redirectLink);
        } elseif ($type == "Açılır Menü") {
            $typeNum = 3;
            $cat = null;
            $isMega = 0;
            $link = null;
        }

        $insertData = array(
            'menu_title' => strip_tags(trim($title)),
            'menu_type' => $typeNum,
            'menu_link' => $link,
            'menu_order' => $order,
            'menu_category' => $cat,
            'isMega' => $isMega
        );
        $this->AdminModel->insertMenu($insertData);
        $this->session->set_flashdata('swal', 'swal("Başarılı!", "Menü Oluşturuldu!", "success");');
        redirect(base_url('panel/menus'));
    }


    public function deleteMenu($id)
    {
        $this->isLoggedIn();
        $id = $this->security->xss_clean(trim($id));
        $this->AdminModel->deleteMenu($id);
        $this->session->set_flashdata('swal', 'swal("Başarılı!", "Menü Silindi!", "success");');
        redirect(base_url('panel/menus'));
    }

    public function createSubMenu()
    {
        $this->isLoggedIn();
        $data = array();
        $data['categories'] = $this->AdminModel->getAllCategories()->result();
        $data['pages'] = $this->AdminModel->listPages()->result();

        $this->load->view('admin/inc/createSubMenu', $data);
    }

    public function subMenu()
    {
        $this->isLoggedIn();
        $title = trim($this->input->post("menu_baslik"));
        $order = trim($this->input->post("menu_sira"));
        $type = trim($this->input->post("menuTuru"));
        $topLevel = trim($this->input->post('topLevel'));

        $pages = $this->input->post("sayfalar");
        $redirectLink = $this->input->post("linkyonlendirme");
        if ($type == "Sayfa Yönlendirme") {
            $typeNum = 0;
            $isMega = 0;
            $cat = null;
            $slug = seo($pages);
            $link = base_url('page/' . $slug);
        } elseif ($type == "Link Yönlendirme") {
            $typeNum = 1;
            $cat = null;
            $isMega = 0;
            $link = trim($redirectLink);
        }
        $insertData = array(
            'menu_title' => strip_tags(trim($title)),
            'menu_type' => $typeNum,
            'menu_link' => $link,
            'menu_order' => $order,
            'menu_category' => $cat,
            'topLevel' => $topLevel,
            'isMega' => $isMega
        );
        $this->AdminModel->insertMenu($insertData);

        $this->session->set_flashdata('swal', 'swal("Başarılı!", "Alt menü eklendi!", "success");');
        redirect(base_url('panel/menus'));
    }

    public function editMenu($id)
    {
        $this->isLoggedIn();
        $data = array();
        $editData = $this->AdminModel->getMenu($id);
        if (!empty($editData) || !is_null($editData)) {
            $data['edit'] = $this->AdminModel->getMenu($id);
        } else {
            $this->session->set_flashdata('swal', 'swal("Hata!", "Böyle bir menü yok, hata tekrar ederse tekrar oturum açmayı deneyin!", "warning");');
            redirect(base_url() . 'panel/menus');
        }
        $this->load->view('admin/inc/editMenu', $data);
    }

    public function updateMenu()
    {
        $this->isLoggedIn();
        $updateData = array(
            'menu_title' => $this->input->post('menu_title'),
            'menu_order' => $this->input->post('menu_order')
        );
        $this->AdminModel->updateMenu($updateData, $this->input->post('menu_id'));
        $this->session->set_flashdata('swal', 'swal("Başarılı!", "Menü Güncellendi!", "success");');
        redirect(base_url() . 'panel/menus');
    }


    //galleries
    public function galleries()
    {
        $this->isLoggedIn();
        $data["gallery"] = $this->AdminModel->getGalleries();
        $this->load->view('admin/galleries', $data);
    }


    public function usersPage()
    {
        $this->isLoggedIn();
        $data["userDetail"] = $this->AdminModel->getUsers();
        $this->load->view('admin/users', $data);
    }


    public function userUpGrade($user_id)
    {
        $this->isLoggedIn();
        $user_id = strip_tags($this->security->xss_clean($user_id));
        if (!$this->AdminModel->getConfirmationStatus($user_id)) {
            //yetkisi yok güncelleme
            $this->session->set_flashdata('swal', 'swal("Hata!", "Üye zaten geçerli yetkiye sahip, değişiklik yapılmadı. KOD: 9792", "error");');
            redirect(base_url() . 'panel/users');
        } else {
            //yetkisi yok, yetki ver
            $this->AdminModel->upGradeUser($user_id);
            $this->session->set_flashdata('swal', 'swal("Başarılı!", "Üyeye Onaysız Yazı Yayınlama Yetkisi Verildi!", "success");');
            redirect(base_url() . 'panel/users');
        }

    }

    public function userDownGrade($user_id)
    {
        $this->isLoggedIn();
        $user_id = strip_tags($this->security->xss_clean($user_id));
        if (!$this->AdminModel->getConfirmationStatus($user_id)) {
            //yetkisi yok güncelle
            $this->AdminModel->downGradeUser($user_id);
            $this->session->set_flashdata('swal', 'swal("Başarılı!", "Üyenin Onaysız Yazı Yayınlama Yetkisi Kaldırıldı!", "success");');
            redirect(base_url() . 'panel/users');
        } else {
            //yetkisi yok, güncelleme
            $this->session->set_flashdata('swal', 'swal("Hata!", "Üye zaten geçerli yetkiye sahip, değişiklik yapılmadı. KOD: 9793", "error");');
            redirect(base_url() . 'panel/users');
        }
    }

    public function deleteUser($user_id){
        $this->isLoggedIn();
        $user_id = strip_tags($this->security->xss_clean($user_id));

        if($this->AdminModel->isUserExists($user_id)){
            $this->session->set_flashdata('swal', 'swal("Hata!", "Böyle bir kullanıcı yok!", "error");');
            redirect(base_url() . 'panel/users');

        }else{
            $this->AdminModel->deleteUser($user_id);
            $this->session->set_flashdata('swal', 'swal("Başarılı!", "Üyelik sonlandırıldı!", "success");');
            redirect(base_url() . 'panel/users');
        }

    }



    public function adminsPage(){
        $this->isLoggedIn();
        $data['adminDetails'] = $this->AdminModel->getAdmins()->result();
        $data['adminCount'] = $this->AdminModel->getAdmins()->num_rows();
        $this->load->view('admin/admins', $data);
    }

    public function addAdmin(){
        $this->isLoggedIn();
        $this->form_validation->set_rules('email', 'E-Mail', 'trim|valid_email|is_unique[users.user_email]|required');
        $this->form_validation->set_rules('pass', 'Şifre', 'trim|required|matches[re_pass]');
        $this->form_validation->set_rules('re_pass', 'Şifre Tekrarı', 'trim|required');
        $this->form_validation->set_rules('name', 'İsim', 'trim|required');
        $errors = array(
            'valid_email' => 'swal("Başarılı!", "Üyelik sonlandırıldı!", "error");',
            'required' => 'swal("Uyarı!", "{field} Alanı zorunludur!", "warning");',
            'is_unique' => 'swal("Uyarı!", "Bu eposta adresi zaten kayıtlıdır, bu adres bir üyeye ait ise üyeliğini sonlandırıp tekrar deneyin", "warning");',
            'matches' => 'swal("Uyarı!", "Şifre alanları eşleşmiyor!", "warning");'
        );
        $this->form_validation->set_message($errors);

        if($this->form_validation->run()){
            $insertData = array(
                'user_name' => strip_tags($this->input->post('name')),
                'user_email' => $this->input->post('email'),
                'user_password' => md5(sha1($this->input->post('pass'))),
                'user_permission' => 121
            );
            $this->AdminModel->createAdmin($insertData);
            $this->session->set_flashdata('swal', 'swal("Başarılı!", "Yönetici Eklendi!", "success");');
            redirect(base_url('panel/admins'));
        }else{
            $data['adminDetails'] = $this->AdminModel->getAdmins()->result();
            $data['adminCount'] = $this->AdminModel->getAdmins()->num_rows();
            $this->load->view('admin/admins', $data);
        }

    }

    public function deleteAdmin($admin_id){
        $this->isLoggedIn();
        if($this->session->userdata('adminInfo') && $this->session->userdata('adminInfo')[0]->user_id == 19){
            $admin_id = trim(strip_tags(html_escape($admin_id)));
            $this->AdminModel->deleteAdmin($admin_id);
            $this->session->set_flashdata('swal', 'swal("Başarılı!", "Yönetici Silindi!", "success");');
            redirect(base_url('panel/admins'));
        }else{
            echo "Access Denied";
        }
    }

    public function sidebarVideos(){
        $this->isLoggedIn();
        $data['videos'] = $this->AdminModel->getVideos();
        $this->load->view('admin/videos', $data);
    }

    public function insertVideo(){
        $this->isLoggedIn();
        $video_title = strip_tags(trim($this->input->post('video_title')));
        $video_yt_id  = strip_tags(trim($this->input->post('video_yt_id')));
        $insertData = array(
            'video_yt_id' => $video_yt_id,
            'video_title' => $video_title
        );
        $this->AdminModel->insertVideo($insertData);
        $this->session->set_flashdata('swal', 'swal("Başarılı!", "Video Eklendi!", "success");');
        redirect(base_url('panel/sidebar/videos'));
    }

    public function deleteVideo($video_id){
        $this->isLoggedIn();
        $video_id = html_escape(trim(strip_tags($video_id)));
        $this->AdminModel->deleteVideo($video_id);
        $this->session->set_flashdata('swal', 'swal("Başarılı!", "Video Silindi!", "success");');
        redirect(base_url('panel/sidebar/videos'));
    }


}

?>