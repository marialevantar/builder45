<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('crypt_password')) {

    function crypt_password($password) {
        $CI = & get_instance();
        return sha1($password . $CI->config->item('encryption_key'));
    }

}

if (!function_exists('format_input')) {

    function format_input($str, $empty_str = '') {
        return (!empty($str)) ? $str : $empty_str;
    }

}
