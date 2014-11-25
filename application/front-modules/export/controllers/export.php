<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APP_PATH."core/MY_User_Controller.php";

class Export extends MY_User_Controller {

	function __construct()
	{
		parent::__construct();

        $this->lang->load('test');
        $this->lang->load('import');
        $this->load->model('test_model');
        $this->load->library('export_manager');
	}

    function xml() {
        $testID = $this->input->get('id');
        $userID = $this->ion_auth->get_user_id();
        $this->export_manager->initExport($userID,$testID);

        $this->export_manager->printXML();
        exit;
    }

    function json() {
        $testID = $this->input->get('id');
        $userID = $this->ion_auth->get_user_id();
        $this->export_manager->initExport($userID,$testID);

        $this->export_manager->printJSON();
        exit;
    }

}
