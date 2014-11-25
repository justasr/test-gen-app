<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


require_once __DIR__."/Base_Controller.php";

class MY_Guest_Controller extends Base_Controller {

    public $user_clients = array();

    public function __construct()
    {
        parent::__construct();
    }

}

?>