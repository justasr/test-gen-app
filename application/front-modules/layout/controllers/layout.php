<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APP_PATH."core/MY_Guest_Controller.php";

class Layout extends MX_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function _setAdminPartials() {
        $this->template->set_partial('alerts','admin/alerts',array( 'module_override' =>'layout' ));
        $this->template->set_partial('nav_head','admin/nav_head',array( 'module_override' =>'layout' ));
        $this->template->set_partial('nav_left','admin/nav_left',array( 'module_override' =>'layout' ));
    }

    public function _setUserPartials() {
        $this->template->set_partial('alerts','user/alerts',array( 'module_override' =>'layout' ));
        $this->template->set_partial('nav_head','user/nav_head',array( 'module_override' =>'layout' ));
        $this->template->set_partial('nav_left','user/nav_left',array( 'module_override' =>'layout' ));

    }

    public function _setGuestPartials() {
        $this->template->set_partial('alerts','guest/alerts',array( 'module_override' =>'layout' ));
        $this->template->set_partial('nav_head','guest/nav_head',array( 'module_override' =>'layout' ));
        $this->template->set_partial('nav_left','guest/nav_left',array( 'module_override' =>'layout' ));
    }


}

