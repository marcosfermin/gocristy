<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
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
class General_label extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->lang->load('admin', $this->GoCristy_admin_model->getLang());
        $this->template->set_template('admin');
        $this->_init();
    }

    public function _init() {
        $this->template->set('core_css', $this->GoCristy_admin_model->coreCss());
        $this->template->set('core_js', $this->GoCristy_admin_model->coreJs());
        $this->template->set('title', 'Backend System | ' . $this->GoCristy_admin_model->load_config()->site_name);
        $this->template->set('meta_tags', $this->GoCristy_admin_model->coreMetatags('Backend System for GOCRISTY Content Management System'));
        $this->template->set('cur_page', $this->GoCristy_admin_model->getCurPages());
    }

    public function index() {
        admin_helper::is_logged_in($this->session->userdata('admin_email'));
        admin_helper::is_allowchk('general label');
        $this->db->cache_on();
        $this->GoCristy_referrer->setIndex();
        $this->load->library('pagination');
        // Pages variable
        $result_per_page = 20;
        $total_row = $this->GoCristy_admin_model->countTable('general_label');
        $num_link = 10;
        $base_url = $this->GoCristy_model->base_link(). '/admin/genlabel/';
        
        // Pageination config
        $this->GoCristy_admin_model->pageSetting($base_url,$total_row,$result_per_page,$num_link); 
        ($this->uri->segment(3))? $pagination = ($this->uri->segment(3)) : $pagination = 0;
        
        //Get users from database
        $this->template->setSub('genlab', $this->GoCristy_admin_model->getIndexData('general_label', $result_per_page, $pagination, 'general_label_id', 'ASC'));
        $lang = $this->GoCristy_model->getValueArray('*', 'lang_iso', "lang_name != ''", '');
        foreach ($lang as $l) { 
            if($l['lang_name']) $lang_arr[$l['lang_iso']] = $l['lang_name'];
        }
        $this->template->setSub('lang', $lang_arr);

        //Load the view
        $this->template->loadSub('admin/genlabel_index');
    }

    public function edit() {
        admin_helper::is_logged_in($this->session->userdata('admin_email'));
        admin_helper::is_allowchk('general label');
        //Load the form helper
        $this->load->helper('form');
        if($this->uri->segment(4)){
            $this->db->cache_on();
            $genlab = $this->GoCristy_model->getValue('*', 'general_label', 'general_label_id', $this->uri->segment(4), 1);
            if($genlab !== FALSE){
                $this->template->setSub('genlab', $genlab);
                $this->template->setSub('lang', $this->GoCristy_model->getValueArray('*', 'lang_iso', "lang_iso != ''", ''));
                //Load the view
                $this->template->loadSub('admin/genlabel_edit');
            }else{
                redirect($this->GoCristy_referrer->getIndex(), 'refresh');
            }
        }else{
            redirect($this->GoCristy_referrer->getIndex(), 'refresh');
        }
    }

    public function updated() {
        admin_helper::is_logged_in($this->session->userdata('admin_email'));
        admin_helper::is_allowchk('general label');
        admin_helper::is_allowchk('save');

        $this->GoCristy_admin_model->updateLabel($this->uri->segment(4));
        $this->db->cache_delete_all();
        $this->session->set_flashdata('error_message','<div class="alert alert-success" role="alert">'.$this->lang->line('success_message_alert').'</div>');
        redirect($this->GoCristy_referrer->getIndex(), 'refresh');
    }
    
    public function syncLang() {
        admin_helper::is_logged_in($this->session->userdata('admin_email'));
        admin_helper::is_allowchk('general label');
        admin_helper::is_allowchk('save');
        $this->GoCristy_admin_model->syncLabelLang();
        $this->db->cache_delete_all();
        $this->session->set_flashdata('error_message','<div class="alert alert-success" role="alert">'.$this->lang->line('genlabel_synclang_success').'</div>');
        redirect($this->GoCristy_referrer->getIndex(), 'refresh'); 
    }
    
}
