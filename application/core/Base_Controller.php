<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * FusionInvoice
 *
 * A free and open source web based invoicing system
 *
 * @package		FusionInvoice
 * @author		Jesse Terry
 * @copyright	Copyright (c) 2012 - 2013 FusionInvoice, LLC
 * @license		http://www.fusioninvoice.com/license.txt
 * @link		http://www.fusioninvoice.com
 *
 */

require_once APPPATH."third_party/MX/Controller.php";


class Base_Controller extends MX_Controller {

    public $ajax_controller = false;
    public $data;

    protected $className;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();

        $this->load->library('session');
        $this->load->library('ion_auth');
        $this->load->library("pagination");
        $this->load->helper('url');
        $this->load->library('form_validation');

        $this->_set_delimiters();
        $this->load->helper('number');
        $this->load->helper('date');
        $this->load->helper('language');
        $this->load->module( 'layout' );
        $this->load->library('table');
        $this->load->library('data_filter');

        // Load setting model and load settings
//        $this->load->model('settings/mdl_settings');
//        $this->mdl_settings->load_settings();
//
//        $this->lang->load('fi', $this->mdl_settings->setting('default_language'));


     //   $this->load->module('layout');
    }

    function _render_page($instance = null, $view, $data=null )
    {

        if ( $this->ion_auth->is_admin() )
            $this->layout->_setAdminPartials();
        else if( !$this->ion_auth->logged_in() )
            $this->layout->_setGuestPartials();
        else if( $this->ion_auth->logged_in() )
            $this->layout->_setUserPartials();
        else
            $this->layout->_setGuestPartials();


        if ($instance instanceof MY_Guest_Controller)
            $this->data['auth_dir'] = 'guest';
        else if($instance instanceof MY_User_Controller)
            $this->data['auth_dir'] = 'user';
        else if($instance instanceof MY_Admin_Controller)
            $this->data['auth_dir'] = 'admin';
        else
            $this->data['auth_dir'] = 'guest';



        if( $data != "" )
            $this->template->build( $view,array("output" => array_merge($this->data,$data)) );
        else
            $this->template->build( $view,array("output" => $this->data) );
    }

    function _set_delimiters() {
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
    }

    function _set_error_messages() {
        $this->form_validation->set_message('exist', ' Operation failed, bad data formating ');
    }

}

?>