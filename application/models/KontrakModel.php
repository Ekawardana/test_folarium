<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class KontrakModel extends CI_Model
{
    // Initial
    public $table = 'kontrak';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json()
    {
        $this->datatables->select('id, id_pegawai');
        $this->datatables->from('kontrak');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get total rows
    function total_rows($q = NULL)
    {
        $this->db->like('id', $q);
        $this->db->or_like('id_pegawai', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
        $this->db->or_like('id_pegawai', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }
}
