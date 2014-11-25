<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APP_PATH."core/MY_User_Controller.php";

class Import extends MY_User_Controller {

	function __construct()
	{
		parent::__construct();

        $this->lang->load('test');
        $this->lang->load('import');
        $this->load->model('test_model');
        $this->load->library('import_manager');
	}

    function create_manual() {

        $this->form_validation->set_rules('test_name', lang('l_test_name'), 'required'); /* Unique? */
        $this->form_validation->set_rules('test_type', lang("l_test_type"), 'required}');

        if(  $this->form_validation->run() ) {

            $input = array(
                'test_name' => $this->input->post('test_name'),
                'test_type' => $this->input->post('test_type'),
                'test_user_id' => $this->ion_auth->get_user_id()
            );

            if( $testID = $this->test_model->create( $input ) ) {
                $this->session->set_flashdata('message_success', lang('create_success') );

                switch( $input['test_type'] ) {
                    case Test_model::TEST_TYPE_POLL:
                        redirect('test/edit_poll/?id='.$testID, 'refresh');
                        break;
                    case Test_model::TEST_TYPE_SURVEY:
                        redirect('test/edit_survey/?id='.$testID, 'refresh');
                        break;
                    case Test_model::TEST_TYPE_EXAM:
                        redirect('test/edit_exam/?id='.$testID, 'refresh');
                        break;
                    default:
                        redirect('test/edit_poll/?id='.$testID, 'refresh');
                        break;
                }

            } else {
                log_message( 'error', ERROR_DEPOSIT_CREATION_FAIL ." ". $this->db->last_query() );
                $this->session->set_flashdata('message_failure', lang('create_failure') );
                redirect('test/create_manual', 'refresh');
            }
        }

        /* Test Info */
        $this->data['test_types'] = $this->test_model->getTypes();
        $this->_render_page($this,'/test/create_manual');
    }

    function xml() {
        $this->form_validation->set_rules("fSubmit", lang('l_submit_import_file'), 'required');

        if(  $this->form_validation->run() ) {

            $this->import_manager->initImport( $this->ion_auth->get_user_id(),'xmlFile' );
            if( $this->import_manager->uploadXMLFile() ) {

                if( $this->import_manager->parseXML() )
                {
                    $this->import_manager->save();
                    $this->import_manager->deleteFile();

                    $this->session->set_flashdata('message_success', lang('m_import_success') );
                    redirect('/import/xml', 'refresh');
                } else {
                    $this->session->set_flashdata('message_failure', lang('m_import_failure') );
                    redirect('import/xml', 'refresh');
                }

                redirect('/import/xml', 'refresh');
            } else {
                redirect('/import/xml', 'refresh');
            }

        }

        $this->_render_page($this,'/import/xml');
    }

    function json() {
        $this->form_validation->set_rules("fSubmit", lang('l_submit_import_file'), 'required');

        if(  $this->form_validation->run() ) {

            $this->import_manager->initImport( $this->ion_auth->get_user_id(),'jsonFile' );
            if( $this->import_manager->uploadJSONFile() ) {

                if( $this->import_manager->parseJSON() )
                {
                    $this->import_manager->save();
                    $this->import_manager->deleteFile();

                    $this->session->set_flashdata('message_success', lang('m_import_success') );
                    redirect('/import/xml', 'refresh');
                } else {
                    $this->session->set_flashdata('message_failure', lang('m_import_failure') );
                    redirect('import/xml', 'refresh');
                }

                redirect('/import/json', 'refresh');
            } else {
                redirect('/import/json', 'refresh');
            }

        }

        $this->_render_page($this,'/import/json');
    }
}
