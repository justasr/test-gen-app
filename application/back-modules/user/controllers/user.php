<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APP_PATH."core/MY_Admin_Controller.php";

class User extends MY_Admin_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model( 'users_model' );
        $this->load->library('table');
        $this->lang->load("user");

    }

	public function index()
	{
        exit;
	}

}
