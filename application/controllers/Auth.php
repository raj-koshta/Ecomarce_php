<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    // Step 1: send OTP (constant 123456)
    public function send_otp()
    {
        $email = $this->input->post('email');

        if (!empty($email)) {
            // OTP and expiry time (1 min = 60 sec)
            $otp = '123456';
            $expiry = time() + 60;

            $this->session->set_userdata([
                'otp' => $otp,
                'otp_expiry' => $expiry
            ]);

            echo json_encode(['status' => 'success', 'message' => 'OTP sent successfully (valid for 1 minute)']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Email required']);
        }
    }

    // Step 2: verify OTP
    public function verify_otp()
    {
        $enteredOtp = $this->input->post('otp');
        $sessionOtp = $this->session->userdata('otp');
        $expiry = $this->session->userdata('otp_expiry');

        if (!$sessionOtp || !$expiry) {
            echo json_encode(['status' => 'error', 'message' => 'No OTP found. Please request again.']);
            return;
        }

        if (time() > $expiry) {
            // Clear expired OTP
            $this->session->unset_userdata(['otp', 'otp_expiry']);
            echo json_encode(['status' => 'error', 'message' => 'OTP expired. Please request a new one.']);
            return;
        }

        if ($enteredOtp == $sessionOtp) {
            // Clear OTP after successful use
            $this->session->unset_userdata(['otp', 'otp_expiry']);
            echo json_encode(['status' => 'success', 'message' => 'OTP verified successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid OTP']);
        }
    }

    public function change_password()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        if (!empty($email) && !empty($password)) {
            $check = $this->db
                ->where('email', $email)
                ->update('tbl_users', [
                    'password' => password_hash($password, PASSWORD_BCRYPT)
                ]);
            if ($check) {
                echo json_encode(['status' => 'success', 'message' => 'Password updated successfully']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to update password']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Something went wrong.']);
        }
    }
}
