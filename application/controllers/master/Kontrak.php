<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kontrak extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('datatables');
        cek_login();
    }

    public function index()
    {
        $data['title'] = 'Kontrak';
        $data['user']  = $this->UserModel->cekUser(['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('master/kontrak/kontrak_list', $data);
        $this->load->view('master/kontrak/kontrak_js');
        $this->load->view('templates/footer');
    }

    // Menampilkan datatables
    public function json()
    {
        header('Content-type: application/json');
        echo $this->KontrakModel->json();
    }
}
