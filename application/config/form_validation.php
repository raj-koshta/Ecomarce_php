<?php

    $config = array(
        'signup' => array(
            [
                'field' => 'name',
                'label' => 'User Name',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Please Enter Valid %s'
                ]
            ],
            [
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|trim|valid_email',
                'errors' => [
                    'required' => 'Please enter %s',
                    'valid_email' => 'Please Enter Valid %s address'
                ]
            ],
            [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required|trim|min_length[5]',
                'errors' => [
                    'required' => 'Please enter %s',
                    'min_length[5]' => 'Password length should be greater than 4'
                ]
            ],
            [
                'field' => 'profile',
                'label' => 'profile',
                'rules' => 'required|trim|',
                'errors' => [
                    'required' => 'Please enter %s picture'
                ]
            ],
        ),
    );

    $config['error_prefix'] = '<div style="color: red;">';
    $config['error_suffix'] = '</div>';
