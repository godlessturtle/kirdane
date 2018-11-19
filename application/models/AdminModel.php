<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminModel extends CI_Model
{


    public function checkAdmin($email, $password)
    {
        $query = $this->db->get_where('users', array('user_email' => $email, 'user_password' => $password, 'user_permission' => 121));
        return $query;
    }

    public function updateAdmin($data, $id)
    {
        $this->db->where(array('user_id' => $id, 'user_permission' => 121));
        $this->db->update('users', $data);
    }

    public function checkMail($mail){
        $query = $this->db->get_where('users', array('user_email' => $mail, 'user_permission' => 121));
        return $query->result();
    }

    public function getUsersCount()
    {
        return $this->db->get_where('users', array('user_permission' => 1))->num_rows();
    }

    function adminCount()
    {
        $query = $this->db->get_where('users', array('user_permission' => 121));
        return $query->num_rows();
    }

    public function userByID($id){
        $query = $this->db->get_where('users', array('user_permission' => 121, 'user_id' => $id));
        return $query->result();
    }


    //post fonksiyonları
    public function getPosts($limit, $segment)
    {
        $query = $this->db->order_by('post_id', 'DESC')->limit($limit, $segment)->get_where('posts');
        return $query;
    }


    public function getPostCount()
    {
        $query = $this->db->query('SELECT * FROM posts');
        return $query->num_rows();
    }

    //yeni yazı
    public function createPost($data)
    {
        $this->db->insert('posts', $data);
    }


    public function getPostByID($post_id)
    {
        $query = $this->db->query('SELECT * FROM posts WHERE post_id="' . $post_id . '"');
        return $query->result();
    }


    public function updatePost($id, $postData)
    {
        $this->db->where('post_id', $id);
        $this->db->update('posts', $postData);
    }

    public function deletePost($post_id)
    {
        $this->db->delete('posts', array('post_id' => $post_id));
    }


    //category fonksiyonları
    public function getAllCategories()
    {
        $query = $this->db->get("categories");
        return $query;
    }

    public function getCategories($limit=16, $segment=0)
    {
        $query = $this->db->order_by('cat_name', 'ASC')->limit($limit, $segment)->get('categories');
        return $query->result();
    }

    public function getCategoryCount()
    {
        $query = $this->db->get('categories');
        return $query->num_rows();
    }

    public function createCategory($cat_name)
    {
        $this->db->insert('categories', array('cat_name' => $cat_name, 'cat_slug' => seo($cat_name)));
    }

    public function deleteCategory($cat_id)
    {
        $this->db->delete('categories', array('cat_id' => $cat_id));
        $this->db->delete('posts', array('post_category' => $cat_id));
    }

    public function updateCategory($cat_id, $cat_name)
    {
        $this->db->where('cat_id', $cat_id)->update('categories', array('cat_name' => $cat_name, 'cat_slug' => seo($cat_name)));

    }

    public function getCategoryByID($id)
    {
        $query = $this->db->query('SELECT * FROM categories WHERE cat_id="' . $id . '"');
        return $query->result();
    }

    public function getCategoryIDbyName($cat_name)
    {
        $query = $this->db->query('SELECT cat_id FROM categories WHERE cat_name="' . $cat_name . '"');
        return $query->result();
    }

    public function catDetailsBySlug($slug)
    {
        $query = $this->db->get_where('categories', array('cat_slug' => $slug));
        return $query->result();
    }


    //ayar fonksiyonları
    public function getSettings($set_id = 0)
    {
        $query = $this->db->query('SELECT * FROM settings WHERE set_id="' . $set_id . '"');
        return $query->result();
    }

    public function updateSettings($id = 0, $data)
    {
        $this->db->where('set_id', $id);
        $this->db->update('settings', $data);
    }

    public function getFooterSettings()
    {
        $query = $this->db->get_where('footer', array('tab_id' => 0));
        return $query->result();
    }

    public function updateFooterSettings($data)
    {
        $this->db->where('tab_id', 0);
        $this->db->update('footer', $data);
    }


    //comments
    public function getComments($bin)
    {
        $query = $this->db->order_by('comment_id', 'DESC')->get_where('comments', array('isApproved' => $bin));
        return $query;
    }


    public function approveComment($id)
    {
        $this->db->where('comment_id', $id)->update('comments', array('isApproved' => 1));
    }

    public function deleteComment($id)
    {
        $this->db->delete('comments', array('comment_id' => $id));
    }


    //sayfalar pages
    public function insertPage($pageData)
    {
        $this->db->insert('pages', $pageData);
    }

    public function listPages()
    {
        $query = $this->db->get('pages');
        return $query;
    }

    public function getPageDetails($page_id)
    {
        $query = $this->db->get_where('pages', array('page_id' => $page_id));
        return $query->result();
    }

    public function updatePage($data, $id)
    {
        $this->db->where('page_id', $id);
        $this->db->update('pages', $data);
    }

    public function deletePage($id)
    {
        $this->db->delete('pages', array('page_id' => $id));
    }

    public function detailBySlug($slug)
    {
        $query = $this->db->get_where('pages', array('page_slug' => $slug));
        return $query->result();
    }


    //menü fonksiyonları
    public function listMenus()
    {
        $query = $this->db->order_by('menu_order', 'ASC')->get_where('menus', array('topLevel' => 0));
        return $query->result();
    }

    public function deleteMenu($id)
    {
        $this->db->delete('menus', array('menu_id' => $id));
        $this->db->delete('menus', array('topLevel' => $id));
    }

    public function insertMenu($data)
    {
        $this->db->insert('menus', $data);
    }

    public function getSubMenus()
    {
        $query = $this->db->order_by('topLevel', 'ASC')->get_where('menus', array('topLevel' != 0));
        return $query->result();
    }

    public function getMenu($id)
    {
        $query = $this->db->get_where('menus', array('menu_id' => $id));
        return $query->result();
    }

    public function updateMenu($data, $id)
    {
        $this->db->where('menu_id', $id);
        $this->db->update('menus', $data);
    }


    //güvenlik
    public function checkSlugName($slug)
    {
        $query = $this->db->query('SELECT * FROM posts WHERE post_slug LIKE "%' . $slug . '%"');
        return $query->num_rows();
    }

    public function getGalleries(){
        $query = $this->db->get('gallery');
        return $query;
    }


    function getUsers()
    {
        $query = $this->db->get_where('users', array('user_permission' => 1));
        return $query;
    }

    function getConfirmationStatus($user_id){
        $query = $this->db->get_where('users', array('user_id' => $user_id));
        return $query->result()[0]->needConfirmation;
    }

    function downGradeUser($user_id){
       $this->db->where('user_id', $user_id);
       $this->db->update('users', array('needConfirmation' => 1));
    }

    function upGradeUser($user_id){
        $this->db->where('user_id', $user_id);
        $this->db->update('users', array('needConfirmation' => 0));
    }

    function deleteUser($user_id){
        $user = $this->db->get_where('users', array('user_id' => $user_id))->result();
        $usermail = $user[0]->user_email;
        $this->db->delete('comments', array('commenter_email' => $usermail));
        $this->db->delete('posts', array('post_author' => $user_id));
        $this->db->delete('users', array('user_id' => $user_id));
    }

    function isUserExists($user_id){
        $query = $this->db->get_where('users', array('user_id', $user_id, 'user_permission' => 1));
        return $query->result();
    }



    function searchUsers($search_term){

    }






    /* admins page */
    function getAdmins(){
        $query = $this->db->get_where('users', array('user_permission' => 121));
        return $query;
    }

    function createAdmin($data){
        $this->db->insert('users', $data);
    }

    function deleteAdmin($id){
        $this->db->where('post_author', $id)->delete('posts');
        $this->db->where('user_id', $id)->delete('users');
    }

    function updateAdminPass($admin_id, $new_pass){
        $this->db->where('user_id', $admin_id)->update('users', array('user_password' => $new_pass));
    }

    function getAdminDetails($id){
        return $this->db->where('user_id', $id)->get('users')->result();
    }



    function getVideos(){
        $query = $this->db->get('videos');
        return $query;
    }

    function insertVideo($insertData){
        $this->db->insert('videos', $insertData);
    }

    function deleteVideo($video_id){
        $this->db->where('video_id', $video_id)->delete('videos');
    }



}


?>