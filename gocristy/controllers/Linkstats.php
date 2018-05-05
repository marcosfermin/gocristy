<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * GOCRISTY CMS
 *
 * An open source content management system
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
class Linkstats extends CI_Controller {

    var $page_rs;
    var $page_url;
    var $url_go;
    
    function __construct() {
        parent::__construct();
        $this->CI = & get_instance();
        $this->load->database();
        $row = $this->GoCristy_model->load_config();
        if($row->maintenance_active){
            //Return to home page
            redirect('./', 'refresh');
            exit;
        }
        if ($row->themes_config) {
            $this->template->set_template($row->themes_config);
        }
        if(!$this->session->userdata('fronlang_iso')){ 
            $this->GoCristy_model->setSiteLang();
        }
        if($this->GoCristy_model->chkLangAlive($this->session->userdata('fronlang_iso')) == 0){ 
            $this->session->unset_userdata('fronlang_iso');
            $this->GoCristy_model->setSiteLang(); 
        }
        $this->_init();
    }

    public function _init() {
        $id = $this->uri->segment(2);
        $row = $this->GoCristy_model->load_config();
        if ($id && is_numeric($id)) {
            $getLink = $this->GoCristy_model->getValue('url', 'link_stat_mgt', 'link_stat_mgt_id', $id, 1);
            if(!empty($getLink) && $getLink !== FALSE){
                if($getLink->url == '' || $getLink->url == '#'){
                    $this->url_go = base_url();
                }else{
                    $this->url_go = $getLink->url;
                }
                $redirectmeta = '<meta http-equiv="refresh" content="0;url='.$this->url_go.'">'."\n";
                $this->GoCristy_model->saveLinkStats($this->url_go);
            }else{
                //Return to home page
                redirect('./', 'refresh');
                exit;
            }
        } else {
            //Return to home page
            redirect('./', 'refresh');
            exit;
        }
        $this->template->set('core_css', $this->GoCristy_model->coreCss());
        $this->template->set('core_js', $this->GoCristy_model->coreJs());
        $pageURL = $this->GoCristy_model->getCurPages();	
        $this->page_url = $pageURL;
        $this->template->set('additional_js', $row->additional_js);
        $this->template->set('additional_metatag', $row->additional_metatag . "\n" . $redirectmeta);
        $title = 'Please wait... ,Redirect to | ' . $row->site_name;
        $this->template->set('title', $title);
        $this->template->set('meta_tags', $this->GoCristy_model->coreMetatags('Please wait... ,Redirect to ',$row->keywords,$title));
        $this->template->set('cur_page', $pageURL);
        $this->template->set('title', $title);
    }

    public function index() {
        $html = '<br><br><center><h3>Please Wait... ,Redirect to ' . $this->url_go . '</h3></center>';
        $this->template->setSub('content', $html);
        //Load the view
        $this->template->loadFrontViews('static/linkstats');
    }

}