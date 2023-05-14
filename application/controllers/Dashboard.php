<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        cek_login();
    }
    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user']  = $this->UserModel->cekUser(['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('dashboard', $data);
        $this->load->view('templates/footer');
    }
}
