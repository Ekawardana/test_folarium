<?php
function cek_login()
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        $ci->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Akses ditolak. Anda belum login!! </div>');
        redirect('auth');
    } else {
        $id_user = $ci->session->userdata('id_user');
    }
}
