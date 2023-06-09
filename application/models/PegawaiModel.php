<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class PegawaiModel extends CI_Model
{
    public $table = 'pegawai';
    public $id = 'id_pegawai';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json()
    {
        $this->datatables->select(
            '
        p.id_pegawai, 
        p.nama, 
        jab.jabatan, 
        p.alamat, 
        p.gaji
        '
        );
        $this->datatables->from('pegawai p');
        $this->datatables->join('jabatan jab', 'jab.id_jab = p.jab_id');
        $this->datatables->group_by('p.id_pegawai');
        $this->datatables->add_column(
            'action',
            '<div class="btn-group">' .
                form_open('master/Pegawai/update/$1') .
                form_button(['type' => 'submit', 'title' => 'Edit', 'class' => 'btn btn-warning', 'content' => '<i class="fas fa-pencil-alt"> </i>']) .
                form_close() . "&nbsp;" .
                form_open('master/Pegawai/delete/$1') .
                form_button(['type' => 'submit', 'title' => 'Hapus', 'class' => 'btn btn-danger'], '<i class="fas fa-trash-alt"> </i>', 'onclick="javascript: return confirm(\'Yakin ingin hapus ?\')"') .
                form_close() . '</div>',
            'id_pegawai'
        );
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get total rows
    function total_rows($q = NULL)
    {
        $this->db->like('id_pegawai', $q);
        $this->db->or_like('nama', $q);
        $this->db->or_like('alamat', $q);
        $this->db->or_like('jab_id', $q);
        $this->db->or_like('gaji', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_pegawai', $q);
        $this->db->or_like('nama', $q);
        $this->db->or_like('alamat', $q);
        $this->db->or_like('jab_id', $q);
        $this->db->or_like('gaji', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // Insert
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // Update
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // Delete
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
}
