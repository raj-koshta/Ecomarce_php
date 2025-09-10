<?php 

function check_admin_login()
{
    $CI = &get_instance();
    if (empty($CI->session->userdata('admin_login_id'))) {
        redirect('admin/login');
    }
}