<?php
defined('BASEPATH') or exit('No direct script access allowed');

function get_role()
{
    $CI = &get_instance();
    $role = $CI->session->userdata('role');
    return in_array($role, ['superadmin', 'admin', 'instructor'], true) ? $role : '';
}

function is_logged_in()
{
    $CI = &get_instance();
    return $CI->session->userdata('status') === 'masuk';
}

function is_superadmin()
{
    return get_role() === 'superadmin';
}

function is_admin()
{
    $role = get_role();
    return $role === 'superadmin' || $role === 'admin';
}

function is_instructor()
{
    return get_role() === 'instructor';
}

function current_instructor_id()
{
    $CI = &get_instance();
    return (int) $CI->session->userdata('instructor_id');
}

function require_login()
{
    if (!is_logged_in()) {
        redirect(base_url('login'));
        exit;
    }
}

function require_role($roles)
{
    if (!is_logged_in()) {
        redirect(base_url('login'));
        exit;
    }
    if (!is_array($roles)) {
        $roles = [$roles];
    }
    if (!in_array(get_role(), $roles, true)) {
        if (is_instructor()) {
            redirect(base_url('pages/dashboard_instruktur'));
        }
        redirect(base_url('pages/dashboard'));
        exit;
    }
}

function require_admin()
{
    require_login();
    if (!is_admin()) {
        if (is_instructor()) {
            redirect(base_url('pages/dashboard_instruktur'));
        }
        redirect(base_url('pages/dashboard'));
        exit;
    }
}

function require_superadmin()
{
    require_login();
    if (!is_superadmin()) {
        redirect(base_url('pages/dashboard'));
        exit;
    }
}
