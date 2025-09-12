<?php 

function check_admin_login()
{
    $CI = &get_instance();
    if (empty($CI->session->userdata('admin_login_id'))) {
        redirect('admin/login');
    }
}

function check_is_superadmin(){
    $CI = &get_instance();

    if($CI->session->userdata('is_super_admin') == false){
        $CI->session->sess_destroy();
        redirect('admin/login');
    }
}

function check_is_admin_active(){
    $CI = &get_instance();

    if($CI->session->userdata('is_admin_active') == false){
        $CI->session->sess_destroy();
        redirect('admin/login');
    }
}