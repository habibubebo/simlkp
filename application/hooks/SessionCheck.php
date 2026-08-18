<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SessionCheck
{
    public function checkExpiry()
    {
        $CI = &get_instance();

        $uri = $CI->uri->segment(1) . '/' . $CI->uri->segment(2);
        $excluded = array('login/auth', 'login/logout');
        if (in_array($uri, $excluded)) {
            return;
        }

        $status = $CI->session->userdata('status');
        $is_pwa = $CI->session->userdata('is_pwa');
        $session_expiry = $CI->session->userdata('session_expiry');

        if ($status === "masuk" && $is_pwa !== '1' && $session_expiry) {
            if (time() > $session_expiry) {
                $CI->session->sess_destroy();
                redirect('login');
            } else {
                $CI->session->set_userdata('last_active', time());
                $CI->session->set_userdata('session_expiry', time() + 7200);
            }
        }
    }
}
