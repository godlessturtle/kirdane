<?php
/**
 * Created by PhpStorm.
 * User: Aslan
 * Date: 29.08.2018
 * Time: 12:28
 */
class UserModel extends CI_Model{

    function insertPost($data){
        $this->db->insert('posts', $data);
    }

    function hasPost($slug){
        $query = $this->db->get_where('posts', array('post_slug' => $slug));
        return $query->num_rows();
    }

    function catNameBySlug($slug){
        $query = $this->db->get_where('categories', array('cat_slug' => $slug));
        return $query->result();
    }

    function isAdminMail($mail){
        $query = $this->db->get_where('users', array('user_email' => $mail, 'user_permission' => 121));
        return $query->num_rows();
    }

    function userPosts($user_id){
        $query = $this->db->order_by('post_id', 'DESC')->get_where('posts', array('post_author' => $user_id));
        return $query->result();
    }

    function isValidID($secureID){
        $query = $this->db->get_where('posts', array('secureID' => $secureID));
        return $query->num_rows();
    }

    function checkPostAuthor($secureID, $user_id){
        $query = $this->db->get_where('posts', array('secureID' => $secureID, 'post_author' => $user_id));
        return $query->num_rows();
    }

    function deletePost($secureID){
        $this->db->delete('posts', array('secureID' => $secureID));
    }

    function getUserPass($user_id){
        $user = $this->db
            ->select(array('user_id','user_email', 'user_password'))
            ->get_where('users', array('user_id' => $user_id, 'user_permission' => 1))
            ->result();
        return $user;
    }

    function updatePass($data, $user_id){
        $this->db->where('user_id', $user_id);
        $this->db->update('users', $data);
    }


}