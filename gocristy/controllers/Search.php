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
class Search extends CI_Controller {

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
        if (!$this->session->userdata('fronlang_iso')) {
            $this->GoCristy_model->setSiteLang();
        }
        if ($this->GoCristy_model->chkLangAlive($this->session->userdata('fronlang_iso')) == 0) {
            $this->session->unset_userdata('fronlang_iso');
            $this->GoCristy_model->setSiteLang();
        }
        $this->_init();
    }

    public function _init() {
        $this->template->set('core_css', $this->GoCristy_model->coreCss());
        $this->template->set('core_js', $this->GoCristy_model->coreJs());
        $row = $this->GoCristy_model->load_config();
        $pageURL = $this->GoCristy_model->getCurPages();
        $this->template->set('additional_js', $row->additional_js);
        $this->template->set('additional_metatag', $row->additional_metatag);
        $title = 'Search | ' . $row->site_name;
        $this->template->set('title', $title);
        $this->template->set('meta_tags', $this->GoCristy_model->coreMetatags($title, $row->keywords, $title));
        $this->template->set('cur_page', $pageURL);
    }

    public function index() {
        $config = $this->GoCristy_admin_model->load_config();
        if($config->gsearch_active && !empty($config->gsearch_cxid) && $config->gsearch_cxid !== NULL){
            $this->template->setSub('config', $config);
            $this->template->loadFrontViews('search/search');
            $this->output->cache($config->pagecache_time);
        }else{
            redirect(BASE_URL, 'refresh');
        }
    }

}