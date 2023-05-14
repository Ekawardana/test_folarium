<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class UserModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function cekUser($where = null)
    {
        return $this->db->get_where('user', $where);
    }

    public function getUserWhere($where = null)
    {
        return $this->db->get_where('user', $where);
    }

    public function getUser()
    {
        return $this->db->get('user');
    }
}
