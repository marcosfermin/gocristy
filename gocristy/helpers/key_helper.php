<?php  defined('BASEPATH') OR exit('No direct script access allowed');
 
/**
 * CodeIgniter HTML Helpers
 *
 * Copyright (c) 2018, Marcos Fermin.
 *
 * 
 * 
 * 
 * 
 * 
 * 
 * @author	Marcos Fermin
 * @copyright   Copyright (c) 2018, Marcos Fermin.
 * @license	The MIT License (MIT)
 * @link	http://www.gocristy.com
 * @since	Version 0.0.1
 */

class Key_helper{

    /**
    * chkPrivateKey
    *
    * Function for check the private key from get parameter ?pkey=
    * How to use = Key_helper::chkPrivateKey(); 
    *
    */
    static function chkPrivateKey(){
        $CI =& get_instance();
        $private_key = $CI->input->get('pkey', TRUE);
        if($CI->GoCristy_model->chkPrivateKey($private_key) === FALSE){
            $error_txt = 'Your private key invalid. Please try again. [IP: '.$CI->input->ip_address().', Time: '. date('Y-m-d H:i:s').']';
            log_message('error', $error_txt);
            show_error($error_txt, 403);
        }
    }
} 