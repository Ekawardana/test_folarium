<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jabatan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('datatables');
        cek_login();
    }

    public function index()
    {
        $data['title'] = 'Jabatan';
        $data['user']  = $this->UserModel->cekUser(['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('master/jabatan/jabatan_list', $data);
        $this->load->view('master/jabatan/jabatan_js');
        $this->load->view('templates/footer');
    }

    // Menampilkan datatables
    public function json()
    {
        header('Content-type: application/json');
        echo $this->JabatanModel->json();
    }

    // Create data
    public function add()
    {

        $data = array(
            'button' => 'Tambah',
            'action' => site_url('master/Jabatan/add_action'),
            'id'     => set_value('id'),
            'jabatan' => set_value('jabatan'),
        );

        $data['title'] = 'Jabatan';
        $data['user']  = $this->UserModel->cekUser(['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('master/jabatan/jabatan_form', $data);
        $this->load->view('master/jabatan/jabatan_js');
        $this->load->view('templates/footer');
    }
    public function add_action()
    {
        $this->_rules();
        if ($this->form_validation->run() == false) {
            $this->add();
        } else {
            $data = array(
                'jabatan' => ucwords($this->input->post('jabatan', TRUE)),
            );
            $this->JabatanModel->insert($data);
            $this->session->set_flashdata('message', 'dibuat.');
            redirect(site_url('master/Jabatan'));
        }
    }

    // Update data
    public function update($id)
    {

        $byid = $this->JabatanModel->get_by_id($id);

        if ($byid) {
            $data = array(
                'button' => 'Edit',
                'action' => site_url('master/jabatan/update_action'),
                'id'   => set_value('id',  $byid->id),
                'jabatan' => set_value('jabatan', $byid->jabatan),
            );
            $data['title'] = 'Jabatan';
            $data['user']  = $this->UserModel->cekUser(['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('master/jabatan/jabatan_form', $data);
            $this->load->view('master/jabatan/jabatan_js');
            $this->load->view('templates/footer');
        }
    }
    public function update_action()
    {
        $id = $this->input->post('id', TRUE);
        $jabatan_awal = $this->db->get_where('jabatan', ['id' => $id])->row_array()['jabatan'];

        if (trim($this->input->post('jabatan')) != $jabatan_awal) {
            $is_unique =  '|is_unique[jabatan.jabatan]';
        } else {
            $is_unique =  '';
        }

        $this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|required' . $is_unique);
        $this->_rules();
        if ($this->form_validation->run() == false) {
            $this->update($this->input->post('id', true));
        } else {
            $data = array(
                'jabatan' => ucwords($this->input->post('jabatan', TRUE)),
            );

            $this->JabatanModel->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'di Edit.');
            redirect(site_url('master/Jabatan'));
        }
    }

    // Delete
    public function delete($id)
    {

        if ($this->JabatanModel->delete($id)) {
            $this->session->set_flashdata('message', 'dihapus.');
            redirect(site_url('master/Jabatan'));
        } else {
            $this->session->set_flashdata('message', 'Data Sedang Digunakan.');
            redirect(site_url('master/Jabatan'));
        }
    }

    // Rules validation
    public function _rules()
    {
        // set messages
        $this->form_validation->set_message('required', '%s tidak boleh kosong.');

        // set rules
        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_rules('jabatan', 'jabatan', 'required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}
