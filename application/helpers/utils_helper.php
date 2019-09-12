<?php
/**
 * This helper contains a list of functions used throughout the application
 * @copyright  Copyright (c) 2016 Benoit Pitet
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @since      0.1.0
 */

 if (!defined('BASEPATH')) { exit('No direct script access allowed'); }


/**
 * Check if user is connected, redirect to login form otherwise
 * Set the user context into current controller by retrieving infos from session
 * @author Benoit Pitet
 */
function checkLogin($controller){
	if(! $controller->session->userdata('id')){
        $controller->session->set_userdata('last_page', current_url());        
		redirect('connection/login');
	}
    $controller->user_id = $controller->session->userdata('id');
    $controller->first_name = $controller->session->userdata('firstname');
    $controller->last_name = $controller->session->userdata('lastname');
    $controller->fullname = $controller->session->userdata('firstname') . ' ' . $controller->session->userdata('lastname');
    $controller->is_admin = $controller->session->userdata('is_admin');
    $controller->user_email = $controller->session->userdata('email'); 
    $controller->is_tutor = $controller->session->userdata('is_tutor');
    $controller->is_student = $controller->session->userdata('is_student');
       
}

/**
 * Prepare an array containing information about the current user
 * @return array data to be passed to the view
 * @author Benoit Pitet
 */
function getUserContextData($controller) {
    $data['user_id'] = $controller->user_id;
    $data['first_name'] =  $controller->first_name;
    $data['last_name'] =  $controller->last_name;
    $data['fullname'] =  $controller->fullname;
    $data['is_admin'] =  $controller->is_admin;
    $data['email'] = $controller->user_email;    
    $data['is_tutor'] = $controller->is_tutor;
    $data['is_student'] = $controller->is_student;       
    return $data;
}

/**
 * Internal utility function
 * make sure a resource is reloaded every time
 * @author Benoit Pitet
 */
function expires_now() {
    // Date in the past
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    // always modified
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    // HTTP/1.1
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", false);
    // HTTP/1.0
    header("Pragma: no-cache");
}

/**
 * Sanitizes an input (GET/POST) coming from outside a form (eg Ajax request)
 * @param string $value value to be cleansed from problematic characters
 * @return string value where problematic characters have been removed
 * @author Benjamin BALET <benjamin.balet@gmail.com>
 */
function sanitize($value)
{
    $value = trim($value);
    $value = str_replace('\\','',$value);
    $value = strtr($value,array_flip(get_html_translation_table(HTML_ENTITIES)));
    $value = strip_tags($value);
    $value = htmlspecialchars($value);
    return $value;
}

/**
 * htmlentities in PHP but preserving html tags
 * @param string $input_string
 * @return string htmlentities in PHP but by preserving html tags
 * @author Benjamin BALET <benjamin.balet@gmail.com>
 */
function htmlentities_htmltags($input_string) {
    $list = get_html_translation_table(HTML_ENTITIES);
    unset($list['"']);
    unset($list['<']);
    unset($list['>']);
    unset($list['&']);
    $search = array_keys($list);
    $values = array_values($list);
    //$search = array_map('utf8_encode', $search);
    $result = str_replace($search, $values, $input_string);
    return $result;
}
