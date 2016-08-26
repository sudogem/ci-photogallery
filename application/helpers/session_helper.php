<?php

function is_admin() {
	$CI =& get_instance();
	if ($CI->session->userdata('is_admin') == true) {
		return true;
	}
	return false;
}

function is_logged_in() {
	$CI =& get_instance();
	if ($CI->session->userdata('login')) {
		return true;
	}
	return false;
}

function getuid() {
	$CI =& get_instance();
	return $CI->session->userdata('uid') != "" ? $CI->session->userdata('uid') : false;
}

function getfullname() {
	$CI =& get_instance();
	$uid = $CI->session->userdata('uid') != "" ? $CI->session->userdata('uid') : false;
	$result = $CI->user_model->get_by_id($uid);
	$fullname = $result['first_name'] . " " . $result['last_name'];
	return $fullname;
}