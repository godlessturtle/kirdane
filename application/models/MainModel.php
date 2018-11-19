<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainModel extends CI_Model
{

    function feedPosts($limit)
    {
        $query = $this->db->order_by('post_id', 'DESC')->get_where('posts', array('isDraft' => 0), $limit);
        return $query->result();
    }


    //footerslider
    function popularThisWeek($cat_id, $limit = 4)
    {
        $query = $this->db->get_where('posts', array('isDraft' => 0, 'post_category' => $cat_id), $limit);
        return $query->result();
    }

    function checkPost($post_id)
    {
        $query = $this->db->get_where('posts', array('post_id' => $post_id, 'isDraft' => 0));
        return $query->num_rows();
    }


    function viewCount($post_id)
    {
        $this->db->where('post_id', $post_id, trim(urldecode($post_id)));
        $this->db->select('post_views');
        $count = $this->db->get('posts')->row();

        $this->db->where('post_id', $post_id, urldecode($post_id));
        $this->db->set('post_views', ($count->post_views + 1));
        $this->db->update('posts');
        return $this->db->query("SELECT post_views FROM posts WHERE post_id=" . $post_id . "")->result();
    }

    function single($post_id)
    {
        $this->viewCount($post_id);
        $query = $this->db->get_where('posts', array('post_id' => $post_id));
        return $query->result();
    }

    //related posts
    function relatedPosts($post_category)
    {
        $query = $this->db->order_by('post_id', 'DESC')->get_where('posts', array('post_category' => $post_category), 2);
        return $query->result();
    }

    function insertComment($data)
    {
        $this->db->insert('comments', $data);
    }

    function getPostComments($post_id)
    {
        $this->db->select('*');
        $this->db->from('posts');
        $this->db->join('comments', 'comments.whichPost = posts.post_id');
        return $this->db->where(array('isApproved' => 1, 'whichPost' => $post_id))->get();
    }


    //slider
    function getCatPosts($cat_id, $limit = 5)
    {
        $query = $this->db->order_by('post_id', 'DESC')->get_where('posts', array('post_category' => $cat_id, 'isDraft' => 0), $limit);
        return $query->result();
    }

    function getRecentPostsTS($limit = 5)
    {
        $query = $this->db->order_by('post_id', 'DESC')->get_where('posts', array('isDraft' => 0), $limit);
        return $query->result();
    }

    function getSettings($set_id = 0)
    {
        $query = $this->db->get_where('settings', array('set_id' => $set_id));
        return $query->result();
    }

    function getCategoryPosts($cat_id, $limit = 2)
    {
        $query = $this->db->get_where('posts', array('post_category' => $cat_id, 'isDraft' => 0), $limit);
        return $query->result();
    }

    function getFooterSettings()
    {
        $query = $this->db->get_where('footer', array('tab_id' => 0));
        return $query->result();
    }


    //kayıtol
    function register($data)
    {
        $this->db->insert('users', $data);
    }


    function checkUser($email, $password)
    {
        $query = $this->db->get_where('users', array('user_permission' => 1, 'user_email' => $email, 'user_password' => $password));
        return $query;
    }

    function reCheck($email)
    {
        $query = $this->db->get_where('users', array('user_permission' => 1, 'user_email' => $email));
        return $query;
    }

    function getUserImg($email)
    {
        $this->db->select('user_img');
        $query = $this->db->get_where('users', array('user_email' => $email));
        return $query->result();
    }


    //author posts
    function getAuthorPosts($author_id, $per=1, $offset = 1)
    {
        $query = $this->db->limit($per, $offset)->get_where('posts', array('post_author' => $author_id));
        return $query->result();
    }


    //sidebar
    function getPopularPosts()
    {
        $query = $this->db->order_by('post_views', 'DESC')->get_where('posts', array('isDraft' => 0), 8);
        return $query;
    }

    function getRandomPosts($count = 3){
        $query = $this->db->order_by('rand()')->limit($count)->get('posts');
        return $query->result();
    }

    function getRecentComments()
    {
        $query = $this->db->order_by('comment_id', 'DESC')->get_where('comments', array('isApproved' => 1), 8);
        return $query->result();
    }

    function getRecentPosts()
    {
        $query = $this->db->order_by('post_id', 'DESC')->get_where('posts', array('isDraft' => 0), 10);
        return $query->result();
    }


    //menü
    function getMenus()
    {
        $query = $this->db->get_where('menus', array('topLevel' => 0));
        return $query->result();
    }


    //pages
    function getPageDetails($slug)
    {
        $query = $this->db->get_where('pages', array('page_slug' => $slug));
        return $query->result();
    }


    //güvenlik
    function checkPostID($id)
    {
        $query = $this->db->get_where('posts', array('post_id' => $id, 'isDraft' => 0));
        return $query->num_rows();
    }

    function checkCatID($id)
    {
        $query = $this->db->get_where('categories', array('cat_id' => $id));
        return $query->num_rows();
    }

    function checkAuthorID($id)
    {
        $query = $this->db->select('user_id')->get_where('users', array('user_id' => $id));
        return $query->result();
    }

    function checkPageSlug($slug)
    {
        $query = $this->db->get_where('pages', array('page_slug' => $slug));
        return $query->num_rows();
    }


    function getCategories()
    {
        $query = $this->db->get_where('categories');
        return $query->result();
    }


    function updateUser($id, $updateData)
    {
        $this->db->where(array('user_id' => $id, 'user_permission => 1'));
        $this->db->update('users', $updateData);
    }


    function getGalleryImages()
    {
        return $this->db->limit(25)->get('gallery');
    }


    function catPostsCount($id)
    {
        $query = $this->db->get_where('posts', array('isDraft' => 0, 'post_category' => $id));
        return $query->num_rows();
    }

    function catSlug($cat_id)
    {
        $query = $this->db->get_where('categories', array('cat_id' => $cat_id));
        return $query->result()[0]->cat_slug;
    }

    function catPosts($cat_id, $perPage, $offset)
    {
        if($offset == 0 || is_null($offset)){
            $offset = 1;
        }
        $query = $this->db->limit($perPage, $offset)->get_where('posts', array('isDraft' => 0, 'post_category' => $cat_id));
        return $query->result();
    }

    function search($term){
        $query = $this->db->like('post_text', $term)->order_by('post_id', 'DESC')->limit(25)->get('posts');
        return $query->result();
    }

    function authorPostsCount($id){
        $query = $this->db->get_where('posts', array('post_author' => $id, 'isDraft' => 0));
        return $query->num_rows();
    }

    function getVideos(){
        $query = $this->db->get('videos');
        return $query->result();
    }







}


?>