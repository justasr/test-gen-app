<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

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
require APPPATH."core/Base_Controller.php";


class MY_User_Controller extends Base_Controller {

	public function __construct()
	{
		parent::__construct();

        if( !$this->ion_auth->logged_in() )
            redirect('auth/login');
	}

}

?>
