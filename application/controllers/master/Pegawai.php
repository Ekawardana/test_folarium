<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pegawai extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('datatables');
        cek_login();
    }

    public function index()
    {
        $data['user']  = $this->UserModel->cekUser(['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Pegawai';
        $data['button'] = "Index";
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('master/pegawai/pegawai_list', $data);
        $this->load->view('master/pegawai/pegawai_js');
        $this->load->view('templates/footer');
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->PegawaiModel->json();
    }

    public function add()
    {
        $data = array(
            'button'        => 'Tambah',
            'action'        => site_url('master/Pegawai/add_action'),
            'id_pegawai'    => set_value('id_pegawai'),
            'nama'          => set_value('nama'),
            'alamat'         => set_value('alamat'),
            'gaji'         => set_value('gaji'),

        );
        $data['user']  = $this->UserModel->cekUser(['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Pegawai';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('master/pegawai/pegawai_form', $data);
        $this->load->view('templates/footer');
        $this->load->view('master/pegawai/pegawai_js', $data);
    }
    public function add_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->add();
        } else {
            $data = array(
                'nama'          => $this->input->post('nama', TRUE),
                'alamat'         => $this->input->post('alamat', TRUE),
                'gaji'          => $this->input->post('gaji', TRUE),
            );
            $this->PegawaiModel->insert($data);
            $this->session->set_flashdata('message', 'dibuat.');
            redirect(site_url('master/Pegawai'));
        }
    }

    // Update data
    public function update($id)
    {

        $byid = $this->PegawaiModel->get_by_id($id);

        if ($byid) {
            $data = array(
                'button' => 'Edit',
                'action' => site_url('master/Pegawai/update_action'),
                'id_pegawai' => set_value('id_pegawai',  $byid->id_pegawai),
                'nama' => set_value('nama', $byid->nama),
                'alamat' => set_value('alamat', $byid->alamat),
                'gaji' => set_value('gaji', $byid->gaji),
            );
            $data['title'] = 'Pegawai';
            $data['user']  = $this->UserModel->cekUser(['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('master/pegawai/pegawai_form', $data);
            $this->load->view('master/pegawai/pegawai_js');
            $this->load->view('templates/footer');
        }
    }
    public function update_action()
    {
        $id_pegawai = $this->input->post('id_pegawai', TRUE);
        $pegawai_awal = $this->db->get_where('pegawai', ['id_pegawai' => $id_pegawai])->row_array()['nama'];

        if (trim($this->input->post('nama')) != $pegawai_awal) {
            $is_unique =  '|is_unique[pegawai.nama]';
        } else {
            $is_unique =  '';
        }

        $this->form_validation->set_rules('nama', 'Nama', 'trim|required' . $is_unique);
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required' . $is_unique);
        $this->form_validation->set_rules('gaji', 'Gaji', 'trim|required' . $is_unique);
        $this->_rules();
        if ($this->form_validation->run() == false) {
            $this->update($this->input->post('id_pegawai', true));
        } else {
            $data = array(
                'nama' => ucwords($this->input->post('nama', TRUE)),
                'alamat' => ucwords($this->input->post('alamat', TRUE)),
                'gaji' => ucwords($this->input->post('gaji', TRUE)),
            );

            $this->PegawaiModel->update($this->input->post('id_pegawai', TRUE), $data);
            $this->session->set_flashdata('message', 'di Edit.');
            redirect(site_url('master/Pegawai'));
        }
    }

    // Delete
    public function delete($id)
    {
        $this->PegawaiModel->delete($id);
        $this->session->set_flashdata('message', 'dihapus.');
        redirect(site_url('master/Pegawai'));
    }

    // Rules validation
    public function _rules()
    {
        // set messages
        $this->form_validation->set_message('required', '%s tidak boleh kosong.');
        $this->form_validation->set_message('numeric', '%s harus angka.');

        // set rules
        $this->form_validation->set_rules('id_pegawai', 'id_pegawai', 'trim');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('gaji', 'Gaji', 'numeric|trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}
