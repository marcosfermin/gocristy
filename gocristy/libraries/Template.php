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

class Template {
    var $template_data = array();
    var $data_sub = array();
    var $use_template_file  = '';
    var $use_template  = '';

    /**
     * set
     *
     * Set variable for using in templates views file (main file)
     *
     * @param	string	$name    Variable name for use in main file
     * @param	string	$value   Value of variable
     */
    function set($name, $value)
    {
        $this->template_data[$name] = $value;
    }
    
    /**
     * setJS
     *
     * Set More JS for using in templates views file (main file)
     *
     * @param	string	$js_txt   Value of variable
     */
    function setJS($js_txt)
    {
        $this->template_data['extra_js'] = $js_txt;
    }
    
    /**
     * setSub
     *
     * Set variable for using in views file (views file)
     *
     * @param	string	$name    Variable name for use in view file
     * @param	string	$value   Value of variable
     */
    function setSub($name, $value = '')
    {
        if(is_array($name)){
            $this->data_sub = $name;
        }else{
            $this->data_sub[$name] = $value;
        }
    }

    /**
     * set_template
     *
     * Set template name
     *
     * @param	string	$name    Template name for use
     * @param	string	$file   Template file name Defualt is main
     */
    function set_template($name, $file = 'main')
    {
        $this->use_template = $name;
        $this->use_template_file = $file;
    }

    /**
     * loadSub
     *
     * Load view with sub views
     *
     * @param	string	$view    View file for load
     * @param	string	$othermainfile    Other main view file path
     */
    function loadSub($view = '', $othermainfile = '')
    {
        $this->CI =& get_instance();
        return $this->load($view, $this->data_sub, '', '', $othermainfile);
    }
    
    /**
     * loadFrontPlugin
     *
     * Load view with sub views for frontend plugin with templates detected.
     *
     * @param	string	$view    View file for load
     * @param	string	$othermainfile    Other main view file path
     */
    function loadFrontPlugin($view = '', $othermainfile = '')
    {
        $CI =& get_instance();
        $config = $CI->GoCristy_model->load_config();
        if(file_exists(FCPATH . 'gocristy/modules/plugin/views/templates/'.$config->themes_config.'/'.$view.'.php') !== FALSE){
            return $this->load('templates/'.$config->themes_config.'/'.$view, $this->data_sub, '', '', $othermainfile);
        }else{
            return $this->load('templates/gocristydefault/'.$view, $this->data_sub, '', '', $othermainfile);
        }
    }
    
    /**
     * loadFrontViews
     *
     * Load view with sub views for frontend with templates detected.
     *
     * @param	string	$view    View file for load
     * @param	string	$othermainfile    Other main view file path
     */
    function loadFrontViews($view = '', $othermainfile = '')
    {
        $CI =& get_instance();
        $config = $CI->GoCristy_model->load_config();
        if(file_exists(FCPATH . 'gocristy/views/frontpage/templates/'.$config->themes_config.'/'.$view.'.php') !== FALSE){
            return $this->load('frontpage/templates/'.$config->themes_config.'/'.$view, $this->data_sub, '', '', $othermainfile);
        }else{
            return $this->load('frontpage/templates/gocristydefault/'.$view, $this->data_sub, '', '', $othermainfile);
        }
    }
    
    private function load($view = '' , $view_data = array(), $template = '', $return = FALSE, $othermainfile = '')
    {
        $this->CI =& get_instance();
        $this->set($this->CI->config->item('data_container'), $this->CI->load->view($view, array_merge($view_data, array ('template' => $this->template_data)), true));
        unset($view_data, $view);
        if(!$othermainfile){
            if (empty($this->use_template_file)) {
                $template_file = $this->CI->config->item('template_master');
            }
            if (!empty($this->use_template_file)) {
                $template_file = $this->use_template_file;
            }
            if (empty($template)) {
                $template = $this->CI->config->item('template_name');
            }
            if (!empty($this->use_template)) {
                $template = $this->use_template;
            }
            return $this->CI->load->view($this->CI->config->item('template_folder') . '/' . $template . '/'  . $template_file, $this->template_data, $return);
        }else{
            return $this->CI->load->view($othermainfile, $this->template_data, $return);
        }
    }
}