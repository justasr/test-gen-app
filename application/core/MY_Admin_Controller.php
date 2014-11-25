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


//exit(APP_PATH."/core/MY_Base_Сontroller.php");
require_once __DIR__."/Base_Controller.php";

class MY_Admin_Controller extends Base_Controller {

	public function __construct()
	{
        parent::__construct();
        if( !$this->ion_auth->is_admin() )
            redirect('user/auth/login');
	}

}

?>